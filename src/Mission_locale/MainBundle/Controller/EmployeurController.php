<?php

namespace Mission_locale\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class EmployeurController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $items1 = $em->getRepository('MainBundle:Item')->find(34);
        $sous_items1 = $em->getRepository('MainBundle:SousItem')->findBy(array('category' => 34));
        $items2 = $em->getRepository('MainBundle:Item')->find(35);
        $sous_items2 = $em->getRepository('MainBundle:SousItem')->findBy(array('category' => 35));
        $items3 = $em->getRepository('MainBundle:Item')->find(36);
        $sous_items3 = $em->getRepository('MainBundle:SousItem')->findBy(array('category' => 36));
        $items4 = $em->getRepository('MainBundle:Item')->find(37);
        $sous_items4 = $em->getRepository('MainBundle:SousItem')->findBy(array('category' => 37));
        return $this->render('MainBundle:Employeur:employeur.html.twig',
            array(
                'item' => $items1,
                'sous_items' => $sous_items1,
                'items2' => $items2,
                'sous_items2' => $sous_items2,
                'item3' => $items3,
                'sous_items3' => $sous_items3,
                'items4' => $items4,
                'sous_items4' => $sous_items4,
            ));

    }
}
