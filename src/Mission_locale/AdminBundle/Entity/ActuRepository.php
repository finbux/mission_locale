<?php

namespace Mission_locale\AdminBundle\Entity;

/**
 * ActuRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ActuRepository extends \Doctrine\ORM\EntityRepository
{
    public function allArticles()
    {
        $qb = $this->createQueryBuilder('u')
            ->select('u')
            ->where('u.isPublished = :isPublished')
            ->orWhere('u.isPublished = :isProgrammed')
            ->andWhere('u.dateDebut <= :dateDebut')
            ->orderBy('u.id','DESC')
            ->setParameter('isPublished',1)
            ->setParameter('isProgrammed',2)
            ->setParameter('dateDebut',date("Y-m-d"));
            return $qb->getQuery()->getResult();
    }
    public function get3Last()
    {
        $qb = $this->createQueryBuilder('u')
            ->select('u')
            ->where('u.isPublished = :isPublished')
            ->orWhere('u.isPublished = :isProgrammed')
            ->andWhere('u.dateDebut <= :dateDebut')
            ->orderBy('u.id','DESC')
            ->setParameter('isPublished',1)
            ->setParameter('isProgrammed',2)
            ->setParameter('dateDebut',date("Y-m-d"))
            ->setMaxResults(3);
        return $qb->getQuery()->getResult();
    }
}
