<?php

namespace App\Controller;
use App\Service\PokeApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PokeApiController extends AbstractController
{
    #[Route('/poke/api/{id}', name: 'app_poke_api')]
    public function index(PokeApi $pa, $id): Response
    {

        $Nombre=$pa->getName($id);
        $imagen=$pa->getSprite($id);


        // return new Response($Nombre);

        return $this->render('pokeApi.html.twig', [
            'nombre' => $Nombre,
            'imagen' => $imagen,
        ]);

        
    }

    #[Route('/poke/api/type/{id}', name: 'app_poke_api_type')]
    public function type(PokeApi $pa, $id): Response
    {

        $Nombre=$pa->getType($id);


        return new Response($Nombre);

        
    }

    #[Route('/poke/api/order/{id}', name: 'app_poke_api_order')]
    public function order(PokeApi $pa, $id): Response
    {

        $Nombre=$pa->getOrder();


        return new Response($Nombre);

        
    }
}
