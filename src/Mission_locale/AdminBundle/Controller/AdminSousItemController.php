<?php

namespace Mission_locale\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Mission_locale\MainBundle\Entity\SousItem;
use Mission_locale\AdminBundle\Form\SousItemType;

class AdminSousItemController extends Controller
{
    public function indexAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $sous_item = $em->getRepository('MainBundle:SousItem')->findBy(array('category' => $id));
        return $this->render('AdminBundle:admin_sous_item:sous_item.html.twig',array('sous_items' => $sous_item));
    }

    public function newAction(Request $request, $id)
    {
        $sous_item = new SousItem();
        $form = $this->createForm(new SousItemType(), $sous_item);
        $em = $this->getDoctrine()->getManager();
        $item_assoc = $em->getRepository('MainBundle:Category')->find($id);

        if($request->isMethod('POST')){


            if($form->handleRequest($request)->isValid())
            {
                $sous_item->setSlug('test');
                $sous_item->setCategory($item_assoc);
                $em->persist($sous_item);
                $em->flush();
            }
        }

        return $this->render('AdminBundle:admin_sous_item:new.html.twig',array('form' => $form->createView()));
    }

    public function updateAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $sousItem = $em->getRepository('MainBundle:SousItem')->find($id);

        if(!$sousItem)
        {
            throw $this->createNotFoundException("Le sous item n'existe pas");
        }

        $form = $this->createFormBuilder($sousItem)
            ->add('nomSousItem','text',array('label' => 'Nom du sous item : '))
            ->add('modifier','submit')
            ->getForm();

        if($request->isMethod('POST')){
            $form->submit($request);

            if($form->isValid())
            {
                $em->flush();
                $referer = $request->headers->get('referer');
                return $this->redirect($referer);
            }
        }
        return $this->render('AdminBundle:admin_sous_item:update.html.twig',array('form' => $form->createView()));
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
