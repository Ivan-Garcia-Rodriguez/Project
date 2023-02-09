<?php

namespace App\Service;

use App\Repository\MesaRepository;

use symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class mesaService{

    private  $params;

    public function __construct(ParameterBagInterface $params ){
        $this->params = $params;
    }

    public function someMethod(){

        $parametervalue = $this->params->get('parameter_name');

        

    }
}


?>