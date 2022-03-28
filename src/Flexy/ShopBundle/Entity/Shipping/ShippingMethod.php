<?php

namespace App\Flexy\ShopBundle\Entity\Shipping;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\Flexy\ShopBundle\Entity\Shipping\ShippingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ShippingRepository::class)
 */
#[ApiResource]
class ShippingMethod
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isEnabled;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity=Shippment::class, mappedBy="method")
     */
    private $shippments;

    public function __construct()
    {
        $this->shippments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|Shippment[]
     */
    public function getShippments(): Collection
    {
        return $this->shippments;
    }

    public function addShippment(Shippment $shippment): self
    {
        if (!$this->shippments->contains($shippment)) {
            $this->shippments[] = $shippment;
            $shippment->setMethod($this);
        }

        return $this;
    }

    public function removeShippment(Shippment $shippment): self
    {
        if ($this->shippments->removeElement($shippment)) {
            // set the owning side to null (unless already changed)
            if ($shippment->getMethod() === $this) {
                $shippment->setMethod(null);
            }
        }

        return $this;
    }
}
