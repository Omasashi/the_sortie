<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParticipantsRepository")
 */
class Participants implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="Renseignez le pseudo")
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Your idea must be at least {{ limit }} characters long",
     *      maxMessage = "Your idea cannot be longer than {{ limit }} characters"
     * )
     *
     * @ORM\Column(type="string", length=30)
     */
    private $pseudo;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $mail;

    /**
     * @ORM\Column(type="string", length=250)
     */
    private $password;

    /**
     * @ORM\Column(type="boolean")
     */
    private $administrateur;

    /**
     * @ORM\Column(type="boolean")
     */
    private $actif;
    /**
     * @var pour l'autentification par d'entrée en base
     */
    private $roles;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $username;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Sites", inversedBy="participant")
     */
    private $siteparticipant;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Inscriptions", mappedBy="paritcipant")
     */
    private $inscriptions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Sorties", mappedBy="sortieParticipant")
     */
    private $sortie;

    public function __construct()
    {
        $this->inscriptions = new ArrayCollection();
        $this->sortie = new ArrayCollection();
    }

    /**
     * @return pour $username
     */
    public function getUsername()
    {
        return $this->getMail();
    }

    /**
     * @param
     */
    public function setUsername( $username)
    {
        $this->username = $username;
    }

    /**
     * @return pour  $roles
     */
    public function getRoles()
    {
        return ["ROLE_USER"];
    }



    public function getId(): ?int
    {
        return $this->id;
    }


    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }



    public function getAdministrateur(): ?bool
    {
        return $this->administrateur;
    }

    public function setAdministrateur(bool $administrateur): self
    {
        $this->administrateur = $administrateur;

        return $this;
    }

    public function getActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): self
    {
        $this->actif = $actif;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }



    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getSiteparticipant(): ?Sites
    {
        return $this->siteparticipant;
    }

    public function setSiteparticipant(?Sites $siteparticipant): self
    {
        $this->siteparticipant = $siteparticipant;

        return $this;
    }

    /**
     * @return Collection|Inscriptions[]
     */
    public function getInscriptions(): Collection
    {
        return $this->inscriptions;
    }

    public function addInscription(Inscriptions $inscription): self
    {
        if (!$this->inscriptions->contains($inscription)) {
            $this->inscriptions[] = $inscription;
            $inscription->addParitcipant($this);
        }

        return $this;
    }

    public function removeInscription(Inscriptions $inscription): self
    {
        if ($this->inscriptions->contains($inscription)) {
            $this->inscriptions->removeElement($inscription);
            $inscription->removeParitcipant($this);
        }

        return $this;
    }

    /**
     * @return Collection|Sorties[]
     */
    public function getSortie(): Collection
    {
        return $this->sortie;
    }

    public function addSortie(Sorties $sortie): self
    {
        if (!$this->sortie->contains($sortie)) {
            $this->sortie[] = $sortie;
            $sortie->setSortieParticipant($this);
        }

        return $this;
    }

    public function removeSortie(Sorties $sortie): self
    {
        if ($this->sortie->contains($sortie)) {
            $this->sortie->removeElement($sortie);
            // set the owning side to null (unless already changed)
            if ($sortie->getSortieParticipant() === $this) {
                $sortie->setSortieParticipant(null);
            }
        }

        return $this;
    }
}
