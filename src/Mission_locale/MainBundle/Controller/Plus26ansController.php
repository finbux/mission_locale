<?php

namespace Mission_locale\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class Plus26ansController extends Controller
{
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();
        $items1 = $em->getRepository('MainBundle:Item')->find(30);
        $sous_items1 = $em->getRepository('MainBundle:SousItem')->findBy(array('category' => 30));
        $items2 = $em->getRepository('MainBundle:Item')->find(31);
        $sous_items2 = $em->getRepository('MainBundle:SousItem')->findBy(array('category' => 31));
        $items3 = $em->getRepository('MainBundle:Item')->find(32);
        $sous_items3 = $em->getRepository('MainBundle:SousItem')->findBy(array('category' => 32));
        $items4 = $em->getRepository('MainBundle:Item')->find(33);
        $sous_items4 = $em->getRepository('MainBundle:SousItem')->findBy(array('category' => 33));
        $encart = $em->getRepository('MainBundle:Encart')->find(4);
        return $this->render('MainBundle:Plus26:plus26.html.twig',
            array(
                    'item' => $items1,
                    'sous_items' => $sous_items1,
                    'items2' => $items2,
                    'sous_items2' => $sous_items2,
                    'item3' => $items3,
                    'sous_items3' => $sous_items3,
                    'items4' => $items4,
                    'sous_items4' => $sous_items4,
                    'encart' => $encart
                ));
    }
    public function categorieAction($slug26,$slug_sous_item26,$id26)
    {

        $em = $this->getDoctrine()->getManager();
        //On récupère tous les sous_items d'un item
        $sous_items = $em->getRepository('MainBundle:SousItem')->findBy(array('category' => $id26));
        //On récupère l'item
        $Item = $em->getRepository('MainBundle:Item')->find($id26);
        $sous_item_choisis = $em->getRepository('MainBundle:SousItem')->findOneBy(array('slug' => $slug_sous_item26));
        //Si on ne trouve pas les sous items on lève une execption
        if(!$sous_items || !$Item || !$sous_item_choisis)
        {
            throw $this->createNotFoundException("Cette page n'éxiste pas ");
        }
        //On récupère juste le nom de l'item
        $nom_item = $Item->getNameCategory();

        switch($slug26)
        {
            case "employeur1":
                return $this->render('MainBundle:categoryMoins26:emploi.html.twig',
                    array('sous_items' => $sous_items, 'nom_item' => $nom_item,'sous_item_choisis' => $sous_item_choisis));
                break;
            case "employeur2":
                return $this->render('MainBundle:categoryMoins26:etre_former.html.twig',
                    array('sous_items' => $sous_items,'nom_item' => $nom_item,'sous_item_choisis' => $sous_item_choisis));
                break;
            case "employeur3":
                return $this->render('MainBundle:categoryMoins26:quoi_faire.html.twig',
                    array('sous_items' => $sous_items,'nom_item' => $nom_item,'sous_item_choisis' => $sous_item_choisis));
                break;
            case "employeur4":
                return $this->render('MainBundle:categoryMoins26:quotidien.html.twig',
                    array('sous_items' => $sous_items,'nom_item' => $nom_item,'sous_item_choisis' => $sous_item_choisis));
                break;
            default: throw $this->createNotFoundException("Cette page n'éxiste pas ");

        }
    }
}
