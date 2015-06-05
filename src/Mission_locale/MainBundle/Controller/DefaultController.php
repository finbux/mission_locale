<?php

namespace Mission_locale\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Mission_locale\MainBundle\Entity\Appel;
use Symfony\Component\HttpFoundation\Request;
//use Symfony\Bundle\FrameworkBundle\Routing\Router;



class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        //Instanciation d'un nouvel appel
        $appel = new Appel();
        //Création du formulaire pour les appels
        $formBuilder = $this->get('form.factory')->createBuilder('form',$appel);
        $formBuilder
            ->add('prenom', 'text', array('required' => false, 'label' => 'Ton prénom'))
            ->add('telephone','text',array('max_length' => 10))
            //->add('utilisateurs','entity', array('class' => 'Mission_locale\UsersBundle\Entity\Users' ))
            ->add('Valider','submit',array('attr' => array('class' => 'btn-submit')));

        $form = $formBuilder->getForm();
        $offres = $this->container->get('getOffres')->offre();

        if( $form->handleRequest($request)->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $numero = $form["telephone"]->getData();
            $appel_exist = $em->getRepository('MainBundle:Appel')->findByNumero($numero);

            if(!$appel_exist)
            {
                $em->persist($appel);
                $em->flush();
                $this->get('session')->getFlashBag()->add('info', 'Votre demande à été prise en compte');
                return $this->redirect($this->generateUrl('main_homepage'));
            }
            else
            {
                $this->get('session')->getFlashBag()->add('error', 'Vous avez deja effectuez une demande');
            }
        }
        return $this->render('MainBundle:Default:index.html.twig',array('form'=> $form->createView(), 'offres' => $offres));
    }
    public function employeurAction()
    {
        return $this->render('MainBundle:employeur:employeur.html.twig');
    }

    public function antennesAction()
    {
        return $this->render('MainBundle:Default:antennes.html.twig');
    }
}
