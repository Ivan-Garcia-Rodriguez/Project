<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\JuegoType;
use App\Entity\Juego;
use App\Repository\JuegoRepository;


#[Route('/juegos')]
class JuegosController extends AbstractController
{
    #[Route('', name: 'juegos')]
    public function index(): Response
    {
        return $this->render('juego/index.html.twig', [
            
        ]);
    }


    #[Route('/formulario', name: 'formuJuegos')]
    public function formulario(JuegoRepository $jr, Request $request) : Response
    {
        $form = $this->createForm(JuegoType::class);
        $juego = new Juego();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
           
            $juego->setNombre($form->get('Nombre')->getData());
            $juego->setEditorial($form->get('editorial')->getData());
            $juego->setMinimo($form->get('minimo')->getData());
            $juego->setMaximo($form->get('maximo')->getData());
            $juego->setAncho($form->get('ancho')->getData());
            $juego->setAlto($form->get('alto')->getData());
            $NombreFichero = $form->get('imagen')->getData()->getClientOriginalName();
            $juego->setImagen($NombreFichero);

            $file = $form->get('imagen')->getData();
            $file->move('./assets/images',$NombreFichero);
            
           
           
            $jr->save($juego);

            
                return $this->redirectToRoute('juegos');
            
         
    }

    return $this->render('juego/formulario.html.twig', [
        'form' => $form,
    ]);


    }
}
