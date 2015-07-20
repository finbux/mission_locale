<?php
namespace Mission_locale\MainBundle\Services;
use Symfony\Component\Security\Core\SecurityContextInterface;

class getAntennes
{

    public function __construct($securityContext,$em)
    {
        $this->securityContext = $securityContext;
        $this->em = $em;
    }

    public function antennes()
    {

        $actus = $this->em->getRepository('AdminBundle:Antenne')->findAll();
        return $actus;
    }
}