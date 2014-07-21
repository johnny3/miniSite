<?php

namespace John\AdminBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * CategoryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CategoryRepository extends EntityRepository
{
    public function getCategoryOrSubCategoryWithArticles()
    {
        $qb = $this->createQueryBuilder('c')
                ->leftJoin('c.articles', 'a')
                ->addSelect('a')
                ->leftJoin('c.subCategories', 'sc')
                ->addSelect('sc')
                ->andWhere('a is not null or sc is not null')
                ->andWhere('c.isVisible = :is_visible')
                ->setParameter('is_visible', true)
                ->OrderBy('c.position', 'ASC');

        return $qb->getQuery()
                        ->getResult();
    }

    public function getCategoryOrSubCategoryExceptContact()
    {
        $qb = $this->createQueryBuilder('c')
                ->leftJoin('c.subCategories', 'sc')
                ->addSelect('sc')
                ->andWhere('c.contactCat = :contactCat')
                ->setParameter('contactCat', false)
                ->andWhere('c.isVisible = :is_visible')
                ->setParameter('is_visible', true)
                ->andWhere('sc is not null')
                ->OrderBy('c.position', 'ASC')
                ->addOrderBy('sc.position', 'ASC');

        return $qb->getQuery()
                        ->getResult();
    }

    public function getContactCategory()
    {
        $qb = $this->createQueryBuilder('c')
                ->andWhere('c.contactCat = :contactCat')
                ->setParameter('contactCat', true);

        return $qb->getQuery()
                        ->getOneOrNullResult();
    }

}