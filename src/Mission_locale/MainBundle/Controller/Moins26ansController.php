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
            )
        );
    }

    public function categorieAction($slug,$slug_sous_item,$id)
    {
        $em = $this->getDoctrine()->getManager();
        //On récupère tous les sous_items d'un item
        $sous_items = $em->getRepository('MainBundle:SousItem')->findBy(array('category' => $id));
        //On récupère l'item
        $Item = $em->getRepository('MainBundle:Category')->find($id);
        $sous_item_choisis = $em->getRepository('MainBundle:SousItem')->findOneBy(array('slug' => $slug_sous_item));
        //Si on ne trouve pas les sous items on lève une execption
        if(!$sous_items || !$Item || !$sous_item_choisis)
        {
            throw $this->createNotFoundException("Cette page n'éxiste pas ");
        }
        //On récupère juste le nom de l'item
        $nom_item = $Item->getNameCategory();

        //Selon le slug qu'on récupère on affiche la liste correspondante
        switch($slug)
        {
            case "emploi":
                return $this->render('MainBundle:categoryMoins26:emploi.html.twig',
                    array('sous_items' => $sous_items, 'nom_item' => $nom_item,'sous_item_choisis' => $sous_item_choisis));
                break;
            case "etre-former":
                return $this->render('MainBundle:categoryMoins26:etre_former.html.twig',
                    array('sous_items' => $sous_items,'nom_item' => $nom_item,'sous_item_choisis' => $sous_item_choisis));
                break;
            case "quoi-faire":
                return $this->render('MainBundle:categoryMoins26:quoi_faire.html.twig',
                    array('sous_items' => $sous_items,'nom_item' => $nom_item,'sous_item_choisis' => $sous_item_choisis));
                break;
            case "quotidien":
                return $this->render('MainBundle:categoryMoins26:quotidien.html.twig',
                    array('sous_items' => $sous_items,'nom_item' => $nom_item,'sous_item_choisis' => $sous_item_choisis));
                break;
            default: throw $this->createNotFoundException("Cette page n'éxiste pas ");

        }
    }

    public function getDescriptionAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $sous_item  = $em->getRepository('MainBundle:SousItem');

        $sous_item_description = $sous_item->findOneBy(array('id'=>$id));
       if(!$sous_item_description)
       {
           $description = null;
       }
        else
        {
            $name_sous_item = $sous_item_description->getNomSousItem();
            $description = $sous_item_description->getDescription();

        }

       $reponse = new JsonResponse();
        return $reponse->setData(array('description' => $description, 'name_sous_item' => $name_sous_item));
    }
}
