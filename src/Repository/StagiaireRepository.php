<?php

namespace App\Repository;

use App\Entity\Stagiaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Stagiaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stagiaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stagiaire[]    findAll()
 * @method Stagiaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StagiaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stagiaire::class);
    }

    public function findOneById($id){

    return $this->createQueryBuilder('x')
        ->andWhere('x.id = :id')
        ->setParameter('id', $id)
        ->orderBy('x.id', 'ASC')
        ->setMaxResults(1)
        ->getQuery()
        ->getOneOrNullResult()
    ;
    }

    //Trouver un stagiaire par son nom
    public function findOneByName($name)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.nom = :name')
            ->setParameter('name', $name)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function persist($data)
    {
        
    }

    public function remove($data)
    {

    }
    
}
