<?php

namespace App\Repository;

use App\Entity\StudentDetail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StudentDetail|null find($id, $lockMode = null, $lockVersion = null)
 * @method StudentDetail|null findOneBy(array $criteria, array $orderBy = null)
 * @method StudentDetail[]    findAll()
 * @method StudentDetail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentDetailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StudentDetail::class);
    }

    // /**
    //  * @return StudentDetail[] Returns an array of StudentDetail objects
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
    public function findOneBySomeField($value): ?StudentDetail
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
