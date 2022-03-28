<?php

namespace App\Flexy\ShopBundle\Repository\Product;

use App\Flexy\ShopBundle\Entity\Product\AttributValue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AttributValue|null find($id, $lockMode = null, $lockVersion = null)
 * @method AttributValue|null findOneBy(array $criteria, array $orderBy = null)
 * @method AttributValue[]    findAll()
 * @method AttributValue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AttributValueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AttributValue::class);
    }

    // /**
    //  * @return AttributValue[] Returns an array of AttributValue objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AttributValue
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
