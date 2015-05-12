<?php
namespace Mission_locale\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller{

    public function indexAction()
    {
        return $this->render('AdminBundle:admin:home.html.twig');
    }
    public function categorieAction()
    {
        return $this->render('AdminBundle:admin:categorie.html.twig');
    }

    public function moins26Action()
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('MainBundle:Category')->findAll();
        return $this->render('AdminBundle:admin_moins26:home.html.twig', array('categories' => $categories));
    }
    public function moduleAction()
    {
        return $this->render('AdminBundle:module:home.html.twig');
    }
}