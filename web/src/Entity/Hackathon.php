<?php

namespace App\Entity;

use App\Repository\HackathonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HackathonRepository::class)]
class Hackathon
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column]
    private ?int $nb_place = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\OneToMany(mappedBy: 'un_Hackathon', targetEntity: Inscription::class)]
    private Collection $les_Inscriptions;

    public function __construct()
    {
        $this->les_Inscriptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getNbPlace(): ?int
    {
        return $this->nb_place;
    }

    public function setNbPlace(int $nb_place): static
    {
        $this->nb_place = $nb_place;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection<int, Inscription>
     */
    public function getLesInscriptions(): Collection
    {
        return $this->les_Inscriptions;
    }

    public function addLesInscription(Inscription $lesInscription): static
    {
        if (!$this->les_Inscriptions->contains($lesInscription)) {
            $this->les_Inscriptions->add($lesInscription);
            $lesInscription->setUnHackathon($this);
        }

        return $this;
    }

    public function removeLesInscription(Inscription $lesInscription): static
    {
        if ($this->les_Inscriptions->removeElement($lesInscription)) {
            // set the owning side to null (unless already changed)
            if ($lesInscription->getUnHackathon() === $this) {
                $lesInscription->setUnHackathon(null);
            }
        }

        return $this;
    }
}
