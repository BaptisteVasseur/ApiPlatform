<?php

namespace App\Repository;

use App\Entity\ReadList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ReadList>
 *
 * @method ReadList|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReadList|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReadList[]    findAll()
 * @method ReadList[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReadListRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReadList::class);
    }

//    /**
//     * @return ReadList[] Returns an array of ReadList objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ReadList
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
