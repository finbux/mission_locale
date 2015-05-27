<?php

namespace Mission_locale\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Mission_locale\AdminBundle\Form\AppelType;
use Mission_locale\MainBundle\Entity\AppelRepository;

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
