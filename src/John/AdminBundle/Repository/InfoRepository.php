<?php

namespace John\AdminBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * AddressRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class InfoRepository extends EntityRepository
{
    public function getInfo()
    {
        $qb = $this->createQueryBuilder('info');

        return $qb->getQuery()
                        ->getOneOrNullResult();
    }
}