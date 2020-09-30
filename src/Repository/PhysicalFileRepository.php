<?php

namespace App\Repository;

use App\Entity\PhysicalFile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PhysicalFile|null find($id, $lockMode = null, $lockVersion = null)
 * @method PhysicalFile|null findOneBy(array $criteria, array $orderBy = null)
 * @method PhysicalFile[]    findAll()
 * @method PhysicalFile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PhysicalFileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PhysicalFile::class);
    }

    // /**
    //  * @return PhysicalFile[] Returns an array of PhysicalFile objects
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
    public function findOneBySomeField($value): ?PhysicalFile
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
