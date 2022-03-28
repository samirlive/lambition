<?php

namespace App\Flexy\StockBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Flexy\ShopBundle\Entity\Product\Product;
use App\Flexy\StockBundle\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
#[ApiResource]
class Article extends Product
{
    /**
     * @ORM\OneToMany(targetEntity=Stock::class, mappedBy="article")
     */
    private $stocks;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $regularPrice;

    public function __construct()
    {
        parent::__construct();
        $this->stocks = new ArrayCollection();
    }

    /**
     * @return Collection|Stock[]
     */
    public function getStocks(): Collection
    {
        return $this->stocks;
    }

    public function addStock(Stock $stock): self
    {
        if (!$this->stocks->contains($stock)) {
            $this->stocks[] = $stock;
            $stock->setArticle($this);
        }

        return $this;
    }

    public function removeStock(Stock $stock): self
    {
        if ($this->stocks->removeElement($stock)) {
            // set the owning side to null (unless already changed)
            if ($stock->getArticle() === $this) {
                $stock->setArticle(null);
            }
        }

        return $this;
    }

    public function getRegularPrice(): ?float
    {
        return $this->regularPrice;
    }

    public function setRegularPrice(?float $regularPrice): self
    {
        $this->regularPrice = $regularPrice;

        return $this;
    }
}
