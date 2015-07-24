<?php

namespace Mission_locale\AdminBundle\Controller;

use Mission_locale\AdminBundle\Form\EncartType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;

class EncartController extends Controller
{
    public function homeAction()
    {
        $em = $this->getDoctrine()->getManager();
        $encarts = $em->getRepository('MainBundle:Encart')->findAll();

        return $this->render('AdminBundle:Encart:home.html.twig',array('encarts' => $encarts));
    }

    public function updateAction(Request $request, $id)
    {
        if (!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
            // Sinon on déclenche une exception « Accès interdit »
            throw new AccessDeniedException('Accès limité aux Administrateurs');
        }
        $em = $this->getDoctrine()->getManager();
        $encart = $em->getRepository('MainBundle:Encart')->find($id);
        if(!$encart)
        {
            throw $this->createNotFoundException("L'offre n'existe pas");
        }
        $form = $this->createForm(new EncartType(), $encart);
        //Si la methode POST est capturée
        if($request->isMethod('POST'))
        {
            //Si les données du formulaire sont validé, on lie les données avec l'entité sous item
            if($form->handleRequest($request)->isValid())
            {
                $em->flush();
                $this->get('session')->getFlashBag()->add('notice', 'Modification réussi');
                return $this->redirect($this->generateUrl('admin_encart'));
            }
        }
        return $this->render('AdminBundle:Encart:update.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
