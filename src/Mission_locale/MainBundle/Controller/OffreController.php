<?php

namespace Mission_locale\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class OffreController extends Controller
{
    public function showAction()
    {
        return $this->render('MainBundle:Offre:show.html.twig', array(
                // ...
            ));    }

    public function addAction()
    {
        return $this->render('MainBundle:Offre:add.html.twig', array(
                // ...
            ));    }

    public function editAction()
    {
        return $this->render('MainBundle:Offre:edit.html.twig', array(
                // ...
            ));    }

    public function deleteAction()
    {
        return $this->render('MainBundle:Offre:delete.html.twig', array(
                // ...
            ));    }

}
