<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Entity\Image;
use App\Form\AdType;
use App\Form\ImageType;
use App\Repository\AdRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdController extends AbstractController
{
    /**
     * @Route("/ads", name="ads_index")
     */
    public function index(AdRepository $repository)
    {

        $ads = $repository->findAll();

        return $this->render('ad/index.html.twig', [
            'ads' => $ads,
        ]);
    }

    /**
     * Permet de créer une annonce
     * Mettre avant la methode show sinon symfo cherche un slug new a la place la route
     *
     * @Route("/ads/new", name="ads_create")
     */

    public function create(Request $request, EntityManagerInterface $manager){
        $ad = new Ad();

        $image = new Image();

        $image->setUrl('http://placehold.it/400x200')
                ->setCaption('Titre 1');
        $ad->addImage($image);

        $form= $this->createForm(AdType::class, $ad);

        $form->handleRequest($request);



        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($ad);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'annonce <strong>{$ad->getTitle()}</strong> a bien été enregistrée"
            );


            return $this->redirectToRoute('ads_show', [
                'slug'=> $ad->getSlug()
            ]);
        }


        return $this->render('ad/new.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * Permet d'afficher une annonce
     *
     * @Route("/ads/{slug}", name="ads_show")
     *
     */
    public function show(Ad $ad){

        return $this->render('ad/show.html.twig', [
            'ad'=> $ad
        ]);
    }


}
