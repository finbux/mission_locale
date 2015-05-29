<?php

namespace Mission_locale\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class AntenneController extends Controller
{

    public function showAction()
    {
        $em = $this->getDoctrine()->getManager();
        $antennes = $em->getRepository('AdminBundle:Antenne')->findAll();

        return $this->render('AdminBundle:antenne:show.html.twig',array('antennes' => $antennes));
    }
    /**
     * @Route("/update")
     * @Template()
     */
    public function updateAction()
    {
        return array(
                // ...
            );    }

    /**
     * @Route("/delete")
     * @Template()
     */
    public function deleteAction()
    {
        return array(
                // ...
            );    }

}
