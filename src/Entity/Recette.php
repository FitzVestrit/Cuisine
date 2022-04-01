<?php

namespace App\Entity;

use App\Repository\RecetteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecetteRepository::class)]
class   Recette
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255)]
    private $image;

    #[ORM\Column(type: 'boolean')]
    private $isfav;

    #[ORM\Column(type: 'string', length: 50)]
    private $ing1;

    #[ORM\Column(type: 'integer')]
    private $qte1;

    #[ORM\Column(type: 'string', length: 50)]
    private $ing2;

    #[ORM\Column(type: 'integer')]
    private $qte2;

    #[ORM\Column(type: 'string', length: 50)]
    private $ing3;

    #[ORM\Column(type: 'integer')]
    private $qte3;

    #[ORM\Column(type: 'string', length: 255)]
    private $description;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getIsfav(): ?bool
    {
        return $this->isfav;
    }

    public function setIsfav(bool $isfav): self
    {
        $this->isfav = $isfav;

        return $this;
    }

    public function getIng1(): ?string
    {
        return $this->ing1;
    }

    public function setIng1(string $ing1): self
    {
        $this->ing1 = $ing1;

        return $this;
    }

    public function getQte1(): ?int
    {
        return $this->qte1;
    }

    public function setQte1(int $qte1): self
    {
        $this->qte1 = $qte1;

        return $this;
    }

    public function getIng2(): ?string
    {
        return $this->ing2;
    }

    public function setIng2(string $ing2): self
    {
        $this->ing2 = $ing2;

        return $this;
    }

    public function getQte2(): ?int
    {
        return $this->qte2;
    }

    public function setQte2(int $qte2): self
    {
        $this->qte2 = $qte2;

        return $this;
    }

    public function getIng3(): ?string
    {
        return $this->ing3;
    }

    public function setIng3(string $ing3): self
    {
        $this->ing3 = $ing3;

        return $this;
    }

    public function getQte3(): ?int
    {
        return $this->qte3;
    }

    public function setQte3(int $qte3): self
    {
        $this->qte3 = $qte3;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
