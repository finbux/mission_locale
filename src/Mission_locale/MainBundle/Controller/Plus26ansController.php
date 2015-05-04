<?php

namespace Mission_locale\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class Plus26ansController extends Controller
{
    public function indexAction()
    {
        return $this->render('MainBundle:plus26:plus26.html.twig');
    }
}
