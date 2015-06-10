<?php

namespace Mission_locale\AdminBundle\Controller;

use Mission_locale\AdminBundle\Entity\Antenne;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Mission_locale\AdminBundle\Form\AntenneType;
use Symfony\Component\HttpFoundation\Request;

class AntenneController extends Controller
{

    public function showAction()
    {
        $em = $this->getDoctrine()->getManager();
        $antennes = $em->getRepository('AdminBundle:Antenne')->findAll();
        //$this->createXmlAction();
        return $this->render('AdminBundle:antenne:show.html.twig',array('antennes' => $antennes));
    }

    public function createXmlAction()
    {
        $dom = New \DOMDocument("1.0");
        $node = $dom->createElement("markers");
        $parnode = $dom->appendChild($node);
        //header("Content-type: text/xml");
        $em = $this->getDoctrine()->getManager();
        $antennes = $em->getRepository('AdminBundle:Antenne')->findAll();
    }

    public function addAction(Request $request)
    {
        $antenne = new Antenne();
        $formAntenne = $this->createForm(new AntenneType(),$antenne);

        if($request->isMethod('POST'))
        {
            if($formAntenne->handleRequest($request)->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($antenne);
                $em->flush();
                $this->get('session')->getFlashBag()->add('notice', 'Ajout réussi');
                return $this->redirect($this->generateUrl('admin_antenne'));
            }
        }
        return $this->render('AdminBundle:antenne:add.html.twig',array('form' => $formAntenne->createView()));
    }

    public function updateAction()
    {
        return $this->render('AdminBundle:antenne:update.html.twig');
    }

    public function deleteAction()
    {
        return $this->render('AdminBundle:antenne:delete.html.twig');
    }

}
