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
     * @ORM\ManyToOne(targetEntity="App\Entity\Participants", inversedBy="inscriptions")
     */
    private $paritcipant;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Sorties", inversedBy="sortieIncription")
     */
    private $sortie;


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
     * @return mixed
     */
    public function getParitcipant()
    {
        return $this->paritcipant;
    }

    /**
     * @param mixed $paritcipant
     */
    public function setParitcipant($paritcipant)
    {
        $this->paritcipant = $paritcipant;
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
