<?php

namespace App\Entity;

use App\Repository\ParcRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParcRepository::class)]
class Parc
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'idParc', targetEntity: Arbre::class)]
    private Collection $arbres;

    public function __construct()
    {
        $this->arbres = new ArrayCollection();
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

    /**
     * @return Collection<int, Arbre>
     */
    public function getArbres(): Collection
    {
        return $this->arbres;
    }

    public function addArbre(Arbre $arbre): static
    {
        if (!$this->arbres->contains($arbre)) {
            $this->arbres->add($arbre);
            $arbre->setIdParc($this);
        }

        return $this;
    }

    public function removeArbre(Arbre $arbre): static
    {
        if ($this->arbres->removeElement($arbre)) {
            // set the owning side to null (unless already changed)
            if ($arbre->getIdParc() === $this) {
                $arbre->setIdParc(null);
            }
        }

        return $this;
    }
}
