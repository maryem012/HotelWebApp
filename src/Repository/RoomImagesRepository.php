<?php

namespace App\Repository;

use App\Entity\RoomImages;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RoomImages>
 *
 * @method RoomImages|null find($id, $lockMode = null, $lockVersion = null)
 * @method RoomImages|null findOneBy(array $criteria, array $orderBy = null)
 * @method RoomImages[]    findAll()
 * @method RoomImages[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoomImagesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RoomImages::class);
    }

//    /**
//     * @return RoomImages[] Returns an array of RoomImages objects
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

//    public function findOneBySomeField($value): ?RoomImages
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
