<?php

namespace App\Flexy\ShopBundle\Entity\Product;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Flexy\ShopBundle\Entity\Vendor\Vendor;
use App\Repository\Flexy\ShopBundle\Entity\Product\ImportExcelRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImportExcelRepository::class)
 */
#[ApiResource]
class ImportExcel
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
    private $file;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=Vendor::class, inversedBy="importExcels")
     */
    private $vendor;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $totalLinesImported;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $totalLinesIgnored;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(string $file): self
    {
        $this->file = $file;

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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getVendor(): ?Vendor
    {
        return $this->vendor;
    }

    public function setVendor(?Vendor $vendor): self
    {
        $this->vendor = $vendor;

        return $this;
    }

    public function getTotalLinesImported(): ?int
    {
        return $this->totalLinesImported;
    }

    public function setTotalLinesImported(?int $totalLinesImported): self
    {
        $this->totalLinesImported = $totalLinesImported;

        return $this;
    }

    public function getTotalLinesIgnored(): ?int
    {
        return $this->totalLinesIgnored;
    }

    public function setTotalLinesIgnored(?int $totalLinesIgnored): self
    {
        $this->totalLinesIgnored = $totalLinesIgnored;

        return $this;
    }
}
