<?php

namespace App\Flexy\FrontBundle\Repository;

use App\Flexy\FrontBundle\Entity\MasterSlider;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MasterSlider|null find($id, $lockMode = null, $lockVersion = null)
 * @method MasterSlider|null findOneBy(array $criteria, array $orderBy = null)
 * @method MasterSlider[]    findAll()
 * @method MasterSlider[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MasterSliderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MasterSlider::class);
    }

    // /**
    //  * @return MasterSlider[] Returns an array of MasterSlider objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MasterSlider
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
