<?php

namespace App\Flexy\ShopBundle\Entity\Product;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Flexy\ShopBundle\Repository\Product\AttributRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AttributRepository::class)
 */
#[ApiResource]
class Attribut
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity=AttributValue::class, mappedBy="attribut")
     */
    private $attributValues;

    /**
     * @ORM\ManyToMany(targetEntity=CategoryProduct::class, mappedBy="attributes")
     */
    private $categoriesProduct;

    public function __construct()
    {
        $this->attributValues = new ArrayCollection();
        $this->categoriesProduct = new ArrayCollection();
        $this->type = "text";
    }

    public function __toString()
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|AttributValue[]
     */
    public function getAttributValues(): Collection
    {
        return $this->attributValues;
    }

    public function addAttributValue(AttributValue $attributValue): self
    {
        if (!$this->attributValues->contains($attributValue)) {
            $this->attributValues[] = $attributValue;
            $attributValue->setAttribut($this);
        }

        return $this;
    }

    public function removeAttributValue(AttributValue $attributValue): self
    {
        if ($this->attributValues->removeElement($attributValue)) {
            // set the owning side to null (unless already changed)
            if ($attributValue->getAttribut() === $this) {
                $attributValue->setAttribut(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CategoryProduct[]
     */
    public function getCategoriesProduct(): Collection
    {
        return $this->categoriesProduct;
    }

    public function addCategoriesProduct(CategoryProduct $categoriesProduct): self
    {
        if (!$this->categoriesProduct->contains($categoriesProduct)) {
            $this->categoriesProduct[] = $categoriesProduct;
            $categoriesProduct->addAttribute($this);
        }

        return $this;
    }

    public function removeCategoriesProduct(CategoryProduct $categoriesProduct): self
    {
        if ($this->categoriesProduct->removeElement($categoriesProduct)) {
            $categoriesProduct->removeAttribute($this);
        }

        return $this;
    }
}
