<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Disposicion;
use App\Repository\DisposicionRepository;

class ApiDisposicionController extends AbstractController
{
    #[Route('/api/disposicion', name: 'api_disposicion' ,methods:'POST')]
    public function index(Request $request, DisposicionRepository $dr): Response
    {
        $disposicion = new Disposicion();

        $mesas = json_decode($request->request->get('mesas'));

        $disposicion->setMesas($mesas);

        $dr->save($disposicion);

        return $this->json(['status' => true], 201);


    }
}
