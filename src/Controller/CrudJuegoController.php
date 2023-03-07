<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Juego;
use App\Repository\JuegoRepository;
use App\Form\JuegoType;


#[IsGranted('ROLE_ADMIN')]
#[Route('/crud/juego')]
class CrudJuegoController extends AbstractController
{
    #[Route('', name: 'crud_juego')]
    public function index(JuegoRepository $jr): Response
    {
        return $this->render('crud_juego/index.html.twig', [
            'juegos' => $jr->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'crud_juego_borrar')]
    public function borrar(JuegoRepository $jr, $id)
    {
        $juego = new Juego();
        $juego = $jr->find($id);
        
        $jr->remove($juego);

        return $this->redirectToRoute('crud_juego');
    }

    #[Route('/editar/{id}', name: 'crud_juego_editar')]
    public function editar(JuegoRepository $jr,Request $request,$id)
    {
        $juego = new Juego();
        $juego = $jr->find($id);
        $form = $this->createForm(JuegoType::class,$juego);
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

            
                return $this->redirectToRoute('crud_juego');
            
         
    }

        return $this->render('crud_juego/formulario.html.twig', [
            'form' => $form,
        ]);

    }

    

    

    

    
}
