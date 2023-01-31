<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Producto;
use App\Entity\Categoria;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\CategoriaRepository;
use App\Form\ProductoType;




class Micontroller extends AbstractController
{
    #[Route('/inicio/{user}', name: 'Inicial')]
    public function landing(String $user=null):Response
    {
        die("Hola ".$user);
        $html=$this->render('homepage.html.twig');
        return $html;
    } 

    #[Route('/home/{idioma}&{user}')]
    public function home(String $user=null, String $idioma=null ,Request $request):Response
    {
        
        if ($idioma=="Español")
        {
            // $id=$request->query->get('id');
            // return new Response($id);
            $html=$this->render('homepage.html.twig',['request'=>$request]);
            return $html;
            // return new Response("Hola ".$user);
        }
        else if ($idioma=="Ingles")
        {
            die("Welcome ".$user);
        }
        return new Response("Welcome");
    } 

    #[Route('/operador/{operador}&{num1}&{num2}')]
    public function opera(String $operador=null,int $num1=null, int $num2=null):Response
    {
        if ($operador=="suma") {
            $resul=$num1+$num2;
        }
        else if ($operador=="resta") {
            $resul=$num1-$num2;
        }
        else if ($operador=="multiplica") {
            $resul=$num1*$num2;
        }
        else if ($operador=="divide") {
            $resul=$num1/$num2;
        }

        die("El resultado es $resul");
    } 

    #[Route('/API')]
    public function metodo()
    {

    }


    #[Route('/producto/nuevo')]
    public function getProducto(EntityManagerInterface $em)
    {
        $c = new Categoria();
        $c->setName("Verduras");
        $p = new Producto();
        $p->setName("Tomate");
        $p->setPrecio(2);
        $p->setCategoria($c);

        $em->persist($c);
        $em->persist($p);
        $em->flush();

        return new Response("");
    }

    #[Route('/categoria/listado/{id}')]
    public function listadoCategoria(int $id,ManagerRegistry $em){


        $repo = new CategoriaRepository($em);
        $c=$repo->findOneBySomeField($id);

     $productos = $c->getproductos();
     $res="";
        foreach($productos as $producto){
            $res.=$producto->getName()."<br>";
           
        }

        return new Response($res);
    }



    #[Route('/producto/new')]
    public function new(Request $request, EntityManagerInterface $em ): Response
    {
        // creates a task object and initializes some data for this example
        $producto = new Producto();
        $producto->setNombre('');
        $producto->setTipo('');
        $producto->setCantidad(0);
        

        $form = $this->createForm(ProductoType::class,$producto);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $producto = $form->getData();
            $em->persist($producto);
            $em->flush();
           
        }

            return $this->render('productoForm.html.twig', [
                'form' => $form,
            ]);

        
    }
}
?>