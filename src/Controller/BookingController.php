<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Entity\Booking;
use App\Form\BookinkType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BookingController extends AbstractController
{
    /**
     * @Route("/ads/{slug}/book", name="booking_create")
     */
    public function book(Ad $ad){

        $booking = new Booking();
        $form = $this->createForm(BookinkType::class, $booking);

        return $this->render('booking/book.html.twig', [
            'ad'=> $ad,
            'form'=> $form->createView()
        ]);
    }
}
