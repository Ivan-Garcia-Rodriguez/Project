<?php

namespace App\Entity;

use App\Repository\PruebaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PruebaRepository::class)]
class Prueba
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $pepe = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPepe(): ?string
    {
        return $this->pepe;
    }

    public function setPepe(string $pepe): self
    {
        $this->pepe = $pepe;

        return $this;
    }
}
