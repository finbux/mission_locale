<?php

namespace Mission_locale\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class AdminSousItemController extends Controller
{
    public function indexAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $sous_item = $em->getRepository('MainBundle:SousItem')->findBy(array('category' => $id));
        return $this->render('AdminBundle:admin_sous_item:sous_item.html.twig',array('sous_items' => $sous_item));
    }
}
