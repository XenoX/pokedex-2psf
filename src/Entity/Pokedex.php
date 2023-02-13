<?php

namespace App\Entity;

use App\Repository\PokedexRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PokedexRepository::class)]
class Pokedex
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $captured = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $capturedAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $seenAt = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Pokemon $pokemon = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isCaptured(): ?bool
    {
        return $this->captured;
    }

    public function setCaptured(bool $captured): self
    {
        $this->captured = $captured;

        return $this;
    }

    public function getSeenAt(): ?\DateTimeImmutable
    {
        return $this->seenAt;
    }

    public function setSeenAt(\DateTimeImmutable $seenAt): self
    {
        $this->seenAt = $seenAt;

        return $this;
    }

    public function getCapturedAt(): ?\DateTimeImmutable
    {
        return $this->capturedAt;
    }

    public function setCapturedAt(?\DateTimeImmutable $capturedAt): self
    {
        $this->capturedAt = $capturedAt;

        return $this;
    }

    public function getPokemon(): ?Pokemon
    {
        return $this->pokemon;
    }

    public function setPokemon(?Pokemon $pokemon): self
    {
        $this->pokemon = $pokemon;

        return $this;
    }
}
