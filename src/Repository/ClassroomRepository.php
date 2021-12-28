<?php

namespace App\Repository;

use App\Entity\Classroom;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Classroom|null find($id, $lockMode = null, $lockVersion = null)
 * @method Classroom|null findOneBy(array $criteria, array $orderBy = null)
 * @method Classroom[]    findAll()
 * @method Classroom[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClassroomRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Classroom::class);
    }

    /**
     * @return Classroom[]
     */
    public function searchClass($name){
        return $this->createQueryBuilder('classroom')
                    ->andWhere('classroom.name LIKE :name')
                    ->setParameter('name', '%' . $name . '%')
                    ->orderBy('classroom.name','asc')
                    ->setMaxResults(5)
                    ->getQuery()
                    ->getResult();
    }
}
