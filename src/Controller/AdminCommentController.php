<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Entity\Comment;
use App\Form\AdminCommentType;
use App\Form\AdType;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use App\Service\Paginator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminCommentController extends AbstractController
{
    /**
     * @Route("admin/comments/{page<\d+>?1}", name="admin_comment_index")
     */
    public function index(CommentRepository $repository, $page, Paginator $paginator)
    {
        $paginator->setEntityClass(Comment::class)
            ->setLimit(5)
            ->setPage($page);


        return $this->render('admin/comment/index.html.twig', [
            'paginator' => $paginator
        ]);
    }

    /**
     * Permet d'affiché le formulaire d'edition
     *
     * @Route("/admin/comments/{id}/edit", name="admin_comments_edit")
     * @param Comment $comment
     * @return Response
     */

    public function edit(Comment $comment, Request $request, EntityManagerInterface $manager) {

        $form = $this->createForm(AdmincommentType::class, $comment);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($comment);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le commentaire a bien été modifié !"
            );
        }

        return $this->render('admin/comment/edit.html.twig', [
            'comment' => $comment,
            'form' => $form->createView()
        ]);
    }

    /**
     * Permet de supprimé une annonce
     *
     * @Route("/admin/comment/{id}/delete", name="admin_comment_delete")
     *
     */

    public function delete(Comment $comment, EntityManagerInterface $manager){
            $manager->remove($comment);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le commentaire a bien été supprimé !"
            );

        return $this->redirectToRoute('admin_comment');
    }

}
