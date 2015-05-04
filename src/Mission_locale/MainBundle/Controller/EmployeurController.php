<?php

namespace Mission_locale\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class EmployeurController extends Controller
{
    public function indexAction()
    {
        return $this->render('MainBundle:Employeur:employeur.html.twig');
    }
}
