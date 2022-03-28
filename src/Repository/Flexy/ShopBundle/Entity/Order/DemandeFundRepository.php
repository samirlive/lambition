<?php

namespace App\Repository\Flexy\ShopBundle\Entity\Order;

use App\Flexy\ShopBundle\Entity\Order\DemandeFund;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DemandeFund|null find($id, $lockMode = null, $lockVersion = null)
 * @method DemandeFund|null findOneBy(array $criteria, array $orderBy = null)
 * @method DemandeFund[]    findAll()
 * @method DemandeFund[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DemandeFundRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DemandeFund::class);
    }

    // /**
    //  * @return DemandeFund[] Returns an array of DemandeFund objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DemandeFund
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
