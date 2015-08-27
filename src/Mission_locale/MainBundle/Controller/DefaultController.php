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
            $em = $this->getDoctrine()->getManager();
            //Création du formulaire pour les appels
            $formBuilder = $this->get('form.factory')->createBuilder('form',$appel);
            $formBuilder
                ->add('prenom', 'text', array('required' => false,'label' => 'Votre prénom'))
                ->add('telephone','text',array('max_length' => 10,))
                ->add('entreprise','choice',array(
                    'choices' => array(
                        1 => 'particulier',
                        2 => 'entreprise',
                    ),
                    'label' => 'Vous êtes une entreprise ou un particulier ?',
                    'multiple' => false,
                    'expanded' => true,
                ))
                ->add('Valider','submit',array('attr' => array('class' => 'btn-submit')));

            $form = $formBuilder->getForm();
            $offres = $this->container->get('getOffres')->offres();
            $actus = $this->container->get('getActus')->actus();
            $antennes = $this->container->get('getAntennes')->antennes();
            $encart = $em->getRepository('MainBundle:Encart')->find(1);

            if( $form->handleRequest($request)->isValid())
            {
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
            return $this->render('MainBundle:Default:index.html.twig',
                array(
                    'form'=> $form->createView(),
                    'offres' => $offres,
                    'actus' => $actus,
                    'antennes' => $antennes,
                    'encart' => $encart
                ));
        }

    public function employeurAction()
    {
        return $this->render('MainBundle:employeur:employeur.html.twig');
    }

    public function quiSommesNousAction()
    {
        $em = $this->getDoctrine()->getManager();
        $qsn = $em->getRepository('MainBundle:QuiSommesNous')->findOneBy(array('id' => 1));

        return $this->render('MainBundle:Quisommesnous:quisommesnous.html.twig',array('qsn' => $qsn));
    }

    public function mention_legalAction()
    {
        $em = $this->getDoctrine()->getManager();
        $mention_legal = $em->getRepository('MainBundle:MentionLegal')->findOneBy(array('id' => 1));
        return $this->render('MainBundle:Doc:mention_legal.html.twig',array('mention_legal' => $mention_legal));
    }
    public function cgoAction()
    {
        $em = $this->getDoctrine()->getManager();
        $cgo = $em->getRepository('MainBundle:Cgo')->findOneBy(array('id' => 1));
        return $this->render('MainBundle:Doc:cgo.html.twig',array('cgo' => $cgo));
    }


    public function agendaAction()
    {
        $em = $this->getDoctrine()->getManager();
        $agenda = $em->getRepository('AdminBundle:Agenda')->getAgenda();
        return $this->render('MainBundle:Default:agenda.html.twig',array('agenda' => $agenda));
    }

    public function antennesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $antennes = $em->getRepository('AdminBundle:Antenne')->findAll();
        return $this->render('MainBundle:Default:antennes.html.twig',array('antennes' => $antennes));
    }
}
