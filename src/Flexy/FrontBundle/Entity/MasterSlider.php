<?php

namespace App\Flexy\FrontBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Flexy\FrontBundle\Repository\MasterSliderRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MasterSliderRepository::class)
 */
#[ApiResource]
class MasterSlider
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $grandTitre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $petitTitre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $textePrix;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lien;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titreBtn;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isEnabled;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getGrandTitre(): ?string
    {
        return $this->grandTitre;
    }

    public function setGrandTitre(?string $grandTitre): self
    {
        $this->grandTitre = $grandTitre;

        return $this;
    }

    public function getPetitTitre(): ?string
    {
        return $this->petitTitre;
    }

    public function setPetitTitre(?string $petitTitre): self
    {
        $this->petitTitre = $petitTitre;

        return $this;
    }

    public function getTextePrix(): ?string
    {
        return $this->textePrix;
    }

    public function setTextePrix(?string $textePrix): self
    {
        $this->textePrix = $textePrix;

        return $this;
    }

    public function getLien(): ?string
    {
        return $this->lien;
    }

    public function setLien(?string $lien): self
    {
        $this->lien = $lien;

        return $this;
    }

    public function getTitreBtn(): ?string
    {
        return $this->titreBtn;
    }

    public function setTitreBtn(?string $titreBtn): self
    {
        $this->titreBtn = $titreBtn;

        return $this;
    }

    public function getIsEnabled(): ?bool
    {
        return $this->isEnabled;
    }

    public function setIsEnabled(?bool $isEnabled): self
    {
        $this->isEnabled = $isEnabled;

        return $this;
    }
}
