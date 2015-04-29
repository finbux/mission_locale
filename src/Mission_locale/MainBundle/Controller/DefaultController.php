<?php

namespace Mission_locale\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MainBundle:Default:index.html.twig');
    }

    public function employeurAction()
    {
        return $this->render('MainBundle:employeur:employeur.html.twig');
    }

    public function antennesAction()
    {
        return $this->render('MainBundle:Default:antennes.html.twig');
    }
}
