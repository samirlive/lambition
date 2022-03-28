<?php

namespace App\Flexy\ShopBundle\Repository\Shipping;

use App\Flexy\ShopBundle\Entity\Shipping\ShippmentRule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ShippmentRule|null find($id, $lockMode = null, $lockVersion = null)
 * @method ShippmentRule|null findOneBy(array $criteria, array $orderBy = null)
 * @method ShippmentRule[]    findAll()
 * @method ShippmentRule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShippmentRuleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ShippmentRule::class);
    }

    // /**
    //  * @return ShippmentRule[] Returns an array of ShippmentRule objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ShippmentRule
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
