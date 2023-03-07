<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ReservaRepository;
use App\Entity\Reserva;
use App\Entity\Usuario;
use App\Form\ReservaType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class ReservaController extends AbstractController
{
    #[IsGranted('ROLE_USER')]
    #[Route('/reserva', name: 'reserva')]
    public function index(ReservaRepository $rr, Request $request): Response
    {
        
        $form = $this->createForm(ReservaType::class);
        $Reserva = new Reserva();
        $user = new Usuario();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
           
            $Reserva->setFechaHora($form->get('FechaHora')->getData());
            $Reserva->setMesa($form->get('mesa')->getData());
            $Reserva->setJuego($form->get('juego')->getData());
            $Reserva->setPresentado(false);
            
            
           
            
            $rr->save($Reserva);
        return $this->redirectToRoute('main');
    }
      
      
            return $this->render('reserva/index.html.twig', [
                'form' => $form,
            ]);
        
       
            
       

        
    }
}
