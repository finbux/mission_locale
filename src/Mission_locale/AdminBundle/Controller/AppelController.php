<?php

namespace Mission_locale\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AppelController extends Controller
{
    public function showAction()
    {
        return $this->render('AdminBundle:Appel:appel.html.twig');
    }

    public function updateAction()
    {

    }

    public function deleteAction()
    {

    }
}
