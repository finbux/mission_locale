<?php

namespace Mission_locale\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Mission_locale\MainBundle\Entity\Offre;

class OffreController extends Controller
{
   public function getOffreAction($slug)
   {
       $em = $this->getDoctrine()->getManager();
       $offre = $em->getRepository('MainBundle:Offre')->findOneBy(array('slug' => $slug));
       return  $this->render('MainBundle:Offre:show.html.twig',array('offre' => $offre));
   }

    public function getAllOffreAction()
    {
        $em = $this->getDoctrine()->getManager();
        $offres = $em->getRepository('MainBundle:Offre')->getHalfOffre();
        $lastOffres = $em->getRepository('MainBundle:Offre')->getLastOffre();

        return  $this->render('MainBundle:Offre:all.html.twig',array('offres' => $offres,'last_offre' => $lastOffres));
    }
}