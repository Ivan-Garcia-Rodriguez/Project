<?php

namespace App\Entity;

use App\Repository\ReservaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservaRepository::class)]
class Reserva
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fechahora = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $fechacancelación = null;

    #[ORM\Column]
    private ?bool $presentado = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFechahora(): ?\DateTimeInterface
    {
        return $this->fechahora;
    }

    public function setFechahora(\DateTimeInterface $fechahora): self
    {
        $this->fechahora = $fechahora;

        return $this;
    }

    public function getFechacancelación(): ?\DateTimeInterface
    {
        return $this->fechacancelación;
    }

    public function setFechacancelación(?\DateTimeInterface $fechacancelación): self
    {
        $this->fechacancelación = $fechacancelación;

        return $this;
    }

    public function isPresentado(): ?bool
    {
        return $this->presentado;
    }

    public function setPresentado(bool $presentado): self
    {
        $this->presentado = $presentado;

        return $this;
    }
}
