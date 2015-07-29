<?php

namespace Mission_locale\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class Moins26ansController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        //On récupère les différentes catégories
        $categorieEmploi = $em->getRepository('MainBundle:Item')->find(25);
        $categorieFormer = $em->getRepository('MainBundle:Item')->find(26);
        $categorieFaire = $em->getRepository('MainBundle:Item')->find(27);
        $categorieQuotidien = $em->getRepository('MainBundle:Item')->find(28);
        $encart = $em->getRepository('MainBundle:Encart')->find(2);

        //On récupère les diffrents sous items
        $repositorySousItem = $em->getRepository('MainBundle:SousItem');
        $emploi_sous_item = $repositorySousItem->findBy(
            array('category' => 25 )
        );

        $former_sous_item = $repositorySousItem->findBy(
            array('category' => 26)
        );

        $faire_sous_item = $repositorySousItem->findBy(
            array('category' => 27)
        );

        $quotidien_sous_item = $repositorySousItem->findBy(
            array('category' => 28)
        );

        //On retorune la vue avec toutes les données récupéré
        return $this->render('MainBundle:moins26:moins26.html.twig',
            array(
                'categorie_emploi' => $categorieEmploi,
                'categorie_former' => $categorieFormer,
                'categorie_faire' => $categorieFaire,
                'categorie_quotidien' => $categorieQuotidien,
                'list_emploi_sousItem' => $emploi_sous_item,
                'list_former_sousItem' => $former_sous_item,
                'list_faire_sousItem' => $faire_sous_item,
                'list_quotidien_sousItem' => $quotidien_sous_item,
                'encart' => $encart
            )
        );
    }

}
