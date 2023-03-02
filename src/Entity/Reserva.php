<?php

namespace App\Entity;

use App\Repository\ReservaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    private ?\DateTimeInterface $fechacancelacion = null;

    #[ORM\Column]
    private ?bool $presentado = null;

    #[ORM\OneToMany(mappedBy: 'reserva', targetEntity: Usuario::class)]
    private Collection $usuario;

    #[ORM\ManyToOne(inversedBy: 'reservas')]
    private ?Mesa $mesa = null;

    #[ORM\ManyToOne(inversedBy: 'reservas')]
    private ?Juego $juego = null;

    public function __construct()
    {
        $this->usuario = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFechahora(): ?\DateTimeInterface
    {
        return $this->fechahora;
    }

    public function setFechahora(?\DateTimeInterface $fechahora): self
    {
        $this->fechahora = $fechahora;

        return $this;
    }

    public function getFechacancelacion(): ?\DateTimeInterface
    {
        return $this->fechacancelacion;
    }

    public function setFechacancelacion(?\DateTimeInterface $fechacancelacion): self
    {
        $this->fechacancelacion = $fechacancelacion;

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

    /**
     * @return Collection<int, Usuario>
     */
    public function getUsuario(): Collection
    {
        return $this->usuario;
    }

    public function addUsuario(Usuario $usuario): self
    {
        if (!$this->usuario->contains($usuario)) {
            $this->usuario->add($usuario);
            $usuario->setReserva($this);
        }

        return $this;
    }

    public function removeUsuario(Usuario $usuario): self
    {
        if ($this->usuario->removeElement($usuario)) {
            // set the owning side to null (unless already changed)
            if ($usuario->getReserva() === $this) {
                $usuario->setReserva(null);
            }
        }

        return $this;
    }

    public function getMesa(): ?mesa
    {
        return $this->mesa;
    }

    public function setMesa(?mesa $mesa): self
    {
        $this->mesa = $mesa;

        return $this;
    }

    public function getJuego(): ?juego
    {
        return $this->juego;
    }

    public function setJuego(?juego $juego): self
    {
        $this->juego = $juego;

        return $this;
    }
}
