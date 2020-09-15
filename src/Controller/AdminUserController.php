<?php

namespace App\Controller;


use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\Paginator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminUserController extends AbstractController
{
    /**
     * @Route("/admin/user/{page<\d+>?1}", name="admin_user_index")
     */
    public function index(UserRepository $repository,$page, Paginator $paginator)
    {
        $paginator->setEntityClass(User::class)
            ->setLimit(10)
            ->setPage($page);


        return $this->render('admin/user/index.html.twig', [
            'paginator' => $paginator
        ]);
    }

    /**
     * Permet de un utilisateur
     *
     * @Route("/admin/user/{id}/delete", name="admin_user_delete", requirements={"id"="\d+"})
     *
     */

    public function delete(User $user, EntityManagerInterface $manager){
        $manager->remove($user);
        $manager->flush();

        $this->addFlash(
            'success',
            "L'utilisateur a bien été supprimé !"
        );

        return $this->redirectToRoute('admin_user_index');
    }

}
