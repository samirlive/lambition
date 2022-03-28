<?php

namespace App\Flexy\ShopBundle\Entity\Product;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Flexy\ShopBundle\Entity\Brand;
use App\Flexy\ShopBundle\Entity\Order\OrderItem;
use App\Flexy\ShopBundle\Entity\Product\CategoryProduct;
use App\Flexy\ShopBundle\Entity\Promotion\Promotion;
use App\Flexy\ShopBundle\Entity\Vendor\Vendor;
use App\Flexy\ShopBundle\Repository\Product\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\InheritanceType;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 * @Table(name="product")
 * @Entity
 * @InheritanceType("JOINED")
 */
#[ApiResource]
class Product
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=CategoryProduct::class, inversedBy="products",cascade={"persist"})
     */
    private $categoriesProduct;

    /**
     * @ORM\OneToMany(targetEntity=AttributValue::class, mappedBy="product", cascade={"persist"})
     */
    private $attributValues;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $oldPrice;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $quantity;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $productType;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $metaTitle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $metaDescription;

    /**
     * @ORM\Column(type="simple_array", nullable=true)
     */
    private $metaKeywords = [];

    /**
     * @ORM\OneToMany(targetEntity=ImageProduct::class, mappedBy="product", cascade={"persist"})
     */
    private $images;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Gedmo\Slug(fields={"name"})
    */
    
    private $slug;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity=ProductVariant::class, mappedBy="product",cascade={"persist"})
     */
    private $productVariants;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isPriceReducedPerPercent;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $percentReduction;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $skuCode;

    /**
     * @ORM\OneToMany(targetEntity=OrderItem::class, mappedBy="product")
     */
    private $orderItems;

    /**
     * @ORM\ManyToOne(targetEntity=Promotion::class, inversedBy="products")
     */
    private $promotion;

    /**
     * @ORM\ManyToOne(targetEntity=Vendor::class, inversedBy="products")
     */
    private $vendor;

    /**
     * @ORM\ManyToOne(targetEntity=Brand::class, inversedBy="products",cascade={"persist"})
     */
    private $brand;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $shortDescription;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isPublished;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="product")
     */
    private $comments;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $skuCodeShop;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $endAt;

    /**
     * @ORM\ManyToOne(targetEntity=CategoryProduct::class, inversedBy="productsChildrens")
     */
    private $parentCategory;

    


    public function __construct()
    {
        $this->categoriesProduct = new ArrayCollection();
        $this->attributValues = new ArrayCollection();
        $this->productType = "simple";
        $this->createdAt = new \DateTimeImmutable();
        $this->images = new ArrayCollection();
        $this->productVariants = new ArrayCollection();
        $this->orderItems = new ArrayCollection();
        $this->comments = new ArrayCollection();

  
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


    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

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

    /**
     * Get the value of image
     */ 
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|CategoryProduct[]
     */
    public function getCategoriesProduct(): Collection
    {
        return $this->categoriesProduct;
    }

    public function addCategoryProduct(CategoryProduct $categoryProduct): self
    {
        if (!$this->categoriesProduct->contains($categoryProduct)) {
            $this->categoriesProduct[] = $categoryProduct;
            $categoryProduct->addProduct($this);
        }

        return $this;
    }

    public function removeCategoryProduct(CategoryProduct $categoryProduct): self
    {
        if ($this->categoriesProduct->removeElement($categoryProduct)) {
            $categoryProduct->removeProduct($this);
        }

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
            $attributValue->setProduct($this);
        }

        return $this;
    }

    public function removeAttributValue(AttributValue $attributValue): self
    {
        if ($this->attributValues->removeElement($attributValue)) {
            // set the owning side to null (unless already changed)
            if ($attributValue->getProduct() === $this) {
                $attributValue->setProduct(null);
            }
        }

        return $this;
    }

    public function getOldPrice(): ?float
    {
        return $this->oldPrice;
    }

    public function setOldPrice(?float $oldPrice): self
    {
        $this->oldPrice = $oldPrice;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getProductType(): ?string
    {
        return $this->productType;
    }

    public function setProductType(?string $productType): self
    {
        $this->productType = $productType;

        return $this;
    }

    public function getMetaTitle(): ?string
    {
        return $this->metaTitle;
    }

    public function setMetaTitle(?string $metaTitle): self
    {
        $this->metaTitle = $metaTitle;

        return $this;
    }

    public function getMetaDescription(): ?string
    {
        return $this->metaDescription;
    }

    public function setMetaDescription(?string $metaDescription): self
    {
        $this->metaDescription = $metaDescription;

        return $this;
    }

    public function getMetaKeywords(): ?array
    {
        return $this->metaKeywords;
    }

    public function setMetaKeywords(?array $metaKeywords): self
    {
        $this->metaKeywords = $metaKeywords;

        return $this;
    }

    /**
     * @return Collection|ImageProduct[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(ImageProduct $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setProduct($this);
        }

        return $this;
    }

    public function removeImage(ImageProduct $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getProduct() === $this) {
                $image->setProduct(null);
            }
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

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
     * @return Collection|ProductVariant[]
     */
    public function getProductVariants(): Collection
    {
        return $this->productVariants;
    }

    public function addProductVariant(ProductVariant $productVariant): self
    {
        if (!$this->productVariants->contains($productVariant)) {
            $this->productVariants[] = $productVariant;
            $productVariant->setProduct($this);
        }

        return $this;
    }

    public function removeProductVariant(ProductVariant $productVariant): self
    {
        if ($this->productVariants->removeElement($productVariant)) {
            // set the owning side to null (unless already changed)
            if ($productVariant->getProduct() === $this) {
                $productVariant->setProduct(null);
            }
        }

        return $this;
    }

    public function getIsPriceReducedPerPercent(): ?bool
    {
        return $this->isPriceReducedPerPercent;
    }

    public function setIsPriceReducedPerPercent(?bool $isPriceReducedPerPercent): self
    {
        $this->isPriceReducedPerPercent = $isPriceReducedPerPercent;

        return $this;
    }

    public function getPercentReduction(): ?float
    {
        return $this->percentReduction;
    }

    public function setPercentReduction(?float $percentReduction): self
    {
        $this->percentReduction = $percentReduction;

        return $this;
    }

    public function getSkuCode(): ?string
    {
        return $this->skuCode;
    }

    public function setSkuCode(?string $skuCode): self
    {
        $this->skuCode = $skuCode;

        return $this;
    }

    /**
     * @return Collection|OrderItem[]
     */
    public function getOrderItems(): Collection
    {
        return $this->orderItems;
    }

    public function addOrderItem(OrderItem $orderItem): self
    {
        if (!$this->orderItems->contains($orderItem)) {
            $this->orderItems[] = $orderItem;
            $orderItem->setProduct($this);
        }

        return $this;
    }

    public function removeOrderItem(OrderItem $orderItem): self
    {
        if ($this->orderItems->removeElement($orderItem)) {
            // set the owning side to null (unless already changed)
            if ($orderItem->getProduct() === $this) {
                $orderItem->setProduct(null);
            }
        }

        return $this;
    }

    public function getPromotion(): ?Promotion
    {
        return $this->promotion;
    }

    public function setPromotion(?Promotion $promotion): self
    {
        $this->promotion = $promotion;

        return $this;
    }


    public function getFormattedPrice(){
        return $this->price / 100;
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

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(?string $shortDescription): self
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    public function getIsPublished(): ?bool
    {
        return $this->isPublished;
    }

    public function setIsPublished(?bool $isPublished): self
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setProduct($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getProduct() === $this) {
                $comment->setProduct(null);
            }
        }

        return $this;
    }



    public function getStars5(){
        //for 5 stars
        $stars5=0;
        foreach($this->comments as $singleComment){
            if($singleComment->getRating() == 5){
                $stars5 = $stars5 + 1;
            }
            
        }
        return $stars5;
    }

    public function getStars4(){
        //for 4 stars
        $stars4=0;
        foreach($this->comments as $singleComment){
            if($singleComment->getRating() == 4){
                $stars4 = $stars4 + 1;
            }
            
        }
        return $stars4;
    }

    public function getStars3(){
        //for 3 stars
        $stars3=0;
        foreach($this->comments as $singleComment){
            if($singleComment->getRating() == 3){
                $stars3 = $stars3 + 1;
            }
            
        }
        return $stars3;
    }

    public function getStars2(){
        //for 2 stars
        $stars2=0;
        foreach($this->comments as $singleComment){
            if($singleComment->getRating() == 2){
                $stars2 = $stars2 + 1;
            }
            
        }
        return $stars2;
    }

    public function getStars1(){
        //for 5 stars
        $stars1=0;
        foreach($this->comments as $singleComment){
            if($singleComment->getRating() == 1){
                $stars1 = $stars1 + 1;
            }
            
        }
        return $stars1;
    }



    public function getRating(){
        $topRating = 0;
        $totalRating=0;

        $stars5 = $this->getStars5();
        $stars4 = $this->getStars4();
        $stars3 = $this->getStars3();
        $stars2 = $this->getStars2();
        $stars1 = $this->getStars1();



        $topRating = ($stars1 * 1 ) + ($stars2 * 2 ) + ($stars3 * 3 ) + ($stars4 * 4 )+ ($stars5 * 5 );
        $totalRating = $stars1 + $stars2 +$stars3 + $stars4 + $stars5;

        
        $result = 0;
        if($totalRating > 0){
            $result = $topRating / $totalRating;
        }
        



        return $result;

        
    }

    public function getSkuCodeShop(): ?string
    {
        if(!$this->skuCodeShop){
            return $this->skuCodeShop = "OM".$this->createdAt->format("ymdhs").$this->id;
        }
        return $this->skuCodeShop;
    }

    public function setSkuCodeShop(?string $skuCodeShop): self
    {
        $this->skuCodeShop = $skuCodeShop;

        return $this;
    }

    public function addCategoriesProduct(CategoryProduct $categoriesProduct): self
    {
        if (!$this->categoriesProduct->contains($categoriesProduct)) {
            $this->categoriesProduct[] = $categoriesProduct;
        }

        return $this;
    }

    public function removeCategoriesProduct(CategoryProduct $categoriesProduct): self
    {
        $this->categoriesProduct->removeElement($categoriesProduct);

        return $this;
    }

    public function getEndAt(): ?\DateTimeImmutable
    {
        return $this->endAt;
    }

    public function setEndAt(?\DateTimeImmutable $endAt): self
    {
        $this->endAt = $endAt;

        return $this;
    }

    public function getParentCategory(): ?CategoryProduct
    {
        return $this->parentCategory;
    }

    public function setParentCategory(?CategoryProduct $parentCategory): self
    {
        $this->parentCategory = $parentCategory;

        return $this;
    }

   



}
