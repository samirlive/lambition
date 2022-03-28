<?php

namespace App\Flexy\ShopBundle\Entity\Promotion;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Flexy\ShopBundle\Entity\Product\Product;
use App\Flexy\ShopBundle\Repository\Promotion\PromotionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PromotionRepository::class)
 */
#[ApiResource]
class Promotion
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $valeur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $priority;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $usageLimit;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $startAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $endAt;

    /**
     * @ORM\OneToMany(targetEntity=Coupon::class, mappedBy="promotion")
     */
    private $coupons;

    /**
     * @ORM\OneToMany(targetEntity=PromotionRule::class, mappedBy="promotion", orphanRemoval=true)
     */
    private $promotionRules;

    /**
     * @ORM\OneToMany(targetEntity=PromotionAction::class, mappedBy="promotion", orphanRemoval=true)
     */
    private $promotionActions;

    /**
     * @ORM\OneToMany(targetEntity=Product::class, mappedBy="promotion")
     */
    private $products;


    public function __toString()
    {
        return $this->name;
    }

    public function __construct()
    {
        $this->type = "simple";
        $this->coupons = new ArrayCollection();
        $this->promotionRules = new ArrayCollection();
        $this->promotionActions = new ArrayCollection();
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValeur(): ?float
    {
        return $this->valeur;
    }

    public function setValeur(float $valeur): self
    {
        $this->valeur = $valeur;

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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setPriority(?int $priority): self
    {
        $this->priority = $priority;

        return $this;
    }

    public function getUsageLimit(): ?int
    {
        return $this->usageLimit;
    }

    public function setUsageLimit(?int $usageLimit): self
    {
        $this->usageLimit = $usageLimit;

        return $this;
    }

    public function getStartAt(): ?\DateTimeImmutable
    {
        return $this->startAt;
    }

    public function setStartAt(?\DateTimeImmutable $startAt): self
    {
        $this->startAt = $startAt;

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

    /**
     * @return Collection|Coupon[]
     */
    public function getCoupons(): Collection
    {
        return $this->coupons;
    }

    public function addCoupon(Coupon $coupon): self
    {
        if (!$this->coupons->contains($coupon)) {
            $this->coupons[] = $coupon;
            $coupon->setPromotion($this);
        }

        return $this;
    }

    public function removeCoupon(Coupon $coupon): self
    {
        if ($this->coupons->removeElement($coupon)) {
            // set the owning side to null (unless already changed)
            if ($coupon->getPromotion() === $this) {
                $coupon->setPromotion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PromotionRule[]
     */
    public function getPromotionRules(): Collection
    {
        return $this->promotionRules;
    }

    public function addPromotionRule(PromotionRule $promotionRule): self
    {
        if (!$this->promotionRules->contains($promotionRule)) {
            $this->promotionRules[] = $promotionRule;
            $promotionRule->setPromotion($this);
        }

        return $this;
    }

    public function removePromotionRule(PromotionRule $promotionRule): self
    {
        if ($this->promotionRules->removeElement($promotionRule)) {
            // set the owning side to null (unless already changed)
            if ($promotionRule->getPromotion() === $this) {
                $promotionRule->setPromotion(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PromotionAction[]
     */
    public function getPromotionActions(): Collection
    {
        return $this->promotionActions;
    }

    public function addPromotionAction(PromotionAction $promotionAction): self
    {
        if (!$this->promotionActions->contains($promotionAction)) {
            $this->promotionActions[] = $promotionAction;
            $promotionAction->setPromotion($this);
        }

        return $this;
    }

    public function removePromotionAction(PromotionAction $promotionAction): self
    {
        if ($this->promotionActions->removeElement($promotionAction)) {
            // set the owning side to null (unless already changed)
            if ($promotionAction->getPromotion() === $this) {
                $promotionAction->setPromotion(null);
            }
        }

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
            $product->setPromotion($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getPromotion() === $this) {
                $product->setPromotion(null);
            }
        }

        return $this;
    }
}
