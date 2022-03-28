<?php

namespace App\Flexy\ShopBundle\Entity\Product;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Flexy\ShopBundle\Entity\Product\Product;
use App\Flexy\ShopBundle\Repository\Product\CategoryProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Table;

/**
 * @ORM\Entity(repositoryClass=CategoryProductRepository::class)
 * @Table(name="flexy_categoryproduct")

 */
#[ApiResource]
class CategoryProduct
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\ManyToMany(targetEntity=Product::class, mappedBy="categoriesProduct",cascade={"persist"})
     */
    private $products;

    /**
     * @ORM\ManyToOne(targetEntity=CategoryProduct::class, inversedBy="subCategories")
     */
    private $parentCategory;


    /**
     * @ORM\OneToMany(targetEntity=CategoryProduct::class, mappedBy="parentCategory")
     */
    private $subCategories;

    /**
     * @ORM\ManyToMany(targetEntity=Attribut::class, inversedBy="categoriesProduct")
     */
    private $attributes;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $commission;

    /**
     * @ORM\OneToMany(targetEntity=Product::class, mappedBy="parentCategory")
     */
    private $productsChildrens;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $forProductType;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->attributes = new ArrayCollection();
        $this->subCategories = new ArrayCollection();
        $this->productsChildrens = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        $this->products->removeElement($product);

        return $this;
    }

    public function getParentCategory(): ?self
    {
        return $this->parentCategory;
    }

    public function setParentCategory(?self $parentCategory): self
    {
        $this->parentCategory = $parentCategory;

        return $this;
    }

    /**
     * Get the value of subCategories
     */ 
    public function getSubCategories()
    {
        return $this->subCategories;
    }

    /**
     * Set the value of subCategories
     *
     * @return  self
     */ 
    public function setSubCategories($subCategories)
    {
        $this->subCategories = $subCategories;

        return $this;
    }

    /**
     * @return Collection|Attribut[]
     */
    public function getAttributes(): Collection
    {
        return $this->attributes;
    }

    public function addAttribute(Attribut $attribute): self
    {
        if (!$this->attributes->contains($attribute)) {
            $this->attributes[] = $attribute;
        }

        return $this;
    }

    public function removeAttribute(Attribut $attribute): self
    {
        $this->attributes->removeElement($attribute);

        return $this;
    }

    public function getCommission(): ?float
    {
        return $this->commission;
    }

    public function setCommission(?float $commission): self
    {
        $this->commission = $commission;

        return $this;
    }

    public function addSubCategory(CategoryProduct $subCategory): self
    {
        if (!$this->subCategories->contains($subCategory)) {
            $this->subCategories[] = $subCategory;
            $subCategory->setParentCategory($this);
        }

        return $this;
    }

    public function removeSubCategory(CategoryProduct $subCategory): self
    {
        if ($this->subCategories->removeElement($subCategory)) {
            // set the owning side to null (unless already changed)
            if ($subCategory->getParentCategory() === $this) {
                $subCategory->setParentCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProductsChildrens(): Collection
    {
        return $this->productsChildrens;
    }

    public function addProductsChildren(Product $productsChildren): self
    {
        if (!$this->productsChildrens->contains($productsChildren)) {
            $this->productsChildrens[] = $productsChildren;
            $productsChildren->setParentCategory($this);
        }

        return $this;
    }

    public function removeProductsChildren(Product $productsChildren): self
    {
        if ($this->productsChildrens->removeElement($productsChildren)) {
            // set the owning side to null (unless already changed)
            if ($productsChildren->getParentCategory() === $this) {
                $productsChildren->setParentCategory(null);
            }
        }

        return $this;
    }

    public function getForProductType(): ?string
    {
        return $this->forProductType;
    }

    public function setForProductType(?string $forProductType): self
    {
        $this->forProductType = $forProductType;

        return $this;
    }
}
