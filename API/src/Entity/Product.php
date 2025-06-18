<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;   // <--- ajoute cet import
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: "App\Repository\ProductRepository")]
#[ORM\Table(name: "product")]
#[ApiResource]   // <--- ajoute cette annotation pour exposer l'entité via API Platform
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 255)]
    private string $name;

    #[ORM\Column(type: "float")]
    private float $price;

    #[ORM\Column(type: "string", length: 50)]
    private string $type;

    // Getters et setters...

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }
}
