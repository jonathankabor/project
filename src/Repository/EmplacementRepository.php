<?php

namespace App\Repository;

use Doctrine\ORM\Query;
use App\Entity\Emplacement;
use App\Entity\EmplacementSearch;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Emplacement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Emplacement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Emplacement[]    findAll()
 * @method Emplacement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmplacementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Emplacement::class);
    }

    /**
     * @return Query
     */
    public function findAllEmplacements(EmplacementSearch $search): Query
    {
        $query =  $this->createQueryBuilder('e')
                        ->orderBy('e.id', 'DESC');

        if($search->getName()) {
            $query = $query->where('e.name LIKE :name')
            ->setParameter('name', "%{$search->getName()}%");
        }

        return $query->getQuery();
    }

    // /**
    //  * @return Emplacement[] Returns an array of Emplacement objects
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
    public function findOneBySomeField($value): ?Emplacement
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
