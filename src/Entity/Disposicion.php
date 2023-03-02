<?php

namespace App\Entity;

use App\Repository\DisposicionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DisposicionRepository::class)]
class Disposicion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $mesas = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMesas(): array
    {
        return $this->mesas;
    }

    public function setMesas(array $mesas): self
    {
        $this->mesas = $mesas;

        return $this;
    }
}
