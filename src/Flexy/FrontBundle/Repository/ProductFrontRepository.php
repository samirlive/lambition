<?php

namespace App\Flexy\FrontBundle\Repository;

use App\Flexy\ShopBundle\Entity\Product\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PubBanner|null find($id, $lockMode = null, $lockVersion = null)
 * @method PubBanner|null findOneBy(array $criteria, array $orderBy = null)
 * @method PubBanner[]    findAll()
 * @method PubBanner[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductFrontRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }




     /**
     * @return PubBanner[] Returns an array of PubBanner objects
    */
    
    public function findDeals()
    {
        $now = new \DateTime();
        return $this->createQueryBuilder('p')
            ->leftJoin("p.promotion","promotion")
            ->leftJoin("p.vendor","vendor")
            ->leftJoin("vendor.user","user")
            ->andWhere('p.isPublished = TRUE AND user.isValid = TRUE  ')
            ->andWhere('promotion IS NOT NULL ')
            ->andWhere('promotion.endAt > :now ')
            ->setParameter("now",$now)
            ->orderBy('p.id', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }



    /**
     * @return PubBanner[] Returns an array of PubBanner objects
    */
    
    public function findAll()
    {
        return $this->createQueryBuilder('p')

        ->leftJoin("p.vendor","vendor")
        ->leftJoin("vendor.user","user")
            ->andWhere('p.isPublished = TRUE AND user.isValid = TRUE ')
            ->orderBy('p.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }


        /**
     * @return PubBanner[] Returns an array of PubBanner objects
    */
    
    public function findByKeyWord($value)
    {
        return $this->createQueryBuilder('p')
            ->leftJoin("p.vendor","vendor")
            ->leftJoin("vendor.user","user")
            ->andWhere('p.isPublished = TRUE AND user.isValid = TRUE  AND p.name LIKE :val')
            ->orWhere('p.skuCode LIKE :val')
            ->orWhere('p.metaTitle LIKE :val')
            ->orWhere('p.metaDescription LIKE :val')
            ->orWhere('p.description LIKE :val')
            ->setParameter('val', "%".$value."%")
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }


        
    public function findByKeyWordAndCategory($value)
    {
        return $this->createQueryBuilder('p')
            ->leftJoin("p.vendor","vendor")
            ->leftJoin("vendor.user","user")
            ->andWhere('p.isPublished = TRUE AND user.isValid = TRUE ')
            ->andWhere('p.name LIKE :val')
            ->orWhere('p.description LIKE :val')
            ->setParameter('val', "%".$value."%")
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
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
