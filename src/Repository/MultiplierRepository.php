<?php

namespace App\Repository;

use App\Entity\Multiplier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Multiplier>
 *
 * @method Multiplier|null find($id, $lockMode = null, $lockVersion = null)
 * @method Multiplier|null findOneBy(array $criteria, array $orderBy = null)
 * @method Multiplier[]    findAll()
 * @method Multiplier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MultiplierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Multiplier::class);
    }

    public function save(Multiplier $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Multiplier $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
