<?php

namespace App\Repository\Flexy\ShopBundle\Entity\Product;

use App\Flexy\ShopBundle\Entity\Product\ImageProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ImageProduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImageProduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImageProduct[]    findAll()
 * @method ImageProduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImageProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImageProduct::class);
    }

    // /**
    //  * @return ImageProduct[] Returns an array of ImageProduct objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ImageProduct
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
