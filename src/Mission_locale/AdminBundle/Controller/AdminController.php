<?php
namespace Mission_locale\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller{

    public function indexAction()
    {
        return $this->render('AdminBundle:admin:home.html.twig');
    }
}