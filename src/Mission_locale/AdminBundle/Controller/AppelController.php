<?php

namespace Mission_locale\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Mission_locale\AdminBundle\Form\AppelType;
use Mission_locale\MainBundle\Entity\AppelRepository;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class AppelController extends Controller
{
    //Methode pour creer le formulaire du filtre
    private function create_form_filter()
    {
        $data = array();
        $form = $this->createFormBuilder($data)
            ->add('Filtrer','choice',
                array('choices' => array(
                    'A contacter' => 'A contacter',
                    'Message laissé' => 'Message laissé',
                    'RDV fixé' => 'RDV fixé',
                    'Renseigné' => 'Renseigné',
                    'tout' => 'Tout'
                ),
                    'preferred_choices' => array('tout')))
            ->add('ok','submit',array('attr' => array('class' => 'btn_ok')))
            ->setAction($this->generateUrl('admin_appel'))
            ->getForm();
        return $form;
    }
    //Action pour afficher tous les appels
    public function showAction(Request $request)
    {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addRouteItem("Choisir un module", "admin_modules");
        $breadcrumbs->addItem("Les appels", "offre_show");
        $breadcrumbs->prependRouteItem("Accueil", "admin_homepage");

        //On creer le formulaire
        $form = $this->create_form_filter();
        $em = $this->getDoctrine()->getManager();
        //On récupère tous les articles
        $appels = $em->getRepository('MainBundle:Appel')->findAll();

        //Si la methode POST est capturée
        if($request->isMethod('POST'))
        {
            //On récupère les données passées du formulaire
            $form->submit($request);
            //si le filtre renvoie tout on charge tous les appels
            if($form['Filtrer']->getData() == 'tout')
            {
                $appels = $em->getRepository('MainBundle:Appel')->findAll();
                return $this->render('AdminBundle:Appel:appel.html.twig',array('appels' => $appels, 'form' => $form->createView()));
            }

            //Sinon on applique le filtre passé dans le formulaire
            $appels = $em->getRepository('MainBundle:Appel')->filter($form['Filtrer']->getData());

            //On affiche la vue en passant en paramètre la liste des appels
            return $this->render('AdminBundle:Appel:appel.html.twig',array('appels' => $appels, 'form' => $form->createView()));
        }
        return $this->render('AdminBundle:Appel:appel.html.twig',array('appels' => $appels, 'form' => $form->createView()));
    }

    public function updateAction(Request $request, $id)
    {
        $breadcrumbs = $this->get("white_october_breadcrumbs");
        $breadcrumbs->addRouteItem("Choisir un module", "admin_modules");
        $breadcrumbs->addRouteItem("Les offres", "offre_show");
        $breadcrumbs->addItem("Traiter l'appel");

        $breadcrumbs->prependRouteItem("Accueil", "admin_homepage");
        $em = $this->getDoctrine()->getManager();
        //On récupère l'appel par l'id
        $appel = $em->getRepository('MainBundle:Appel')->findOneBy(array('id' => $id));

        if(!$appel)
        {
            throw $this->createNotFoundException("L'appel n'existe pas");
        }
        //On creé le formulaire
        $form = $this->createForm(new AppelType(), $appel);
        //Si la methode POST est capturée
        if($request->isMethod('POST')){
            //Si les données du formulaire sont validé, on lie les données avec l'entité sous item
            if($form->handleRequest($request)->isValid())
            {
                //On sauvegarde les modifs
                $em->flush();
                return $this->redirect($this->generateUrl('admin_appel'));
            }
        }
        return $this->render('AdminBundle:Appel:update.html.twig',array('appel' => $appel, 'form' => $form->createView()));
    }

    //Action pour supprimer un appel
    public function deleteAction($id)
    {
        if (!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
            // Sinon on déclenche une exception « Accès interdit »
            throw new AccessDeniedException('Accès limité aux Administrateurs');
        }
        else
        {
            $em = $this->getDoctrine()->getManager();
            //On récupère l'appel par l'id
            $appel = $em->getRepository('MainBundle:Appel')->find($id);

            //Si l'appel n'existe pas
            if(!$appel)
            {
                throw $this->createNotFoundException("L'appel n'existe pas");
            }

            //On supprime l'appel
            $em->remove($appel);
            //On save la suppression
            $em->flush();

            return $this->redirect($this->generateUrl('admin_appel'));
        }
    }
}
