<?php

namespace John\UserBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

/**
 * NewsletterSubscriberTestRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class NewsletterSubscriberTestRepository extends EntityRepository {

    public function findActiveSubscribers()
    {
        $qb = $this->createQueryBuilder('ns')
                ->where('ns.is_active = :is_active')
                ->setParameter('is_active', true);

        $tabResults = $qb->getQuery()
                ->getResult(Query::HYDRATE_ARRAY);

        foreach ($tabResults as $subscriber) {
            $tabActiveSubscribers[] = $subscriber['email'];
        }

        return $tabActiveSubscribers;
    }

    public function findSubscriberByEmail($email)
    {
       $qb = $this->createQueryBuilder('ns');
       $result = $qb->select('n')->from('John\AdminBundle\Entity\NewsletterSubscriber', 'n')
          ->where( $qb->expr()->like('n.email', $qb->expr()->literal('%' . $email . '%')) )
          ->getQuery()
          ->getResult();
        
        return $result;
    }

}
