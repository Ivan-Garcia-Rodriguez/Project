<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class PerfilController extends AbstractController
{
    #[IsGranted('ROLE_USER')]
    #[Route('/perfil', name: 'perfil')]
    public function index(): Response
    {
        return $this->render('perfil/index.html.twig', [
            'controller_name' => 'PerfilController',
        ]);
    }
}
