<?php

namespace Mission_locale\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Mission_locale\AdminBundle\Entity\Actu;

class ActuController extends Controller
{
    public function showAction($slug_actu)
    {
        $em = $this->getDoctrine()->getManager();
        $actu = $em->getRepository('AdminBundle:Actu')->findOneBy(array('slug' => $slug_actu));

        return  $this->render('MainBundle:Actu:show.html.twig',array('actu' => $actu));
    }

    public function allArticlesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $actus =  $em->getRepository('AdminBundle:Actu')->allArticles();

        $query = $em->createQuery(
            'SELECT a
            FROM AdminBundle:Actu a
            WHERE a.isPublished = 1
            OR a.isPublished = 2
            AND a.dateDebut <= :maVarDate
            ORDER BY a.id DESC'
        )
            ->setParameter('maVarDate',date("Y-m-d"))
            ->setMaxResults(3);

        $articles = $query->getResult();

        return  $this->render('MainBundle:Actu:home.html.twig',array('actus' => $actus,'last_actus' => $articles));
    }
}