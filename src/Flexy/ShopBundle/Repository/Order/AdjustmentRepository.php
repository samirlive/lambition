<?php

namespace App\Flexy\ShopBundle\Repository\Order;

use App\Flexy\ShopBundle\Entity\Order\Adjustment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Adjustment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Adjustment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Adjustment[]    findAll()
 * @method Adjustment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdjustmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Adjustment::class);
    }

    // /**
    //  * @return Adjustment[] Returns an array of Adjustment objects
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
    public function findOneBySomeField($value): ?Adjustment
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
