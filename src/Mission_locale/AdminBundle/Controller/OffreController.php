<?php

namespace Mission_locale\AdminBundle\Controller;

use Mission_locale\MainBundle\Entity\Offre;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Mission_locale\AdminBundle\Form\OffreType;


class OffreController extends Controller
{
    public function showAction()
    {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addRouteItem("Choisir un module", "admin_modules");
        $breadcrumbs->addRouteItem("Les offres", "offre_show");
        $breadcrumbs->prependRouteItem("Accueil", "admin_homepage");

        $em = $this->getDoctrine()->getManager();
        $offres = $em->getRepository('MainBundle:Offre')->findAll();

        return $this->render('AdminBundle:Offre:show.html.twig', array('offres' => $offres));

    }

    public function addAction(Request $request)
    {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addRouteItem("Choisir un module", "admin_modules");
        $breadcrumbs->addRouteItem("Les offres", "offre_show");
        $breadcrumbs->addItem("Ajouter un module");
        $breadcrumbs->prependRouteItem("Accueil", "admin_homepage");

        $offre = new Offre();
        $formOffre = $this->createForm(new OffreType(), $offre);

        if($request->isMethod('POST'))
        {
            if($formOffre->handleRequest($request)->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($offre);
                $em->flush();
                $this->get('session')->getFlashBag()->add('notice', 'Ajout réussi');
                return $this->redirect($this->generateUrl('offre_show'));
            }
        }
        return $this->render('AdminBundle:Offre:add.html.twig',array('form' => $formOffre->createView()));
    }

    public function editAction(Request $request, $id)
    {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addRouteItem("Choisir un module", "admin_modules");
        $breadcrumbs->addRouteItem("Les offres", "offre_show");
        $breadcrumbs->addItem("Modifier une offre");
        $breadcrumbs->prependRouteItem("Accueil", "admin_homepage");

        $em = $this->getDoctrine()->getManager();
        $offre = $em->getRepository('MainBundle:Offre')->findOneBy(array('id' => $id));

        if(!$offre)
        {
            throw $this->createNotFoundException("L'offre n'existe pas");
        }
        $form = $this->createForm(new OffreType(), $offre);
        //Si la methode POST est capturée
        if($request->isMethod('POST'))
        {
            //Si les données du formulaire sont validé, on lie les données avec l'entité sous item
            if($form->handleRequest($request)->isValid())
            {
                //On sauvegarde les modifs
                $em->flush();
                $this->get('session')->getFlashBag()->add('notice', 'Modification réussi');
                return $this->redirect($this->generateUrl('offre_show'));
            }
        }
        return $this->render('AdminBundle:Offre:edit.html.twig',array('form' => $form->createView()));
    }

    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        //On récupère l'appel par l'id
        $offre = $em->getRepository('MainBundle:Offre')->find($id);

        //Si l'appel n'existe pas
        if(!$offre)
        {
            throw $this->createNotFoundException("L'offre n'existe pas");
        }

        //On supprime l'appel
        $em->remove($offre);
        //On save la suppression
        $em->flush();

        return $this->redirect($this->generateUrl('offre_show'));
    }
}