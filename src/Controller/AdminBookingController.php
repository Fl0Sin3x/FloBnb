<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Form\AdminBookingType;
use App\Repository\BookingRepository;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminBookingController extends AbstractController
{
    /**
     * @Route("admin/booking", name="admin_booking_index")
     */
    public function index(BookingRepository $repository)
    {
        return $this->render('admin/booking/index.html.twig', [
            'bookings' => $repository->findAll(),
        ]);
    }

    /**
     * @Route("admin/booking/{id}/edit", name="admin_booking_edit")
     *
     * @return Response
     */
    public function edit(Booking $booking){
        $form = $this->createForm(AdminBookingType::class, $booking);

        return $this->render('admin/booking/edit.html.twig', [
            'form' => $form->createView(),
            'booking' => $booking
        ]);
    }
}
