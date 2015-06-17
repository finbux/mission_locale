<?php

namespace Mission_locale\AdminBundle\Controller;

use Mission_locale\AdminBundle\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    public function indexAction()
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

    public function usersAction()
    {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addRouteItem("Choisir un module", "admin_modules");
        $breadcrumbs->addRouteItem("Les paramètres", "admin_parametre");
        $breadcrumbs->addItem("Gestion des utilisateurs");
        $breadcrumbs->prependRouteItem("Accueil", "admin_homepage");

        $em = $this->getDoctrine()->getManager();
        //$form = $this->createForm(new AppelType(), $appel);
        $users = $em->getRepository('UsersBundle:Users')->findAll();

        return $this->render('AdminBundle:Parametre:users.html.twig', array(
            'users' => $users
        ));
    }


    public function deleteUserAction($id){
        $em = $this->getDoctrine()->getManager();
        $um = $this->get('fos_user.user_manager');
        $user = $um->findUserBy(array(
                'id' => $id
            )
        );
        $em->remove($user);
        $em->flush();
        $this->get('session')->getFlashBag()->add('info', 'La suppression a bien été effectuer');

        return $this->redirect($this->generateUrl('admin_users'));
    }

}
