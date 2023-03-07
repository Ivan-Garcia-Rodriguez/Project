<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AlumnoRepository;
use App\Entity\Alumno;

#[Route("/api/alumno")]
class AlumnoController extends AbstractController
{
    #[Route('/todos', name: 'alumno')]
    public function index(AlumnoRepository $ar): Response
    {

        $alumnos = $ar->findAll();

        $alumnosTotales = [];

        foreach ($alumnos as $alumno) {
            $juego1 = $JR->getArray($alumno);
            array_push($alumnosTotales,$juego1);
        }

       
        return $this->json(['alumnos' => $alumnosTotales], 201);

        
    }

    #[Route('/crear', name:'crearAlumnos', methods: 'POST')]
    public function crear(AlumnoRepository $ar, Request $request){
        $alumnoNuevo = new Alumno();
        $data=json_decode($request->getContent(),true);
        $dni = $data['dni'];
        $Nombre = $data['nombre'];
        $Apellido1 = $data['apellido1'];
        $Apellido2 = $data['apellido2'];

        $alumnoNuevo->setDni($dni);
        $alumnoNuevo->setNombre($Nombre);
        $alumnoNuevo->setApellido1($Apellido1);
        $alumnoNuevo->setApellido2($Apellido2);

        $ar->save($alumnoNuevo);

        return $this->json(['status' => true], 201) ;
    }   
}
