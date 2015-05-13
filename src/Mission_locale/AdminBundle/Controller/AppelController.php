<?php

namespace Mission_locale\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Mission_locale\AdminBundle\Form\AppelType;
use Mission_locale\MainBundle\Entity\AppelRepository;

class AppelController extends Controller
{
    private function create_form_filter()
    {
        $data = array();
        $form = $this->createFormBuilder($data)
            ->add('Filtrer','choice',
                array('choices' => array(
                    'A contacter' => 'A contacter',
                    'Message laissé' => 'Message laissé',
                    'RDV fixé' => 'RDV fixé',
                    'Renseigné' => 'Renseigné',
                    'tout' => 'Tous'
                ),
                    'preferred_choices' => array('tout'))
                ,array('attr' => array('class' => 'btn_ok')))

            ->add('ok','submit',array('attr' => array('class' => 'btn_ok')))
            ->setAction($this->generateUrl('admin_appel'))
            ->getForm();
        return $form;
    }
    public function showAction(Request $request)
    {
        $form = $this->create_form_filter();
        $em = $this->getDoctrine()->getManager();
        $appels = $em->getRepository('MainBundle:Appel')->findAll();

        if($request->isMethod('POST'))
        {
            $form->submit($request);
            if($form['Filtrer']->getData() == 'tout')
            {
                $appels = $em->getRepository('MainBundle:Appel')->findAll();
                return $this->render('AdminBundle:Appel:appel.html.twig',array('appels' => $appels, 'form' => $form->createView()));
            }

            $appels = $em->getRepository('MainBundle:Appel')->filter($form['Filtrer']->getData());

            return $this->render('AdminBundle:Appel:appel.html.twig',array('appels' => $appels, 'form' => $form->createView()));
        }
        return $this->render('AdminBundle:Appel:appel.html.twig',array('appels' => $appels, 'form' => $form->createView()));

    }

    public function updateAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $appel = $em->getRepository('MainBundle:Appel')->findOneBy(array('id' => $id));

        if(!$appel)
        {
            throw $this->createNotFoundException("L'appel n'existe pas");
        }
        $form = $this->createForm(new AppelType(), $appel);
        if($request->isMethod('POST')){
            $form->submit($request);
            if($form->isValid())
            {
                $appelEdit = $form->getData();
                $em->flush();
                return $this->redirect($this->generateUrl('admin_appel'));
            }
        }
        return $this->render('AdminBundle:Appel:update.html.twig',array('appel' => $appel, 'form' => $form->createView()));
    }
    public function editAction()
    {

    }

    public function filtrerAction($request,$em,$form)
    {

    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $appel = $em->getRepository('MainBundle:Appel')->find($id);

        if(!$appel)
        {
            throw $this->createNotFoundException("L'appel n'existe pas");
        }

        $em->remove($appel);
        $em->flush();

        return $this->redirect($this->generateUrl('admin_appel'));
    }
}
