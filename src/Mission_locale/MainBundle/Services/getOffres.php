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

    public function offres()
    {

        $query = $this->em->createQuery(
            'SELECT o
            FROM MainBundle:Offre o
            ORDER BY o.id DESC'
        )
            ->setMaxResults(4);

        $offres = $query->getResult();
        return $offres;
    }
}