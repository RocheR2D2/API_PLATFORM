<?php

namespace App\Repository;

use App\Entity\Bagage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Bagage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bagage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bagage[]    findAll()
 * @method Bagage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BagageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Bagage::class);
    }

    // /**
    //  * @return Bagage[] Returns an array of Bagage objects
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
    public function findOneBySomeField($value): ?Bagage
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
