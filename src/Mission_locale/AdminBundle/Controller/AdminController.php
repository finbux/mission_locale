<?php
namespace Mission_locale\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class AdminController extends Controller{

    public function indexAction()
    {
        return $this->render('AdminBundle:admin:home.html.twig');
    }
    public function categorieAction()
    {
        if (!$this->get('security.context')->isGranted('ROLE_MODERATEUR')) {
            // Sinon on déclenche une exception « Accès interdit »
            throw new AccessDeniedException('Accès limité aux Modérateurs et Administrateurs.');
        }
        //Création du fil d'arianne
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        //Ajout des routes au fil d'arianne
        $breadcrumbs->addRouteItem("Choisir une catégorie", "admin_categorie");
        $breadcrumbs->prependRouteItem("Accueil", "admin_homepage");

        //On affiche la vue
        return $this->render('AdminBundle:categorie:index.html.twig');
    }

    public function moduleAction()
    {
        // On vérifie que l'utilisateur dispose bien du rôle ROLE_ADMIN
        if (!$this->get('security.context')->isGranted('ROLE_OFFRE')) {
            // Sinon on déclenche une exception « Accès interdit »
            throw new AccessDeniedException('Accès limité aux Modérateurs et Administrateurs.');
        }
        return $this->render('AdminBundle:module:home.html.twig', array(
            // ...
        ));
    }

    public function parametreAction()
    {
        // On vérifie que l'utilisateur dispose bien du rôle ROLE_ADMIN
        if (!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
            // Sinon on déclenche une exception « Accès interdit »
            throw new AccessDeniedException('Accès limité aux Administrateurs.');
        }
        return $this->render('AdminBundle:Parametre:index.html.twig', array(
            // ...
        ));
    }
}