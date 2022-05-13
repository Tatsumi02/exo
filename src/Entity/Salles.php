<?php

namespace App\Entity;

use App\Repository\SallesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SallesRepository::class)]
class Salles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255)]
    private $localisation;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $status;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'salles')]
    #[ORM\JoinColumn(nullable: false)]
    private $posseseur;

    #[ORM\OneToMany(mappedBy: 'posseseur', targetEntity: self::class, orphanRemoval: true)]
    private $salles;

    #[ORM\OneToMany(mappedBy: 'salle', targetEntity: Ressources::class, orphanRemoval: true)]
    private $ressources;

    #[ORM\OneToMany(mappedBy: 'salle', targetEntity: Reservation::class, orphanRemoval: true)]
    private $reservations;
    public function __construct()
    {
        $this->salles = new ArrayCollection();
        $this->ressources = new ArrayCollection();
        $this->reservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getLocalisation(): ?string
    {
        return $this->localisation;
    }

    public function setLocalisation(string $localisation): self
    {
        $this->localisation = $localisation;

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

    public function getPosseseur(): ?self
    {
        return $this->posseseur;
    }

    public function setPosseseur(?self $posseseur): self
    {
        $this->posseseur = $posseseur;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getSalles(): Collection
    {
        return $this->salles;
    }

    public function addSalle(self $salle): self
    {
        if (!$this->salles->contains($salle)) {
            $this->salles[] = $salle;
            $salle->setPosseseur($this);
        }

        return $this;
    }

    public function removeSalle(self $salle): self
    {
        if ($this->salles->removeElement($salle)) {
            // set the owning side to null (unless already changed)
            if ($salle->getPosseseur() === $this) {
                $salle->setPosseseur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Ressources>
     */
    public function getRessources(): Collection
    {
        return $this->ressources;
    }

    public function addRessource(Ressources $ressource): self
    {
        if (!$this->ressources->contains($ressource)) {
            $this->ressources[] = $ressource;
            $ressource->setSalle($this);
        }

        return $this;
    }

    public function removeRessource(Ressources $ressource): self
    {
        if ($this->ressources->removeElement($ressource)) {
            // set the owning side to null (unless already changed)
            if ($ressource->getSalle() === $this) {
                $ressource->setSalle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->setSalle($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getSalle() === $this) {
                $reservation->setSalle(null);
            }
        }

        return $this;
    }
}
