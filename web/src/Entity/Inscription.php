<?php

namespace App\Entity;

use App\Repository\InscriptionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InscriptionRepository::class)]
class Inscription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $num = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'les_Inscriptions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Hackathon $un_Hackathon = null;

    #[ORM\ManyToOne(inversedBy: 'mes_inscriptions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateurs $un_Utilisateur = null;

    public function getNum(): ?int
    {
        return $this->num;
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

    public function getUnHackathon(): ?Hackathon
    {
        return $this->un_Hackathon;
    }

    public function setUnHackathon(?Hackathon $un_Hackathon): static
    {
        $this->un_Hackathon = $un_Hackathon;

        return $this;
    }

    public function getUnUtilisateur(): ?Utilisateurs
    {
        return $this->un_Utilisateur;
    }

    public function setUnUtilisateur(?Utilisateurs $un_Utilisateur): static
    {
        $this->un_Utilisateur = $un_Utilisateur;

        return $this;
    }
}
