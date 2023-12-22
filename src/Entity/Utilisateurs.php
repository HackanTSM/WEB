<?php

namespace App\Entity;

use App\Repository\UtilisateursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UtilisateursRepository::class)]
class Utilisateurs implements UserInterface , PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 10)]
    private ?string $tel = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_naissance = null;

    #[ORM\Column(length: 255)]
    private ?string $portfolio = null;

    #[ORM\Column(length: 255)]
    private ?string $login = null;

    #[ORM\Column(length: 255)]
    private ?string $mdp = null;

    #[ORM\Column(length: 11)]
    private ?string $sel = null;

    #[ORM\OneToMany(mappedBy: 'un_Utilisateur', targetEntity: Inscription::class)]
    private Collection $mes_inscriptions;


    #[ORM\Column(type:"json")]
    private $roles = [];

    public function getUserIdentifier(): string
    {
        return (string) $this->prenom." ".$this->nom;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }

    public function getPassword(): string
    {
        // à remplacer éventuellement par la propriété contenant le mot de passe
        return $this->mdp;
    }

    public function setPassword(string $password): self
    {
        // à remplacer éventuellement par la propriété contenant le mot de passe
        $this->mdp = $password;
        return $this;
    }

    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * Returning a salt is only needed if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    public function __construct()
    {
        $this->mes_inscriptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }
    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): static
    {
        $this->tel = $tel;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(\DateTimeInterface $date_naissance): static
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    public function getPortfolio(): ?string
    {
        return $this->portfolio;
    }

    public function setPortfolio(string $portfolio): static
    {
        $this->portfolio = $portfolio;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): static
    {
        $this->login = $login;

        return $this;
    }

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): static
    {
        $this->mdp = $mdp;

        return $this;
    }

    public function getSel(): ?string
    {
        return $this->sel;
    }

    public function setSel(string $sel): static
    {
        $this->sel = $sel;

        return $this;
    }

    /**
     * @return Collection<int, Inscription>
     */
    public function getMesInscriptions(): Collection
    {
        return $this->mes_inscriptions;
    }

    public function addMesInscription(Inscription $mesInscription): static
    {
        if (!$this->mes_inscriptions->contains($mesInscription)) {
            $this->mes_inscriptions->add($mesInscription);
            $mesInscription->setUnUtilisateur($this);
        }

        return $this;
    }

    public function removeMesInscription(Inscription $mesInscription): static
    {
        if ($this->mes_inscriptions->removeElement($mesInscription)) {
            // set the owning side to null (unless already changed)
            if ($mesInscription->getUnUtilisateur() === $this) {
                $mesInscription->setUnUtilisateur(null);
            }
        }

        return $this;
    }
}
