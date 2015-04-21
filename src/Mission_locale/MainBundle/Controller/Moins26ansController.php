<?php

namespace Mission_locale\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class Moins26ansController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        //On récupère les différentes catégories
        $categorieEmploi = $em->getRepository('MainBundle:Category')->find(25);
        $categorieFormer = $em->getRepository('MainBundle:Category')->find(26);
        $categorieFaire = $em->getRepository('MainBundle:Category')->find(27);
        $categorieQuotidien = $em->getRepository('MainBundle:Category')->find(28);

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
            ));
    }
    public function categorieAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $sous_item  = $em->getRepository('MainBundle:SousItem');

        $emploi_sous_item = $sous_item->findBy(
            array('category' => 25 )
        );

        $former_sous_item = $sous_item->findBy(
            array('category' => 26)
        );

        $faire_sous_item = $sous_item->findBy(
            array('category' => 27)
        );

        $quotidien_sous_item = $sous_item->findBy(
            array('category' => 28)
        );

        //Selon le slug qu'on récupère
        switch($slug)
        {
            case "emploi":
                return $this->render('MainBundle:categoryMoins26:emploi.html.twig',array('list_emploi' => $emploi_sous_item));
                break;
            case "etre-former":
                return $this->render('MainBundle:categoryMoins26:etre_former.html.twig', array('list_former' => $former_sous_item));
                break;
            case "quoi-faire":
                return $this->render('MainBundle:categoryMoins26:quoi_faire.html.twig',array('list_faire' => $faire_sous_item));
                break;
            case "quotidien":
                return $this->render('MainBundle:categoryMoins26:quotidien.html.twig', array('list_quotidien' => $quotidien_sous_item));
                break;
        }
    }

    public function getDescriptionAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $sous_item  = $em->getRepository('MainBundle:SousItem');

        $sous_item_description = $sous_item->findOneBy(array('id'=>$id));
       if($sous_item_description){
           $description = $sous_item_description->getDescription();
       }
        else
        {
            $description = null;
        }

       $reponse = new JsonResponse();
        return $reponse->setData(array('description' => $description));
    }
}
