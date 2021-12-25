<?php

namespace App\Repository;

use App\Entity\SubjectCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SubjectCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method SubjectCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method SubjectCategory[]    findAll()
 * @method SubjectCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubjectCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SubjectCategory::class);
    }

    // /**
    //  * @return SubjectCategory[] Returns an array of SubjectCategory objects
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
    public function findOneBySomeField($value): ?SubjectCategory
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
