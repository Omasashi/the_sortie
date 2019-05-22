<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LieuxRepository")
 */
class Lieux
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;



    /**
     * @ORM\Column(type="string", length=30)
     */
    private $nom_lieu;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $rue;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $latitude;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $longitude;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Villes", inversedBy="ville")
     */
    private $lieux;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Sorties", mappedBy="sortie")
     */
    private $noLieux;

    public function __construct()
    {
        $this->noLieux = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    
    public function getNomLieu(): ?string
    {
        return $this->nom_lieu;
    }

    public function setNomLieu(string $nom_lieu): self
    {
        $this->nom_lieu = $nom_lieu;

        return $this;
    }

    public function getRue(): ?string
    {
        return $this->rue;
    }

    public function setRue(?string $rue): self
    {
        $this->rue = $rue;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(?float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(?float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLieux(): ?Villes
    {
        return $this->lieux;
    }

    public function setLieux(?Villes $lieux): self
    {
        $this->lieux = $lieux;

        return $this;
    }

    /**
     * @return Collection|Sorties[]
     */
    public function getNoLieux(): Collection
    {
        return $this->noLieux;
    }

    public function addNoLieux(Sorties $noLieux): self
    {
        if (!$this->noLieux->contains($noLieux)) {
            $this->noLieux[] = $noLieux;
            $noLieux->setSortie($this);
        }

        return $this;
    }

    public function removeNoLieux(Sorties $noLieux): self
    {
        if ($this->noLieux->contains($noLieux)) {
            $this->noLieux->removeElement($noLieux);
            // set the owning side to null (unless already changed)
            if ($noLieux->getSortie() === $this) {
                $noLieux->setSortie(null);
            }
        }

        return $this;
    }
}
