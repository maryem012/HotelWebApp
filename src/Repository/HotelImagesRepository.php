<?php

namespace App\Repository;

use App\Entity\HotelImages;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<HotelImages>
 *
 * @method HotelImages|null find($id, $lockMode = null, $lockVersion = null)
 * @method HotelImages|null findOneBy(array $criteria, array $orderBy = null)
 * @method HotelImages[]    findAll()
 * @method HotelImages[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HotelImagesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HotelImages::class);
    }

//    /**
//     * @return HotelImages[] Returns an array of HotelImages objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('h.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?HotelImages
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
