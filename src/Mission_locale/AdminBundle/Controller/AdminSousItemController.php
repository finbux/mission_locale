<?php

namespace Mission_locale\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Mission_locale\MainBundle\Entity\SousItem;
use Mission_locale\AdminBundle\Form\SousItemType;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class AdminSousItemController extends Controller
{
    public function indexAction($id)
    {
        //On charge doctrine
        $em = $this->getDoctrine()->getManager();

        //On récupère le sous item par son id
        $sous_item = $em->getRepository('MainBundle:SousItem')->findBy(array('category' => $id));

        return $this->render('AdminBundle:Admin_sous_item:sous_item.html.twig',array('sous_items' => $sous_item));
    }

    //Action pour ajouter un sous item
    public function newAction(Request $request, $id)
    {
        //Création du fil d'arianne
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addRouteItem("Choisir une catégorie", "admin_categorie");
        $breadcrumbs->addRouteItem("Moins de 26 ans", "admin_moins26");
        $breadcrumbs->prependRouteItem("Accueil", "admin_homepage");

        //On instance un nouvel sous item
        $sous_item = new SousItem();

        //On creer le formulaire
        $form = $this->createForm(new SousItemType(), $sous_item);

        $em = $this->getDoctrine()->getManager();
        //On récupère l'item associé au sous item
        $item_assoc = $em->getRepository('MainBundle:Item')->find($id);

        //Si la methode POST est capturée
        if($request->isMethod('POST')){
            //Si les données du formulaire sont validées, on lie les données avec l'entité sous item
            if($form->handleRequest($request)->isValid())
            {
                //On lie le sous item avec l'item correspondant
                $sous_item->setCategory($item_assoc);
                //On persist l'objet
                $em->persist($sous_item);
                //On le save dans la bdd
                $em->flush();
                //On affiche un message flash pour informer l'utilisateur
                $this->get('session')->getFlashBag()->add('notice', 'Ajout réussi');
            }
        }
        //On affiche la vue avec le formulaire passé en paramètre
        return $this->render('AdminBundle:Admin_sous_item:new.html.twig',array('form' => $form->createView()));
    }

    //Action pour mettre à jour un sous itel
    public function updateAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        //On récupère le sous item à modifier
        $sousItem = $em->getRepository('MainBundle:SousItem')->find($id);

        //Si on ne trouve pas le sous item, on lève une exception
        if(!$sousItem)
        {
            throw $this->createNotFoundException("Le sous item n'existe pas");
        }

        //On crée le formulaire pour la modification
        $form = $this->createFormBuilder($sousItem)
            ->add('nomSousItem','text',array('label' => 'Nom du sous item : '))
            ->add('description','textarea', array('label' => 'Modifier la description',
                'attr' => array('class' => 'ckeditor')))
            ->add('modifier','submit', array('attr' => array('style' => 'float: right')))
            ->getForm();


        //Si la methode POST est capturée
        if($request->isMethod('POST')){
            //Si les données du formulaire sont validé, on lie les données avec l'entité sous item
            if($form->handleRequest($request)->isValid())
            {
                $id = $sousItem->getCategory()->getId();

                $em->flush();
                //On récupère l'url de la page précédente

                $this->get('session')->getFlashBag()->add('info', 'La modification a été effectuer');
                //On fait une redirection
                return $this->redirect($this->generateUrl('admin_sous_item', array('id' => $id)), 301);
            }
        }
        return $this->render('AdminBundle:Admin_sous_item:update.html.twig',array('form' => $form->createView()));
    }

    //Action pour supprimer un sous item
    public function deleteAction($id)
    {
        if (!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
            // Sinon on déclenche une exception « Accès interdit »
            throw new AccessDeniedException('Accès limité aux Administrateurs');
        }
        else
        {
            $em = $this->getDoctrine()->getManager();
            //On récupère le sous item à supprimer
            $sous_item = $em->getRepository('MainBundle:SousItem')->find($id);
            $id = $sous_item->getCategory()->getId();
            //Si on ne trouve pas le sous item, on lève une exception
            if(!$sous_item)
            {
                throw $this->createNotFoundException("Le sous item n'existe pas");
            }

            //On supprime l'objet sous item
            $em->remove($sous_item);
            //On sauvegarde la supression
            $em->flush();

            $this->get('session')->getFlashBag()->add('info', 'La suppression a bien été effectuer');

            return $this->redirect($this->generateUrl('admin_sous_item', array('id' => $id)), 301);
        }

    }
}
