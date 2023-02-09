<?php

namespace App\Entity;

use App\Repository\JuegoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JuegoRepository::class)]
class Juego
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nombre = null;

    #[ORM\Column(length: 50)]
    private ?string $editorial = null;

    #[ORM\Column]
    private ?float $minimo = null;

    #[ORM\Column]
    private ?float $maximo = null;

    #[ORM\Column]
    private ?float $ancho = null;

    #[ORM\Column]
    private ?float $alto = null;

    #[ORM\Column(length: 255)]
    private ?string $imagen = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->Nombre;
    }

    public function setNombre(string $Nombre): self
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    public function getEditorial(): ?string
    {
        return $this->editorial;
    }

    public function setEditorial(string $editorial): self
    {
        $this->editorial = $editorial;

        return $this;
    }

    public function getMinimo(): ?float
    {
        return $this->minimo;
    }

    public function setMinimo(float $minimo): self
    {
        $this->minimo = $minimo;

        return $this;
    }

    public function getMaximo(): ?float
    {
        return $this->maximo;
    }

    public function setMaximo(float $maximo): self
    {
        $this->maximo = $maximo;

        return $this;
    }

    public function getAncho(): ?float
    {
        return $this->ancho;
    }

    public function setAncho(float $ancho): self
    {
        $this->ancho = $ancho;

        return $this;
    }

    public function getAlto(): ?float
    {
        return $this->alto;
    }

    public function setAlto(float $alto): self
    {
        $this->alto = $alto;

        return $this;
    }

    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    public function setImagen(string $imagen): self
    {
        $this->imagen = $imagen;

        return $this;
    }

    
}
