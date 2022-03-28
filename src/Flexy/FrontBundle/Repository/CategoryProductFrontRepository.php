<?php

namespace App\Flexy\FrontBundle\Repository;

use App\Flexy\ShopBundle\Entity\Product\CategoryProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PubBanner|null find($id, $lockMode = null, $lockVersion = null)
 * @method PubBanner|null findOneBy(array $criteria, array $orderBy = null)
 * @method PubBanner[]    findAll()
 * @method PubBanner[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryProductFrontRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoryProduct::class);
    }




    



    

    // /**
    //  * @return PubBanner[] Returns an array of PubBanner objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PubBanner
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
