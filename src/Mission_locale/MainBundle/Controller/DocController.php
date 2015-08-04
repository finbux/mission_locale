<?php

namespace Mission_locale\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DocController extends Controller
{
    public function homeAction()
    {
        $em = $this->getDoctrine()->getManager();
        $docs = $em->getRepository('AdminBundle:Doc')->findAll();
        return  $this->render('MainBundle:doc:home.html.twig',array('docs' => $docs));
    }


}
