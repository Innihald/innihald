<?php

namespace App\Repository;

use App\Entity\Ocr;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ocr|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ocr|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ocr[]    findAll()
 * @method Ocr[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OcrRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ocr::class);
    }

    // /**
    //  * @return Ocr[] Returns an array of Ocr objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ocr
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
