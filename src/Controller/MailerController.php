<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Dompdf\Dompdf;



class MailerController extends AbstractController
{
    #[Route('/email', name: 'email')]
    public function sendEmail(MailerInterface $mailer)
    {


        $html = $this->renderView('email/emailpdf.html.twig');

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4','landscape');
        $dompdf->render();
        $output = $dompdf->output();
        $type = 'application.pdf';
        
        $email = (new TemplatedEmail())
            ->from('ridivan28@gmail.com')
            ->to('josemimb98@gmail.com')
            ->subject('Prueba del mailer')
            ->attach($output,$type);
            


            $mailer->send($email);
            
        
    }
}
