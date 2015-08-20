<?php

namespace Mission_locale\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class Moins26Controller extends Controller
{

    public function indexAction()
    {
        //Création du fil d'arianne
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addRouteItem("Choisir une catégorie", "admin_categorie");
        $breadcrumbs->addRouteItem("Moins de 26 ans", "admin_moins26");
        $breadcrumbs->prependRouteItem("Accueil", "admin_homepage");
        $em = $this->getDoctrine()->getManager();
        //On récupère toutes les catégories
        $items = $em->getRepository('MainBundle:Item')->findBy(array('categorie' => 'moins26'));
        return $this->render('AdminBundle:Categorie/Moins26:home.html.twig', array('categories' => $items));
    }

    //Action pour modifier le titre de l'item
    public function updateAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        //On récupère l'item à modifier
        $item = $em->getRepository('MainBundle:Item')->find($id);
        //Si on ne trouve pas le item, on lève une exception
        if(!$item)
        {
            throw $this->createNotFoundException("La page n'existe pas");
        }
        //Création du formulaire pour la modification
        $form = $this->createFormBuilder($item)
            ->add('nameCategory','text',array('label' => 'Nom de l\'item : '))
            ->add('modifier','submit',array('attr' => array('style' => 'float: right')))
            ->getForm();

        //Si la methode POST est capturée
        if($request->isMethod('POST')){
            $form->submit($request);
            //Si les données du formulaire son valides
            if($form->isValid())
            {
                $em->flush();
                $this->get('session')->getFlashBag()->add('info', 'La modification a été effectuée');
                return $this->redirect($this->generateUrl('admin_moins26'));
            }
        }
        //On retourne la vue avec le formulaire
        return $this->render('AdminBundle:Categorie/moins26:update.html.twig',
            array('item' => $item,'form' =>  $form->createView()));
    }
}
