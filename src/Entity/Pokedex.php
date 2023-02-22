<?php

namespace App\Entity;

use App\Repository\PokedexRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PokedexRepository::class)]
#[Assert\Expression(
    "(!this.isCaptured() and !this.getCapturedAt()) or (this.isCaptured() and this.getCapturedAt())",
    message: 'La date de capture est requise si le pokemon est capturé',
)]
#[UniqueEntity(
    fields: ['pokemon', 'user'],
    message: 'Vous avez déjà vu ou capturé ce pokemon',
    errorPath: 'pokemon',
)]
class Pokedex
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $captured;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $capturedAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $seenAt;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Pokemon $pokemon = null;

    #[ORM\ManyToOne(inversedBy: 'pokedexes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function __construct()
    {
        $this->captured = false;
        $this->seenAt = new \DateTimeImmutable();
    }

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
