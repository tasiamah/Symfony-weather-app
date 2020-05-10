<?php

namespace App\Repository;

use App\Entity\Precipitation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Precipitation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Precipitation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Precipitation[]    findAll()
 * @method Precipitation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrecipitationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Precipitation::class);
    }

    // /**
    //  * @return Precipitation[] Returns an array of Precipitation objects
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
    public function findOneBySomeField($value): ?Precipitation
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
