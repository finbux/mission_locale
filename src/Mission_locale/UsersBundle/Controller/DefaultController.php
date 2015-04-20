<?php

namespace Mission_locale\UsersBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('UsersBundle:Default:index.html.twig', array('name' => $name));
    }
}
