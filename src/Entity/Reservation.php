<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime')]
    private $datereservation;

    #[ORM\Column(type: 'string', length: 255)]
    private $duree;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $status;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    private $posseseur;

    #[ORM\ManyToOne(targetEntity: Salles::class, inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    private $salle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatereservation(): ?\DateTimeInterface
    {
        return $this->datereservation;
    }

    public function setDatereservation(\DateTimeInterface $datereservation): self
    {
        $this->datereservation = $datereservation;

        return $this;
    }

    public function getDuree(): ?string
    {
        return $this->duree;
    }

    public function setDuree(string $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getPosseseur(): ?User
    {
        return $this->posseseur;
    }

    public function setPosseseur(?User $posseseur): self
    {
        $this->posseseur = $posseseur;

        return $this;
    }

    public function getSalle(): ?Salles
    {
        return $this->salle;
    }

    public function setSalle(?Salles $salle): self
    {
        $this->salle = $salle;

        return $this;
    }
}
