<?php

namespace App\Controller;
use App\Service\mesaService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MessageController extends AbstractController
{
    #[Route('/saludos')]
    public function new(mesaService $ms): Response
    {
        

        $message = $ms->muestraMesa();
        
        return new response($message);
    }
}
