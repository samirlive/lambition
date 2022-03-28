<?php

namespace App\Flexy\SchoolBundle\Repository;

use App\Flexy\SchoolBundle\Entity\SchoolSubject;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SchoolSubject|null find($id, $lockMode = null, $lockVersion = null)
 * @method SchoolSubject|null findOneBy(array $criteria, array $orderBy = null)
 * @method SchoolSubject[]    findAll()
 * @method SchoolSubject[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SchoolSubjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SchoolSubject::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(SchoolSubject $entity, bool $flush = true): void
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
    public function remove(SchoolSubject $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return SchoolSubject[] Returns an array of SchoolSubject objects
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
    public function findOneBySomeField($value): ?SchoolSubject
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
