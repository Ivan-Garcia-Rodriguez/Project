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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[IsGranted('ROLE_ADMIN')]
#[route("/api/mesa")]
class MesaController extends AbstractController
{
    #[Route('', name: 'nueva', methods: 'POST')]
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
       

        return $this->json(['status' => true, 'id' => $mesaNueva->getId()], 201);
    }

    #[Route('/mesas', name:'mesas')]
    public function mostrar()
    {
        return $this->render("mesa/mesa.html.twig",[]);
    }

    #[Route('/{id}',name:'borrar' ,methods:'DELETE')]
    public function borrar(MesaRepository $mr, int $id)
    {
        $mr->remove($id);
        
        return $this->json(['status' => 200]);
    }

    #[Route('/{id}', name:'getMesa' ,methods:'GET')]
    public function conseguir(MesaRepository $mr, $id){
        $mesa = $mr-> muestra($id);

        return $this->json(['status'=>true, 'mesa' =>$mesa]);
    }

    #[Route('/{id}',name:'actualizar', methods: 'PUT')]
    public function actualizar(Request $request,MesaRepository $mr,$id)
    {

        
            $mesa= $mr->find($id);

            $ancho =  (float) (json_decode($request->request->get('ancho')));
            $alto = (float) json_decode($request->request->get('alto'));
            $x = (float) json_decode($request->request->get('x'));
            $y = (float) json_decode($request->request->get('y'));
            $imagen = '';
    
            $mesa->setAncho($ancho);
            $mesa->setAlto($alto);
            $mesa->setX($x);
            $mesa->setY($y);
            $mesa->setImagen('$imagen');

           
            
                $mr->update($mesa);

                return $this->json(['status' => 200]);



             }

   

             

    }


