<?php
namespace Mission_locale\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class SousItemController extends Controller
{

    public function indexAction($slug,$slug_sous_item,$id)
    {
        $em = $this->getDoctrine()->getManager();
        //On récupère tous les sous_items d'un item
        $sous_items = $em->getRepository('MainBundle:SousItem')->findBy(array('category' => $id));

        //On récupère l'item
        $Item = $em->getRepository('MainBundle:Item')->find($id);
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
                return $this->render('MainBundle:category:emploi.html.twig',
                    array('sous_items' => $sous_items, 'nom_item' => $nom_item,'sous_item_choisis' => $sous_item_choisis,'arianne' => "Moins de 26 ans"));
                break;
            case "etre-former":
                return $this->render('MainBundle:category:etre_former.html.twig',
                    array('sous_items' => $sous_items,'nom_item' => $nom_item,'sous_item_choisis' => $sous_item_choisis,'arianne' => "Moins de 26 ans"));
                break;
            case "quoi-faire":
                return $this->render('MainBundle:category:quoi_faire.html.twig',
                    array('sous_items' => $sous_items,'nom_item' => $nom_item,'sous_item_choisis' => $sous_item_choisis,'arianne' => "Moins de 26 ans"));
                break;
            case "quotidien":
                return $this->render('MainBundle:category:quotidien.html.twig',
                    array('sous_items' => $sous_items,'nom_item' => $nom_item,'sous_item_choisis' => $sous_item_choisis,'arianne' => "Moins de 26 ans"));
                break;
            case "plus261":
                return $this->render('MainBundle:category:emploi.html.twig',
                    array('sous_items' => $sous_items,'nom_item' => $nom_item,'sous_item_choisis' => $sous_item_choisis,'arianne' => "Plus de 26 ans"));
                break;
            case "plus262":
                return $this->render('MainBundle:category:quoi_faire.html.twig',
                    array('sous_items' => $sous_items,'nom_item' => $nom_item,'sous_item_choisis' => $sous_item_choisis,'arianne' => "Plus de 26 ans"));
                break;
            case "plus263":
                return $this->render('MainBundle:category:etre_former.html.twig',
                    array('sous_items' => $sous_items,'nom_item' => $nom_item,'sous_item_choisis' => $sous_item_choisis,'arianne' => "Plus de 26 ans"));
                break;
            case "plus264":
                return $this->render('MainBundle:category:quotidien.html.twig',
                    array('sous_items' => $sous_items,'nom_item' => $nom_item,'sous_item_choisis' => $sous_item_choisis,'arianne' => "Plus de 26 ans"));
                break;
            case "employeur1":
                return $this->render('MainBundle:category:emploi.html.twig',
                    array('sous_items' => $sous_items,'nom_item' => $nom_item,'sous_item_choisis' => $sous_item_choisis,'arianne' => "Employeur"));
                break;
            case "employeur2":
                return $this->render('MainBundle:category:quoi_faire.html.twig',
                    array('sous_items' => $sous_items,'nom_item' => $nom_item,'sous_item_choisis' => $sous_item_choisis,'arianne' => "Employeur"));
                break;
            case "employeur3":
                return $this->render('MainBundle:category:etre_former.html.twig',
                    array('sous_items' => $sous_items,'nom_item' => $nom_item,'sous_item_choisis' => $sous_item_choisis,'arianne' => "Employeur"));
                break;
            case "employeur4":
                return $this->render('MainBundle:category:quotidien.html.twig',
                    array('sous_items' => $sous_items,'nom_item' => $nom_item,'sous_item_choisis' => $sous_item_choisis,'arianne' => "Employeur"));
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