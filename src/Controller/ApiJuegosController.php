<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Juego;
use App\Repository\JuegoRepository;

#[Route('/api/juego')]
class ApiJuegosController extends AbstractController
{
    #[Route('/{id}', name: 'juegos')]
    public function getJuego(JuegoRepository $JR, $id): Response
    {

        $juego = $JR->getOneJSON($id);

        return $juego;

        
        
    }

    #[Route('/todos', name: 'allJuegos')]
    public function getAllJuego(JuegoRepository $JR)
    {
        $juegos = $JR->findAll();

       
       
        
        $juegosTotales = [];

        foreach ($juegos as $juego) {
            $juego1 = $JR->getArray($juego);
            array_push($juegosTotales,$juego1);
        }

       
        return $this->json(['status' => true, 'juegos' => $juegosTotales], 201);
      

        
    }

    #[Route('/borrar/{id}', name: 'borraJuegos', methods: 'DELETE')]
    public function borrarJuego(JuegoRepository $jr, $id)
    {
        $juego = new Juego();
        $juego = $jr->find($id);
        
        $jr->remove($juego);

        return $this->json(['status' => 200]);
    }


    
}
