<?php

namespace App\Flexy\ShopBundle\Entity\Shipping;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\Flexy\ShopBundle\Entity\Shipping\ShippmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ShippmentRepository::class)
 */
#[ApiResource]
class Shippment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $state;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $trackingCode;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=ShippingMethod::class, inversedBy="shippments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $method;

    /**
     * @ORM\OneToMany(targetEntity=ShipmentItem::class, mappedBy="shipment", orphanRemoval=true)
     */
    private $shipmentItems;

    public function __construct()
    {
        $this->shipmentItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getTrackingCode(): ?string
    {
        return $this->trackingCode;
    }

    public function setTrackingCode(?string $trackingCode): self
    {
        $this->trackingCode = $trackingCode;

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

    public function getMethod(): ?ShippingMethod
    {
        return $this->method;
    }

    public function setMethod(?ShippingMethod $method): self
    {
        $this->method = $method;

        return $this;
    }

    /**
     * @return Collection|ShipmentItem[]
     */
    public function getShipmentItems(): Collection
    {
        return $this->shipmentItems;
    }

    public function addShipmentItem(ShipmentItem $shipmentItem): self
    {
        if (!$this->shipmentItems->contains($shipmentItem)) {
            $this->shipmentItems[] = $shipmentItem;
            $shipmentItem->setShipment($this);
        }

        return $this;
    }

    public function removeShipmentItem(ShipmentItem $shipmentItem): self
    {
        if ($this->shipmentItems->removeElement($shipmentItem)) {
            // set the owning side to null (unless already changed)
            if ($shipmentItem->getShipment() === $this) {
                $shipmentItem->setShipment(null);
            }
        }

        return $this;
    }
}
