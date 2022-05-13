<?php

namespace App\Entity;

use App\Repository\RessourcesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RessourcesRepository::class)]
class Ressources
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $typesressource;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255)]
    private $quantite;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\Column(type: 'datetime')]
    private $datecreation;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $status;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'ressources')]
    #[ORM\JoinColumn(nullable: false)]
    private $posseseur;

    #[ORM\ManyToOne(targetEntity: Salles::class, inversedBy: 'ressources')]
    #[ORM\JoinColumn(nullable: false)]
    private $salle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypesressource(): ?string
    {
        return $this->typesressource;
    }

    public function setTypesressource(string $typesressource): self
    {
        $this->typesressource = $typesressource;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getQuantite(): ?string
    {
        return $this->quantite;
    }

    public function setQuantite(string $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDatecreation(): ?\DateTimeInterface
    {
        return $this->datecreation;
    }

    public function setDatecreation(\DateTimeInterface $datecreation): self
    {
        $this->datecreation = $datecreation;

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
