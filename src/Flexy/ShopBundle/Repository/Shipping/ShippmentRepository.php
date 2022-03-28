<?php

namespace App\Flexy\ShopBundle\Repository\Shipping;

use App\Flexy\ShopBundle\Entity\Shipping\Shippment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Shippment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Shippment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Shippment[]    findAll()
 * @method Shippment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShippmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Shippment::class);
    }

    // /**
    //  * @return Shippment[] Returns an array of Shippment objects
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
    public function findOneBySomeField($value): ?Shippment
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
