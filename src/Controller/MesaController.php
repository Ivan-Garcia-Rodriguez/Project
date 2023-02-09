<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Mesa;
use App\Repository\MesaRepository;
use App\Form\MesaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\UploadedFile;




#[route("/api/mesa",name:"api_mesa_")]
class MesaController extends AbstractController
{
    #[Route('/nueva', name: 'nueva', methods: 'POST')]
    public function index(Request $request, MesaRepository $mr): Response
    {

        $mesaNueva = new Mesa();

        $mesa = json_decode($request->request->get('mesa'));

        

        

        $ancho =  (float) (json_decode($request->request->get('ancho')));
        $alto = (float) json_decode($request->request->get('alto'));
        $x = (float) json_decode($request->request->get('x'));
        $y = (float) json_decode($request->request->get('y'));
        $imagen = '';

        $mesaNueva->setAncho($ancho);
        $mesaNueva->setAlto($alto);
        $mesaNueva->setX($x);
        $mesaNueva->setY($y);
        $mesaNueva->setImagen('$imagen');

        $mr->guardar($mesaNueva);
       

        return $this->json(['status' => true, 'mesa' => $mesaNueva], 201);
    }

    #[Route('/mesas')]
    public function mostrar()
    {
        return $this->render("mesa/mesa.html.twig",['controller_name' => 'MesaController']);
    }

    #[Route('/borrar/{id}',name:'borrar')]
    public function borrar(MesaRepository $mr, int $id): Response
    {
        $mr->remove($id);
        
        return new Response();
    }

    #[Route('/actualizar/{id}',name:'actualizar')]
    public function actualizar(Request $request,MesaRepository $mr): Response
    {

        
            $mesa= new Mesa();

            $form = $this->createForm(MesaType::class,$mesa);

            $form = $this->createFormBuilder($mesa)
                ->add('Ancho', NumberType::class)
                ->add('Alto', NumberType::class)
                ->add('x', NumberType::class)
                ->add('y', NumberType::class)
                ->add('imagen',FileType::class)
                ->add('save', SubmitType::class, ['label' => 'Crear mesa'])
                ->getForm();
            
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) 
            {
                
                $Name= "Patata.png";

                $directorio = "public/images";
                $file = $form['imagen']->getData();
                $file->move($directorio, $someNewFilename);

                $mesa = $form->getData();
                $mesa->setImagen($Name);
            
                $mr->actualizar($mesa);


             }

   

             return new Response();


    }


}