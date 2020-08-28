<?php

namespace App\Controller;

use App\Entity\Ad;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdController extends AbstractController
{
    /**
     * @Route("/ads", name="ads_index")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Ad::class);

        $ads = $repository->findAll();

        return $this->render('ad/index.html.twig', [
            'ads' => $ads,
        ]);
    }
}
