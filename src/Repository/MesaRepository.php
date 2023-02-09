<?php

namespace App\Repository;

use App\Entity\Mesa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Mesa>
 *
 * @method Mesa|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mesa|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mesa[]    findAll()
 * @method Mesa[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MesaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mesa::class);
    }

    public function guardar(Mesa $mesa, bool $flush = false): void
    {
        
        
                $this->getEntityManager()->persist($mesa);
            
                $this->getEntityManager()->flush();
            
        

        
    }

    public function remove($id): void
    {
        $mesa = $this->find($id);

        $this->getEntityManager()->remove($mesa);
        
        $this->getEntityManager()->flush();
        
    }

    public function update(Mesa $table,int $id){
        $mesa= $this->find($id);

        if(!$mesa){
            throw $this->createNotFoundException('No se ha encontrado la mesa con la id '.$id);
        }

        $mesa->setX($table->getX());
        $mesa->setY($table->getY());
        $mesa->setAncho($table->getAncho());
        $mesa->setAlto($table->getAlto());
        $mesa->setImagen($table->getImagen());

        $this->getEntityManager()->persist($mesa);
            
                $this->getEntityManager()->flush();

       


    }

    public function existe($id){
        $existe= false;

        $existeMesa = $this->find($id);

        if($existeMesa){
            $existe= true;
        }

        return $existe;

    }

    public function muestra($id){
        $mesa = $this->find($id);
        return $mesa;
    }

//    /**
//     * @return Mesa[] Returns an array of Mesa objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Mesa
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function getAll(){


        $mesas = [];

        return $mesas;
    }

  public function getAllJSON() 
   {


    $mesas = $this->getAll();
    $data = [];
 
    foreach ($mesas as $mesa) {
       $data[] = [
           'id' => $mesa->getId(),
           'ancho' => $mesa->getAncho(),
           'alto' => $mesa->getAlto(),
           'x' => $mesa->getX(),
           'y' => $mesa->getY(),
           'imagen' => $mesa->getImagen()   
       ];
    }

    return $data;
   }



}
