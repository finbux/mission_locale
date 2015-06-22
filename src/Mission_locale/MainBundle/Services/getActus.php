<?php
namespace Mission_locale\MainBundle\Services;
use Symfony\Component\Security\Core\SecurityContextInterface;

class getActus
{

    public function __construct($securityContext,$em)
    {
        $this->securityContext = $securityContext;
        $this->em = $em;
    }

    public function actus()
    {

        $actus = $this->em->getRepository('AdminBundle:Actu')->findAll();
        return $actus;
    }
}