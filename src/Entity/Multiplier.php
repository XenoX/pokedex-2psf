<?php

namespace App\Entity;

use App\Repository\MultiplierRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MultiplierRepository::class)]
class Multiplier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $value = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Type $attacker = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Type $defender = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(float $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getAttacker(): ?Type
    {
        return $this->attacker;
    }

    public function setAttacker(?Type $attacker): self
    {
        $this->attacker = $attacker;

        return $this;
    }

    public function getDefender(): ?Type
    {
        return $this->defender;
    }

    public function setDefender(?Type $defender): self
    {
        $this->defender = $defender;

        return $this;
    }
}
