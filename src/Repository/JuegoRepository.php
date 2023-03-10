<?php

namespace App\Repository;

use App\Entity\Juego;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Juego>
 *
 * @method Juego|null find($id, $lockMode = null, $lockVersion = null)
 * @method Juego|null findOneBy(array $criteria, array $orderBy = null)
 * @method Juego[]    findAll()
 * @method Juego[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JuegoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Juego::class);
    }

    public function save(Juego $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        
            $this->getEntityManager()->flush();
        
    }

    public function remove(Juego $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        
            $this->getEntityManager()->flush();
        
    }

    public function getArray($juego)
    {
        
        return ["id"=>$juego->getId(),"Nombre"=>$juego->getNombre(),"editorial"=>$juego->getEditorial(),"minimo"=>$juego->getMinimo(),"maximo"=>$juego->getMaximo(),"ancho"=>$juego->getAncho(),"alto"=>$juego->getAlto(),"imagen"=>$juego->getImagen()];
    }

//    /**
//     * @return Juego[] Returns an array of Juego objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('j.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Juego
//    {
//        return $this->createQueryBuilder('j')
//            ->andWhere('j.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
