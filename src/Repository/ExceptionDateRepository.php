<?php

namespace App\Repository;

use App\Entity\ExceptionDate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ExceptionDate|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExceptionDate|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExceptionDate[]    findAll()
 * @method ExceptionDate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExceptionDateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExceptionDate::class);
    }

    // /**
    //  * @return ExceptionDate[] Returns an array of ExceptionDate objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ExceptionDate
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
