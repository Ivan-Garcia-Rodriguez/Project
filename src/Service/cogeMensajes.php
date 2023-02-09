<?php
namespace App\Service;
use App\Service\generadorMensaje;

class cogeMensajes
{
    private $mensaje;

    public function __construct(generadorMensaje $gM){
        $this->mensaje = $gM->getMessage();
    }


    public function muestramensaje(){
        return ($this->mensaje);
    }
}


?>