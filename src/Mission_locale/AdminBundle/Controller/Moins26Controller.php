<?php

namespace Mission_locale\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class Moins26Controller extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $categories = $em->getRepository('MainBundle:Category')->findAll();
        return $this->render('AdminBundle:admin_moins26:home.html.twig', array('categories' => $categories));
    }

    public function updateAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $item = $em->getRepository('MainBundle:Category')->find($id);
        if(!$item)
        {
            throw $this->createNotFoundException("La page n'existe pas");
        }
        $form = $this->createFormBuilder($item)
            ->add('nameCategory','text',array('label' => 'Nom de l\'item : '))
            ->add('modifier','submit')
            ->getForm();

        if($request->isMethod('POST')){
            $form->submit($request);

            if($form->isValid())
            {
                $em->flush();
                return $this->redirect($this->generateUrl('admin_moins26'));
            }
        }
        return $this->render('AdminBundle:admin_moins26:update.html.twig',
            array('item' => $item,'form' =>  $form->createView()));
    }
}
