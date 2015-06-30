<?php

namespace Mission_locale\AdminBundle\Controller;

use Mission_locale\AdminBundle\Entity\Actu;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Mission_locale\AdminBundle\Form\ActuType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class ActuController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $actus = $em->getRepository('AdminBundle:Actu')->findAll();
        return $this->render('AdminBundle:Actu:index.html.twig', array(
                'actus' => $actus
            ));    }

    public function showAction()
    {
        return $this->render('AdminBundle:Actu:show.html.twig', array(
                // ...
            ));    }
    public function addAction(Request $request)
    {
        $actu = new Actu();
        $form = $this->createForm(new ActuType(),$actu);

        if($request->isMethod('POST'))
        {
            if($form->handleRequest($request)->isValid())
            {
                $em = $this->getDoctrine()->getManager();

                $em->persist($actu);
                $em->flush();
                $this->get('session')->getFlashBag()->add('notice', 'Ajout réussi');
                return $this->redirect($this->generateUrl('actu_index'));
            }
        }
        return $this->render('AdminBundle:Actu:add.html.twig', array(
            'form' => $form->createView()
        ));    }

    public function updateAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $actu = $em->getRepository('AdminBundle:Actu')->find($id);
        if(!$actu)
        {
            throw $this->createNotFoundException("L'offre n'existe pas");
        }
        $form = $this->createForm(new ActuType(), $actu);
        //Si la methode POST est capturée
        if($request->isMethod('POST'))
        {
            //Si les données du formulaire sont validé, on lie les données avec l'entité sous item
            if($form->handleRequest($request)->isValid())
            {
                if($form["isPublished"]->getData() == 1)
                {

                    $actu->setDateDebut(new \DateTime("now"));

                    $em->flush();
                    $this->get('session')->getFlashBag()->add('notice', 'Modification réussi');
                    return $this->redirect($this->generateUrl('actu_index'));
                }
                $em->flush();
                $this->get('session')->getFlashBag()->add('notice', 'Modification réussi');
                return $this->redirect($this->generateUrl('actu_index'));
            }
        }
        return $this->render('AdminBundle:Actu:update.html.twig', array(
                'form' => $form->createView(),
                'actu' => $actu
            ));    }

    public function deleteAction($id)
    {
        if (!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
            // Sinon on déclenche une exception « Accès interdit »
            throw new AccessDeniedException('Accès limité aux Administrateurs');
        }
        else{
            $em = $this->getDoctrine()->getManager();
            $actu = $em->getRepository('AdminBundle:Actu')->find($id);
            if (!$actu) {
                throw $this->createNotFoundException("L'actualité n'existe pas");
            }
            $em->remove($actu);
            //On save la suppression
            $em->flush();

            return $this->redirect($this->generateUrl('actu_index'));
        }
    }

}
