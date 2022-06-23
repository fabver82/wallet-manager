<?php

namespace App\Repository;

use App\Entity\AccountMovement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AccountMovement>
 *
 * @method AccountMovement|null find($id, $lockMode = null, $lockVersion = null)
 * @method AccountMovement|null findOneBy(array $criteria, array $orderBy = null)
 * @method AccountMovement[]    findAll()
 * @method AccountMovement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AccountMovementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AccountMovement::class);
    }

    public function add(AccountMovement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(AccountMovement $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getTotal($value): float
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.type = :val')
            ->setParameter('val', $value)
            ->select('SUM(a.amount) as total')
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }
//    public function findAll()
//    {
//        return $this->findBy(array(), array('id' => 'DESC'));
//    }

//    /**
//     * @return AccountMovement[] Returns an array of AccountMovement objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?AccountMovement
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
