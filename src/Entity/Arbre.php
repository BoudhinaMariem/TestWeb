<?php

namespace App\Entity;

use App\Repository\ArbreRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: ArbreRepository::class)]
class Arbre
{
    #[ORM\Id]
    //#[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateImplantation = null;

    #[ORM\Column]
    private ?bool $aRisque = null;

    #[ORM\ManyToOne(inversedBy: 'arbres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Parc $idParc = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateImplantation(): ?\DateTimeInterface
    {
        return $this->dateImplantation;
    }

    public function setDateImplantation(\DateTimeInterface $dateImplantation): static
    {
        $this->dateImplantation = $dateImplantation;

        return $this;
    }

    public function isARisque(): ?bool
    {
        return $this->aRisque;
    }

    public function setARisque(bool $aRisque): static
    {
        $this->aRisque = $aRisque;

        return $this;
    }

    public function getIdParc(): ?Parc
    {
        return $this->idParc;
    }

    public function setIdParc(?Parc $idParc): static
    {
        $this->idParc = $idParc;

        return $this;
    }
}
