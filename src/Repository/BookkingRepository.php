<?php

namespace App\Repository;

use App\Entity\Bookking;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Bookking|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bookking|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bookking[]    findAll()
 * @method Bookking[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookkingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bookking::class);
    }

    // /**
    //  * @return Bookking[] Returns an array of Bookking objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Bookking
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
