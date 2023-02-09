<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JuegosController extends AbstractController
{
    #[Route('/juegos', name: 'juegos')]
    public function index(): Response
    {
        return $this->render('juego/index.html.twig', [
            
        ]);
    }
}
