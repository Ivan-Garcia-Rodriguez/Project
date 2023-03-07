<?php

namespace App\Service;

use Dompdf\Dompdf;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

  class MailerService
  {

      private MailerInterface $mailer;
      function __construct(MailerInterface $mailer){
          $this->mailer=$mailer;
      }


        

        public function sendEmail($html){

            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4','landscape');
            $dompdf->render();
            $output = $dompdf->output();
            $type = 'application.pdf';
            
            $email = (new TemplatedEmail())
                ->from('ridivan28@gmail.com')
                ->to('artiiyoshi64@gmail.com')
                ->subject('Prueba del mailer')
                ->attach($output,$type);
                
    
    
               $this->mailer->send($email);
                
        }

  }

?>