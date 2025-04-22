<?php

namespace App\Repository;

use App\Entity\ElectrMeter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ElectrMeter>
 *
 * @method ElectrMeter|null find($id, $lockMode = null, $lockVersion = null)
 * @method ElectrMeter|null findOneBy(array $criteria, array $orderBy = null)
 * @method ElectrMeter[]    findAll()
 * @method ElectrMeter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ElectrMeterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ElectrMeter::class);
    }

//    /**
//     * @return ElectrMeter[] Returns an array of ElectrMeter objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ElectrMeter
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
