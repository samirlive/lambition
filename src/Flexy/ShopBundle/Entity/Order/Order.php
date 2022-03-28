<?php

namespace App\Flexy\ShopBundle\Entity\Order;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Flexy\ShopBundle\Entity\Customer\Customer;
use App\Repository\Flexy\ShopBundle\Entity\Order\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\InheritanceType;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
  * @Entity
 * @InheritanceType("JOINED")
 */
#[ApiResource]
class Order
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Customer::class, inversedBy="orders",cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $customer;

    /**
     * @ORM\OneToMany(targetEntity=OrderItem::class, mappedBy="parentOrder",cascade={"persist","remove"})
     */
    private $orderItems;

    /**
     * @ORM\OneToMany(targetEntity=Adjustment::class, mappedBy="parentOrder")
     */
    private $adjustments;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $companyName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $department;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $postcode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tel;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $comment;

    /**
     * @ORM\ManyToOne(targetEntity=DemandeFund::class, inversedBy="orders")
     */
    private $demandeFund;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $status;

    public function __construct()
    {
        $this->orderItems = new ArrayCollection();
        $this->adjustments = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
    }

    public function __toString()
    {
        return "CMD000".$this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

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
            $orderItem->setParentOrder($this);
        }

        return $this;
    }

    public function removeOrderItem(OrderItem $orderItem): self
    {
        if ($this->orderItems->removeElement($orderItem)) {
            // set the owning side to null (unless already changed)
            if ($orderItem->getParentOrder() === $this) {
                $orderItem->setParentOrder(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Adjustment[]
     */
    public function getAdjustments(): Collection
    {
        return $this->adjustments;
    }

    public function addAdjustment(Adjustment $adjustment): self
    {
        if (!$this->adjustments->contains($adjustment)) {
            $this->adjustments[] = $adjustment;
            $adjustment->setParentOrder($this);
        }

        return $this;
    }

    public function removeAdjustment(Adjustment $adjustment): self
    {
        if ($this->adjustments->removeElement($adjustment)) {
            // set the owning side to null (unless already changed)
            if ($adjustment->getParentOrder() === $this) {
                $adjustment->setParentOrder(null);
            }
        }

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function setCompanyName(?string $companyName): self
    {
        $this->companyName = $companyName;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getDepartment(): ?string
    {
        return $this->department;
    }

    public function setDepartment(?string $department): self
    {
        $this->department = $department;

        return $this;
    }

    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    public function setPostcode(?string $postcode): self
    {
        $this->postcode = $postcode;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }



    public function getTotalAmount(){

        $total=0;
        foreach($this->orderItems as $singleOrderItem){
            $total = $total + $singleOrderItem->getTotalAmount();
        }
        return $total;
    }

    public function getReferenceOrder(){
        return "CMD000".$this->id;
    }

    public function getDemandeFund(): ?DemandeFund
    {
        return $this->demandeFund;
    }

    public function setDemandeFund(?DemandeFund $demandeFund): self
    {
        $this->demandeFund = $demandeFund;

        return $this;
    }

    public function getOrderNumber($secondaryPrefix=null)
    {

        $orderNumber = "CMD".$this->createdAt->format("ym").str_pad($this->id, 5, "0", STR_PAD_LEFT);

        if($secondaryPrefix){
            $orderNumber = "CMD".$this->createdAt->format("ym").str_pad($this->id, 5, "0", STR_PAD_LEFT)."-".$secondaryPrefix;
        }

        return $orderNumber;
    }

    public function getStatus(): ?string
    {
        $status = "order_finance_verification_pending";
        if($this->status)
        {
            $status = $this->status;
        }
        return $status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }


    // BySamir : TO CLEAN
    public function getRefunds()
    {
        return 0;
    }
    public function getRevenus()
    {
        return 0;
    }
    public function getBalance()
    {
        return 0;
    }

    public function getPayout()
    {
        return 0;
    }
}
