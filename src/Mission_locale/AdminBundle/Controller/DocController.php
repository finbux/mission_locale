<?php

namespace Mission_locale\AdminBundle\Controller;

use Mission_locale\AdminBundle\Entity\Doc;
use Mission_locale\AdminBundle\Form\DocType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;

class DocController extends Controller
{
    public function homeAction()
    {
        $em = $this->getDoctrine()->getManager();
        $docs = $em->getRepository('AdminBundle:Doc')->findAll();

        return $this->render('AdminBundle:Doc:home.html.twig',array('docs' => $docs));
    }

    public function addAction(Request $request)
    {
        if (!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
            // Sinon on déclenche une exception « Accès interdit »
            throw new AccessDeniedException('Accès limité aux Administrateurs');
        }
        $doc = new Doc();
        $form = $this->createForm(new DocType(),$doc);

        if($request->isMethod('POST'))
        {
            if($form->handleRequest($request)->isValid())
            {
                $em = $this->getDoctrine()->getManager();

                $em->persist($doc);
                $em->flush();
                $this->get('session')->getFlashBag()->add('notice', 'Ajout réussi');
                return $this->redirect($this->generateUrl('admin_doc'));
            }
        }
        return $this->render('AdminBundle:Doc:add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function updateAction(Request $request, $id)
    {
        if (!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
            // Sinon on déclenche une exception « Accès interdit »
            throw new AccessDeniedException('Accès limité aux Administrateurs');
        }
        $em = $this->getDoctrine()->getManager();
        $doc = $em->getRepository('AdminBundle:Doc')->find($id);
        if(!$doc)
        {
            throw $this->createNotFoundException("L'offre n'existe pas");
        }
        $form = $this->createForm(new DocType(), $doc);
        //Si la methode POST est capturée
        if($request->isMethod('POST'))
        {
            //Si les données du formulaire sont validé, on lie les données avec l'entité sous item
            if($form->handleRequest($request)->isValid())
            {
                $em->flush();
                $this->get('session')->getFlashBag()->add('notice', 'Modification réussi');
                return $this->redirect($this->generateUrl('admin_doc'));
            }
        }
        return $this->render('AdminBundle:Doc:update.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function deleteAction($id)
    {
        if (!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
            // Sinon on déclenche une exception « Accès interdit »
            throw new AccessDeniedException('Accès limité aux Administrateurs');
        }
        else{
            $em = $this->getDoctrine()->getManager();
            $doc = $em->getRepository('AdminBundle:Doc')->find($id);
            if (!$doc) {
                throw $this->createNotFoundException("L'actualité n'existe pas");
            }
            $em->remove($doc);
            //On save la suppression
            $em->flush();

            return $this->redirect($this->generateUrl('admin_doc'));
        }
    }
}
