<?php

namespace App\Flexy\ShopBundle\Entity\Shipping;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\Flexy\ShopBundle\Entity\Shipping\ShipmentItemRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ShipmentItemRepository::class)
 */
#[ApiResource]
class ShipmentItem
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
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isShippable;

    /**
     * @ORM\ManyToOne(targetEntity=Shippment::class, inversedBy="shipmentItems")
     * @ORM\JoinColumn(nullable=false)
     */
    private $shipment;

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

    public function getIsShippable(): ?bool
    {
        return $this->isShippable;
    }

    public function setIsShippable(?bool $isShippable): self
    {
        $this->isShippable = $isShippable;

        return $this;
    }

    public function getShipment(): ?Shippment
    {
        return $this->shipment;
    }

    public function setShipment(?Shippment $shipment): self
    {
        $this->shipment = $shipment;

        return $this;
    }
}
