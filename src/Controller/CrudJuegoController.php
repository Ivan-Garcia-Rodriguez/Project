<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Juego;
use App\Repository\JuegoRepository;

class CrudJuegoController extends AbstractController
{
    #[Route('/crud/juego', name: 'app_crud_juego')]
    public function index(): Response
    {
        return $this->render('crud_juego/index.html.twig', [
            'controller_name' => 'CrudJuegoController',
        ]);
    }

    #[Route('/crud/juego/nuevo', name: 'juego_nuevo',methods:'POST')]
    public function new(Request $request, JuegoRepository $jr) : Response
    {
        $juego = new Juego();

        $nombre=  json_decode($request->request->get('Nombre'));
        $editorial = json_decode($request->request->get('Editorial'));
        $minimo = (float) (json_decode($request->request->get('minimo')));
        $maximo = (float) (json_decode($request->request->get('maximo')));
        $ancho = (float) (json_decode($request->request->get('ancho')));
        $alto = (float) (json_decode($request->request->get('alto')));

        $imagen = '';

        $juego->setNombre($nombre);
        $juego->setEditorial($editorial);
        $juego->setMinimo($minimo);
        $juego->setMaximo($maximo);
        $juego->setAncho($ancho);
        $juego->setAlto($alto);
        $juego->setImagen($imagen);
        

        return $this->json(['status' => true, 'juego' => $juego], 201);


    }

    #[Route('/crud/juego/borrar/{id}', name: 'juegoBorrar', methods:'DELETE')]
    public function borrar(JuegoRepository $jr, $id) : Response
    {
        $jr->remove($id);

        return $this->json(['status' => true, 200]);
    }

    #[Route('/crud/juego/actualizar/{id}', name: 'juegoActualizar')]
    public function actualizar(JuegoRepository $jr,$id) : Response
    {
        $Juego = $jr->find($id);

        $nombre=  json_decode($request->request->get('Nombre'));
        $editorial = json_decode($request->request->get('Editorial'));
        $minimo = (float) (json_decode($request->request->get('minimo')));
        $maximo = (float) (json_decode($request->request->get('maximo')));
        $ancho = (float) (json_decode($request->request->get('ancho')));
        $alto = (float) (json_decode($request->request->get('alto')));

        $imagen = '';

        $juego->setNombre($nombre);
        $juego->setEditorial($editorial);
        $juego->setMinimo($minimo);
        $juego->setMaximo($maximo);
        $juego->setAncho($ancho);
        $juego->setAlto($alto);
        $juego->setImagen($imagen);
        

        return $this->json(['status' => true, 'juego' => $juego], 201);

    }

    
}
