<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SortiesRepository")
 */
class Sorties
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
    private $nom;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $duree;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCloture;

    /**
     * @ORM\Column(type="integer")
     */
    private $maxInscriptions;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $infosescriptions;




    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $urlPhoto;

    /**
     * @ORM\Column(type="integer")
     */
    private $organisateur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Lieux", inversedBy="noLieux")
     */
    private $sortie;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Etats", inversedBy="sortie")
     */
    private $sortieEtat;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Sites", inversedBy="sortie")
     */
    private $sortieSite;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Inscriptions", mappedBy="sortie")
     */
    private $sortieIncription;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Participants", inversedBy="sortie")
     */
    private $sortieParticipant;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * @param mixed $dateDebut
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
    }

    /**
     * @return mixed
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * @param mixed $duree
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;
    }

    /**
     * @return mixed
     */
    public function getDateCloture()
    {
        return $this->dateCloture;
    }

    /**
     * @param mixed $dateCloture
     */
    public function setDateCloture($dateCloture)
    {
        $this->dateCloture = $dateCloture;
    }

    /**
     * @return mixed
     */
    public function getMaxInscriptions()
    {
        return $this->maxInscriptions;
    }

    /**
     * @param mixed $maxInscriptions
     */
    public function setMaxInscriptions($maxInscriptions)
    {
        $this->maxInscriptions = $maxInscriptions;
    }

    /**
     * @return mixed
     */
    public function getInfosescriptions()
    {
        return $this->infosescriptions;
    }

    /**
     * @param mixed $infosescriptions
     */
    public function setInfosescriptions($infosescriptions)
    {
        $this->infosescriptions = $infosescriptions;
    }

    /**
     * @return mixed
     */
    public function getInfosDescriptions()
    {
        return $this->infosDescriptions;
    }

    /**
     * @param mixed $infosDescriptions
     */
    public function setInfosDescriptions($infosDescriptions)
    {
        $this->infosDescriptions = $infosDescriptions;
    }

    /**
     * @return mixed
     */
    public function getEtatSortie()
    {
        return $this->etatSortie;
    }

    /**
     * @param mixed $etatSortie
     */
    public function setEtatSortie($etatSortie)
    {
        $this->etatSortie = $etatSortie;
    }

    /**
     * @return mixed
     */
    public function getUrlPhoto()
    {
        return $this->urlPhoto;
    }

    /**
     * @param mixed $urlPhoto
     */
    public function setUrlPhoto($urlPhoto)
    {
        $this->urlPhoto = $urlPhoto;
    }

    /**
     * @return mixed
     */
    public function getOrganisateur()
    {
        return $this->organisateur;
    }

    /**
     * @param mixed $organisateur
     */
    public function setOrganisateur($organisateur)
    {
        $this->organisateur = $organisateur;
    }

    /**
     * @return mixed
     */
    public function getSortie()
    {
        return $this->sortie;
    }

    /**
     * @param mixed $sortie
     */
    public function setSortie($sortie)
    {
        $this->sortie = $sortie;
    }

    /**
     * @return mixed
     */
    public function getSortieEtat()
    {
        return $this->sortieEtat;
    }

    /**
     * @param mixed $sortieEtat
     */
    public function setSortieEtat($sortieEtat)
    {
        $this->sortieEtat = $sortieEtat;
    }

    /**
     * @return mixed
     */
    public function getSortieSite()
    {
        return $this->sortieSite;
    }

    /**
     * @param mixed $sortieSite
     */
    public function setSortieSite($sortieSite)
    {
        $this->sortieSite = $sortieSite;
    }

    /**
     * @return mixed
     */
    public function getSortieIncription()
    {
        return $this->sortieIncription;
    }

    /**
     * @param mixed $sortieIncription
     */
    public function setSortieIncription($sortieIncription)
    {
        $this->sortieIncription = $sortieIncription;
    }





    public function addSortieIncription(Inscriptions $sortieIncription): self
    {
        if (!$this->sortieIncription->contains($sortieIncription)) {
            $this->sortieIncription[] = $sortieIncription;
            $sortieIncription->setSortie($this);
        }

        return $this;
    }

    public function removeSortieIncription(Inscriptions $sortieIncription): self
    {
        if ($this->sortieIncription->contains($sortieIncription)) {
            $this->sortieIncription->removeElement($sortieIncription);
            // set the owning side to null (unless already changed)
            if ($sortieIncription->getSortie() === $this) {
                $sortieIncription->setSortie(null);
            }
        }

        return $this;
    }

    public function getSortieParticipant(): ?Participants
    {
        return $this->sortieParticipant;
    }

    public function setSortieParticipant(?Participants $sortieParticipant): self
    {
        $this->sortieParticipant = $sortieParticipant;

        return $this;
    }
}
