<?php
namespace Mission_locale\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller{

    public function indexAction()
    {
        return $this->render('AdminBundle:admin:home.html.twig');
    }
    public function categorieAction()
    {
        return $this->render('AdminBundle:categorie:index.html.twig');
    }

    public function moduleAction()
    {
        return $this->render('AdminBundle:module:home.html.twig');
    }
}