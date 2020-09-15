<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Twig\Environment;

class Paginator {
    private $entityClass;
    private $limit = 10;
    private $currentPage = 1;
    private $manager;
    private $twig;
    private $route;
    private $templatePath;

    public function __construct(EntityManagerInterface $manager, Environment $twig, RequestStack $request, $templatePath){
        $this->route        = $request->getCurrentRequest()->attributes->get('_route');
        $this->manager      = $manager;
        $this->twig         = $twig;
        $this->templatePath = $templatePath;
    }

    public function setRoute($route){
        $this->route = $route;

        return $this;
    }

    public function getRoute(){
        return $this->route;
    }


    public function display(){
        $this->twig->display($this->templatePath,[
            'page' => $this->currentPage,
            'pages'=> $this->getPages(),
            'route'=> $this->route
        ]);
    }

    public function getPages(){
        // 1) Connaître le total des enregistrement de la table
        $repo = $this->manager->getRepository($this->entityClass);
        $total = count($repo->findAll());

        // 2) Faire la division, l'arrondi et le renvoyé
        $pages = ceil($total / $this->limit);

        return $pages;
    }

    public function getData(){
        // 1) Calculer le offset (savoir ou se trouvé pour démarrer la page)
        $offset = $this->currentPage * $this->limit - $this->limit;

        // 2) Demander au repo de trouver les éléments
        $repository = $this->manager->getRepository($this->entityClass);
        $date = $repository->findBy([], [], $this->limit, $offset);

        // 3) Renvoyer les éléments en question
        return $date;
    }


    public function getEntityClass()
    {
        return $this->entityClass;
    }


    public function setEntityClass($entityClass)
    {
        $this->entityClass = $entityClass;

        return $this;
    }


    public function getLimit()
    {
        return $this->limit;
    }


    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }


    public function getPage()
    {
        return $this->currentPage;
    }


    public function setPage($page)
    {
        $this->currentPage = $page;

        return $this;
    }


    public function setTemplatePath($templatePath)
    {
        $this->templatePath = $templatePath;

        return $this;
    }

    public function getTemplatePath()
    {
        return $this->templatePath;
    }




}