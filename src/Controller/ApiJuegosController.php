<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Juego;
use App\Repository\JuegoRepository;


class ApiJuegosController extends AbstractController
{
    #[Route('/api/juego/{id}', name: 'app_api_juegos', methods: ['GET'])]
    public function getJuego(JuegoRepository $JR, $id): Response
    {

        $juego = $JR->getOneJSON($id);

        return $juego;

        
        
    }

    #[Route('/api/juegos', name: 'juegos', methods: ['GET'])]
    public function getAllJuego(JuegoRepository $JR)
    {
        $juegos = $JR->findAll();

        $juegosTotales = [];

        foreach ($juegos as $juego) {
            $juego1 = $JR->getOneJSON($juego);
            array_push($juegosTotales,$juego1);
        }

        return $juegosTotales;

        
    }


    
}
