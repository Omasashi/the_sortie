<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InscriptionsRepository")
 */
class Inscriptions
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_inscription;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Participants", inversedBy="inscriptions")
     */
    private $paritcipant;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Sorties", inversedBy="sortieIncription")
     */
    private $sortie;

    public function __construct()
    {
        $this->paritcipant = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateInscription(): ?\DateTimeInterface
    {
        return $this->date_inscription;
    }

    public function setDateInscription(\DateTimeInterface $date_inscription): self
    {
        $this->date_inscription = $date_inscription;

        return $this;
    }

    /**
     * @return Collection|Participants[]
     */
    public function getParitcipant(): Collection
    {
        return $this->paritcipant;
    }

    public function addParitcipant(Participants $paritcipant): self
    {
        if (!$this->paritcipant->contains($paritcipant)) {
            $this->paritcipant[] = $paritcipant;
        }

        return $this;
    }

    public function removeParitcipant(Participants $paritcipant): self
    {
        if ($this->paritcipant->contains($paritcipant)) {
            $this->paritcipant->removeElement($paritcipant);
        }

        return $this;
    }

    public function getSortie(): ?Sorties
    {
        return $this->sortie;
    }

    public function setSortie(?Sorties $sortie): self
    {
        $this->sortie = $sortie;

        return $this;
    }
}
