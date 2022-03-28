<?php

namespace App\Flexy\StockBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Flexy\ShopBundle\Entity\Order\OrderItem;
use App\Flexy\StockBundle\Repository\StockRepository;
use App\Flexy\ProductBundle\Entity\Product;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StockRepository::class)
 */
#[ApiResource]
class Stock extends OrderItem
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
    private $movementType;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $movementObjectif;

    /**
     * @ORM\ManyToOne(targetEntity=Article::class, inversedBy="stocks")
     */
    private $article;

    /**
     * @ORM\ManyToOne(targetEntity=Document::class, inversedBy="stocks")
     */
    private $document;


    public function __toString():string
    {
        return (string)$this->description;
    }

    public function getId(): int
    {
        return $this->id;
    }


    public function getMovementType(): string
    {
        return $this->movementType;
    }

    public function setMovementType(string $movementType): self
    {
        $this->movementType = $movementType;

        return $this;
    }

    public function getMovementObjectif(): string
    {
        return $this->movementObjectif;
    }

    public function setMovementObjectif(string $movementObjectif): self
    {
        $this->movementObjectif = $movementObjectif;

        return $this;
    }

    public function getArticle(): Article
    {
        return $this->article;
    }

    public function setArticle(Article $article): self
    {
        $this->article = $article;

        return $this;
    }

    public function getDocument(): Document
    {
        return $this->document;
    }

    public function setDocument(Document $document): self
    {
        $this->document = $document;

        return $this;
    }
}
