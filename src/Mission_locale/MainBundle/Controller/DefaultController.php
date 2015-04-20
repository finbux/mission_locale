<?php

namespace Mission_locale\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
//use Mission_locale\AdminBundle\Entity\ItemCategorie;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MainBundle:Default:index.html.twig');
        /*$content = $this
                ->get('templating')
                ->render('MainBundle:Default:index.html.twig', array(
                    'nom' => 'moi'
            )
        );*/

        //return new Response($content);

    }
    public function moins26Action()
    {
        $repositoryItem = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AdminBundle:ItemCategorie')
        ;

        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AdminBundle:SousItem')
        ;

        $emploi_sous_item = $repository->findBy(
            array('itemCategorie' => 1)
        );

        $former_sous_item = $repository->findBy(
            array('itemCategorie' => 2)
        );

        $faire_sous_item = $repository->findBy(
            array('itemCategorie' => 3)
        );

        $quotidien_sous_item = $repository->findBy(
            array('itemCategorie' => 4)
        );

       $itemEmploi = $repositoryItem->find(1);
       $itemFormer = $repositoryItem->find(2);
        $itemFaire = $repositoryItem->find(3);
        $itemQuotidien = $repositoryItem->find(4);

        return $this->render('MainBundle:moins26:moins26.html.twig',
            array(
                'item_emploi' => $itemEmploi,
                'list_emploi' => $emploi_sous_item,
                'list_former' => $former_sous_item,
                'item_former' => $itemFormer,
                'item_faire' => $itemFaire,
                'list_faire' => $faire_sous_item,
                'item_quotidien' => $itemQuotidien,
                'list_quotidien' => $quotidien_sous_item
            ));
    }

    public function getDescriptionAction(Request $request)
    {
       $data = $request->query->get('id_item');

        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AdminBundle:SousItem')
        ;
        $description = $repository->findBy(
            array('id' => $data)
        );
        return $description;
    }

    public function employeurAction()
    {
        return $this->render('MainBundle:employeur:employeur.html.twig');
    }

    public function antennesAction()
    {
        return $this->render('MainBundle:Default:antennes.html.twig');
    }

    public function categorieAction($slug)
    {
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AdminBundle:SousItem')
        ;
        $repository_sous_item = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AdminBundle:SousItem')
        ;
        $emploi_sous_item = $repository->findBy(
            array('itemCategorie' => 1)
        );

        $former_sous_item = $repository->findBy(
            array('itemCategorie' => 2)
        );

        $faire_sous_item = $repository->findBy(
            array('itemCategorie' => 3)
        );

        $quotidien_sous_item = $repository->findBy(
            array('itemCategorie' => 4)
        );

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
}
