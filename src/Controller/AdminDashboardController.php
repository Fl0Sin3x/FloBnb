<?php

namespace App\Controller;

use App\Service\Stats;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminDashboardController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_dashboard")
     */
    public function index(EntityManagerInterface $manager, Stats $stats)
    {


        $statistiques = $stats->getStats();
        $bestAds = $stats->getAdsStats('DESC');
        $worseAds = $stats->getAdsStats('ASC');


        return $this->render('admin/dashboard/index.html.twig', [
            'stats'=> $statistiques,
            'bestAds'=> $bestAds,
            'worseAds'=> $worseAds
        ]);
    }
}
