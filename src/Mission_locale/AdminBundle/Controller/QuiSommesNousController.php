<?php

namespace Mission_locale\AdminBundle\Controller;

use Mission_locale\AdminBundle\Form\QuiSommesNousType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class QuiSommesNousController extends Controller
{
    public function indexAction(Request $request)
    {
        if (!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
            // Sinon on déclenche une exception « Accès interdit »
            throw new AccessDeniedException('Accès limité aux Administrateurs');
        }
        $em = $this->getDoctrine()->getManager();
        $quiSommesNous = $em->getRepository('MainBundle:QuiSommesNous')->findOneBy(array('id' => 1));
        $form = $this->createForm(new QuiSommesNousType(), $quiSommesNous);
        if($request->isMethod('POST'))
        {
            if($form->handleRequest($request)->isValid())
            {
                $em->persist($quiSommesNous);

                $em->flush();
                $this->get('session')->getFlashBag()->add('notice', 'Modification réussi');
                return $this->redirect($this->generateUrl('admin_qsn'));
            }
        }
        return $this->render('AdminBundle:QuiSommesNous:index.html.twig',array('form' => $form->createView()));
    }
}
