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
    #[Route('/nueva', name: 'nueva')]
    public function index(Request $request, MesaRepository $mr): Response
    {

        $mesa = new Mesa();

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

        if ($form->isSubmitted() && $form->isValid()) {
            
            

            $Name= "Patata.png";

            $directorio = "public/images";
            $file = $form['imagen']->getData();
            $file->move($directorio, $Name);

             $mesa = $form->getData();
             $mesa->setImagen($Name);
            
             $mr->guardar($mesa);
           
        }

        return $this->render('mesaForm.html.twig', [
            'form' => $form,
        ]);
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