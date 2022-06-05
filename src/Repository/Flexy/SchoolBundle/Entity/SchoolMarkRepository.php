<?php

namespace App\Repository\Flexy\SchoolBundle\Entity;

use App\Flexy\SchoolBundle\Entity\SchoolMark;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SchoolMark|null find($id, $lockMode = null, $lockVersion = null)
 * @method SchoolMark|null findOneBy(array $criteria, array $orderBy = null)
 * @method SchoolMark[]    findAll()
 * @method SchoolMark[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SchoolMarkRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SchoolMark::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(SchoolMark $entity, bool $flush = true): void
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
    public function remove(SchoolMark $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return SchoolMark[] Returns an array of SchoolMark objects
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
    public function findOneBySomeField($value): ?SchoolMark
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
