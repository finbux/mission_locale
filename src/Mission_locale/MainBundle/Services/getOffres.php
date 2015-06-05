<?php
namespace Mission_locale\MainBundle\Services;
use Symfony\Component\Security\Core\SecurityContextInterface;

class getOffres
{

    public function __construct($securityContext,$em)
    {
        $this->securityContext = $securityContext;
        $this->em = $em;
    }

    public function offre()
    {

        $offres = $this->em->getRepository('MainBundle:Offre')->findAll();
        return $offres;
    }
}