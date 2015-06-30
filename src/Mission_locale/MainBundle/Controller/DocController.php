<?php

namespace Mission_locale\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DocController extends Controller
{
    public function homeAction()
    {
        return  $this->render('MainBundle:Doc:home.html.twig');
    }
}
