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
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        // Pass "_demo" route name without any parameters
        $breadcrumbs->addRouteItem("Accueil", "admin_homepage");

        // Pass "_demo_hello" route name with parameters
        /*$breadcrumbs->addRouteItem("Hello Breadcrumbs", "_demo_hello", array(
            'name' => 'Breadcrumbs',
        ));*/

        // Add "homepage" route link to begin of breadcrumbs
       // $breadcrumbs->prependRouteItem("Home", "admin_homepage");
        return $this->render('AdminBundle:categorie:index.html.twig');
    }

    public function moduleAction()
    {
        return $this->render('AdminBundle:module:home.html.twig');
    }
}