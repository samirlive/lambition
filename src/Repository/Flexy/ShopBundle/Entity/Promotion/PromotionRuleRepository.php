<?php

namespace App\Repository\Flexy\ShopBundle\Entity\Promotion;

use App\Flexy\ShopBundle\Entity\Promotion\PromotionRule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PromotionRule|null find($id, $lockMode = null, $lockVersion = null)
 * @method PromotionRule|null findOneBy(array $criteria, array $orderBy = null)
 * @method PromotionRule[]    findAll()
 * @method PromotionRule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PromotionRuleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PromotionRule::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(PromotionRule $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(PromotionRule $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return PromotionRule[] Returns an array of PromotionRule objects
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
    public function findOneBySomeField($value): ?PromotionRule
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
