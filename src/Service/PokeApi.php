<?php

namespace App\Service;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class PokeApi{

    private $cliente;

    public function __construct(HttpClientInterface $client){
        $this->cliente=$client;
    }


    public function getInfo($id){
        $response = $this->cliente->request('GET','https://pokeapi.co/api/v2/pokemon-form/'.$id.'/');

        return $response;
    }

    public function getName($id){
        $info=$this->getInfo($id);

        $content=$info->getContent();

        $content=$info->toArray();

        
        $Name = $content['name'];

        return $Name;


    }


    public function getSprite($id){
        $info=$this->getInfo($id);

        $content=$info->getContent();

        $content=$info->toArray();


       

        $imagen=$content['sprites']['front_default'];

        return $imagen;
    }
   

    public function getType($id){
        $info=$this->getInfo($id);

        $content=$info->getContent();

        $content=$info->toArray();

        $Name = $content['types']['0']['type']['name'];

        return $Name;


    }

    public function getOrder($id){
        $info=$this->getInfo($id);

        $content=$info->getContent();

        $content=$info->toArray();

        $Name = $content['order'];

        return $Name;


    }

    



}

?>