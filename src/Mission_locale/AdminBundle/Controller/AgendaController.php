<?php

namespace Mission_locale\AdminBundle\Controller;

use Mission_locale\AdminBundle\Form\AgendaType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class AgendaController extends Controller
{
    public function indexAction(Request $request)
    {
        if (!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
            // Sinon on déclenche une exception « Accès interdit »
            throw new AccessDeniedException('Accès limité aux Administrateurs');
        }
        $em = $this->getDoctrine()->getManager();
        $agenda = $em->getRepository('AdminBundle:Agenda')->getAgenda();
        $form = $this->createForm(new AgendaType(), $agenda);
        if($request->isMethod('POST'))
        {

            if($form->handleRequest($request)->isValid())
            {
                $em->persist($agenda);

                $em->flush();
                $this->get('session')->getFlashBag()->add('notice', 'Modification réussi');
                return $this->redirect($this->generateUrl('admin_agenda'));
            }
        }
        return $this->render('AdminBundle:Agenda:index.html.twig',array('agenda' => $agenda,'form' => $form->createView()));
    }
}
