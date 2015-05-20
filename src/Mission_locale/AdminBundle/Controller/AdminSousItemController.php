<?php

namespace Mission_locale\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
class AdminSousItemController extends Controller
{
    public function indexAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $sous_item = $em->getRepository('MainBundle:SousItem')->findBy(array('category' => $id));
        return $this->render('AdminBundle:admin_sous_item:sous_item.html.twig',array('sous_items' => $sous_item));
    }

    public function newAction()
    {
        return $this->render('AdminBundle:admin_sous_item:new.html.twig');
    }

    public function updateAction(Request $request,$id)
    {
        return $this->render('AdminBundle:admin_sous_item:update.html.twig');
    }
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $sous_item = $em->getRepository('MainBundle:SousItem')->find($id);

        if(!$sous_item)
        {
            throw $this->createNotFoundException("Le sous item n'existe pas");
        }

        $em->remove($sous_item);
        $em->flush();

        $referer = $request->headers->get('referer');
        return $this->redirect($referer);
    }
}
