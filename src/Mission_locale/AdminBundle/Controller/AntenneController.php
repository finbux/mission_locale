<?php

namespace Mission_locale\AdminBundle\Controller;

use Mission_locale\AdminBundle\Entity\Antenne;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Mission_locale\AdminBundle\Form\AntenneType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class AntenneController extends Controller
{

    public function showAction()
    {
        $em = $this->getDoctrine()->getManager();
        $antennes = $em->getRepository('AdminBundle:Antenne')->findAll();

        return $this->render('AdminBundle:antenne:show.html.twig',array('antennes' => $antennes));
    }

    public function getAntennesAction()
    {
        $em = $this->getDoctrine()->getManager();

        $antennes = $em->getRepository('AdminBundle:Antenne')->findAll();
        $dom = New \DOMDocument("1.0");
        $node = $dom->createElement("markers");
        $parnode = $dom->appendChild($node);

        header("Content-type: text/xml");
        foreach($antennes as $value)
        {
            $node = $dom->createElement("marker");
            $newnode = $parnode->appendChild($node);
            $newnode->setAttribute("nom","<h2>" .$value->getNom()."</h2>");
            $newnode->setAttribute("adresse",$value->getAdresse());
            $newnode->setAttribute("horaire",$value->getHoraire());
            $newnode->setAttribute("lat",$value->getLat());
            $newnode->setAttribute("lng",$value->getLng());
            $newnode->setAttribute("pathImg",'<img class="img_antennes"src="'.$value->getPathImg().'"/>');
            $newnode->setAttribute("cp",$value->getCp());
            $newnode->setAttribute("ville",$value->getVille());
        }

        die($dom->saveXML());
    }

    public function addAction(Request $request)
    {
        $antenne = new Antenne();
        $formAntenne = $this->createForm(new AntenneType(),$antenne);

        if($request->isMethod('POST'))
        {
            if($formAntenne->handleRequest($request)->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($antenne);
                $em->flush();
                $this->get('session')->getFlashBag()->add('notice', 'Ajout réussi');
                return $this->redirect($this->generateUrl('admin_antenne'));
            }
        }
        return $this->render('AdminBundle:antenne:add.html.twig',array('form' => $formAntenne->createView()));
    }

    public function updateAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        //On récupère l'appel par l'id
        $antenne = $em->getRepository('AdminBundle:Antenne')->findOneBy(array('id' => $id));
        if(!$antenne)
        {
            throw $this->createNotFoundException("L'appel n'existe pas");
        }
        //On creé le formulaire
        $form = $this->createForm(new AntenneType(), $antenne);
        //Si la methode POST est capturée
        if($request->isMethod('POST')){
            //Si les données du formulaire sont validé, on lie les données avec l'entité sous item
            if($form->handleRequest($request)->isValid())
            {
                //On sauvegarde les modifs
                $em->flush();
                return $this->redirect($this->generateUrl('admin_antenne'));
            }
        }
        return $this->render('AdminBundle:Antenne:update.html.twig',array('antenne' => $antenne, 'form' => $form->createView()));
    }

    public function deleteAction($id)
    {
        if (!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
            // Sinon on déclenche une exception « Accès interdit »
            throw new AccessDeniedException('Accès limité aux Administrateurs');
        }
        else{
            $em = $this->getDoctrine()->getManager();
            $antenne = $em->getRepository('AdminBundle:Antenne')->find($id);
            if(!$antenne)
            {
                throw $this->createNotFoundException("L'antenne n'existe pas");
            }
            $em->remove($antenne);
            //On save la suppression
            $em->flush();

            return $this->redirect($this->generateUrl('admin_antenne'));
        }
    }
}
