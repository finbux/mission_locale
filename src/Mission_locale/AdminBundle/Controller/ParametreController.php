<?php

namespace Mission_locale\AdminBundle\Controller;

use Mission_locale\AdminBundle\Form\CgoType;
use Mission_locale\AdminBundle\Form\MentionLegalType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;

class ParametreController extends Controller
{
    public function cgoAction()
    {
        // On vérifie que l'utilisateur dispose bien du rôle ROLE_ADMIN
        if (!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
            // Sinon on déclenche une exception « Accès interdit »
            throw new AccessDeniedException('Accès limité aux Administrateurs.');
        }
        $em = $this->getDoctrine()->getManager();
        $cgo = $em->getRepository('MainBundle:Cgo')->findOneBy(array('id' => 1));
        $form = $this->createForm(new CgoType(),$cgo);
        return $this->render('AdminBundle:Parametre:cgo.html.twig', array(
           'form' => $form->createView(),
        ));
    }
    public function mention_legalAction(Request $request)
    {
        // On vérifie que l'utilisateur dispose bien du rôle ROLE_ADMIN
        if (!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
            // Sinon on déclenche une exception « Accès interdit »
            throw new AccessDeniedException('Accès limité aux Administrateurs.');
        }

        $em = $this->getDoctrine()->getManager();
        $mentionLegal = $em->getRepository('MainBundle:MentionLegal')->findOneBy(array('id' => 1));
        $form = $this->createForm(new MentionLegalType(),$mentionLegal);

        if($request->isMethod('POST'))
        {
            if($form->handleRequest($request)->isValid())
            {
                $em->persist($mentionLegal);

                $em->flush();
                $this->get('session')->getFlashBag()->add('notice', 'Modification réussi');
                return $this->redirect($this->generateUrl('admin_parametre'));
            }
        }

        return $this->render('AdminBundle:Parametre:mention_legal.html.twig', array(
           'form' => $form->createView(),
        ));
    }

}
