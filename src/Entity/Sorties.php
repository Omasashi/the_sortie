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
    private $date_debut;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $duree;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_cloture;

    /**
     * @ORM\Column(type="integer")
     */
    private $max_inscriptions;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $infos_descriptions;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $etat_sortie;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $url_photo;

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

    public function __construct()
    {
        $this->sortieIncription = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNoSortie(): ?int
    {
        return $this->no_sortie;
    }

    public function setNoSortie(int $no_sortie): self
    {
        $this->no_sortie = $no_sortie;

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

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(\DateTimeInterface $date_debut): self
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(?int $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getDateCloture(): ?\DateTimeInterface
    {
        return $this->date_cloture;
    }

    public function setDateCloture(\DateTimeInterface $date_cloture): self
    {
        $this->date_cloture = $date_cloture;

        return $this;
    }

    public function getMaxInscriptions(): ?int
    {
        return $this->max_inscriptions;
    }

    public function setMaxInscriptions(int $max_inscriptions): self
    {
        $this->max_inscriptions = $max_inscriptions;

        return $this;
    }

    public function getInfosDescriptions(): ?string
    {
        return $this->infos_descriptions;
    }

    public function setInfosDescriptions(?string $infos_descriptions): self
    {
        $this->infos_descriptions = $infos_descriptions;

        return $this;
    }

    public function getEtatSortie(): ?int
    {
        return $this->etat_sortie;
    }

    public function setEtatSortie(?int $etat_sortie): self
    {
        $this->etat_sortie = $etat_sortie;

        return $this;
    }

    public function getUrlPhoto(): ?string
    {
        return $this->url_photo;
    }

    public function setUrlPhoto(?string $url_photo): self
    {
        $this->url_photo = $url_photo;

        return $this;
    }

    public function getOrganisateur(): ?int
    {
        return $this->organisateur;
    }

    public function setOrganisateur(int $organisateur): self
    {
        $this->organisateur = $organisateur;

        return $this;
    }

    public function getSortie(): ?Lieux
    {
        return $this->sortie;
    }

    public function setSortie(?Lieux $sortie): self
    {
        $this->sortie = $sortie;

        return $this;
    }

    public function getSortieEtat(): ?Etats
    {
        return $this->sortieEtat;
    }

    public function setSortieEtat(?Etats $sortieEtat): self
    {
        $this->sortieEtat = $sortieEtat;

        return $this;
    }

    public function getSortieSite(): ?Sites
    {
        return $this->sortieSite;
    }

    public function setSortieSite(?Sites $sortieSite): self
    {
        $this->sortieSite = $sortieSite;

        return $this;
    }

    /**
     * @return Collection|Inscriptions[]
     */
    public function getSortieIncription(): Collection
    {
        return $this->sortieIncription;
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
