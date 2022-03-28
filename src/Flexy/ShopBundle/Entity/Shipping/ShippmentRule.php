<?php

namespace App\Flexy\ShopBundle\Entity\Shipping;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\Flexy\ShopBundle\Entity\Shipping\ShippmentRuleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ShippmentRuleRepository::class)
 */
#[ApiResource]
class ShippmentRule
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime_immutable",nullable=true)
     */
    private $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
