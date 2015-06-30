<?php

namespace Mission_locale\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Mission_locale\AdminBundle\Entity\Actu;

class ActuController extends Controller
{
    public function showAction($slug_actu)
    {
        $em = $this->getDoctrine()->getManager();
        $actu = $em->getRepository('AdminBundle:Actu')->findOneBy(array('slug' => $slug_actu));

        return  $this->render('MainBundle:Actu:show.html.twig',array('actu' => $actu));
    }

    public function allArticlesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $actus =  $em->getRepository('AdminBundle:Actu')->allArticles();
        $last_actus = $em->getRepository('AdminBundle:Actu')->get3Last();
        return  $this->render('MainBundle:Actu:home.html.twig',array('actus' => $actus,'last_actus' => $last_actus));
    }
}