<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Dompdf\Dompdf;
use App\Service\MailerService;



class MailerController extends AbstractController
{
    #[Route('/email', name: 'email')]
    public function sendEmail(MailerService $mailerService,MailerInterface $mailer)
    {

       

        $html = $this->renderView('email/emailpdf.html.twig');

        $mailerService->sendEmail($html,$mailer);
        
    }
}
