<?php
namespace Mission_locale\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller{

    public function indexAction()
    {
        return $this->render('AdminBundle:admin:home.html.twig');
    }
    public function categorieAction()
    {
        //Création du fil d'arianne
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        //Ajout des routes au fil d'arianne
        $breadcrumbs->addRouteItem("Choisir une catégorie", "admin_categorie");
        $breadcrumbs->prependRouteItem("Accueil", "admin_homepage");

        // Pass "_demo_hello" route name with parameters
        /*$breadcrumbs->addRouteItem("Hello Breadcrumbs", "_demo_hello", array(
            'name' => 'Breadcrumbs',
        ));*/

        //On affiche la vue
        return $this->render('AdminBundle:categorie:index.html.twig');
    }

    public function moduleAction()
    {
        return $this->render('AdminBundle:module:home.html.twig');
    }
}