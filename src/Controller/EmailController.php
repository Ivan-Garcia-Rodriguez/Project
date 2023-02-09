<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;

class EmailController extends AbstractController
{
    #[Route('/email/pdf', name: 'app_email')]
    public function index(Pdf $pdf): Response
    {

        $dompdf = new Dompdf();
        $html = $this->renderView('email/emailpdf.html.twig');
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4','landscape');
        
        return new PdfResponse(
            $pdf->getOutputFromHtml($html),
            $filename
        );

        
    }
}
