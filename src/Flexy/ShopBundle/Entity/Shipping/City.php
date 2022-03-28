<?php

namespace App\Flexy\ShopBundle\Entity\Shipping;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Flexy\ShopBundle\Entity\Customer\CustomerAddress;
use App\Flexy\ShopBundle\Repository\Shipping\CityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CityRepository::class)
 */
#[ApiResource]
class City
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
     * @ORM\OneToMany(targetEntity=CityRegion::class, mappedBy="city")
     */
    private $regions;

    /**
     * @ORM\OneToMany(targetEntity=Departement::class, mappedBy="city")
     */
    private $departements;

    /**
     * @ORM\OneToMany(targetEntity=CustomerAddress::class, mappedBy="city")
     */
    private $customerAddresses;


    public function __toString()
    {
        return $this->name;
    }

    public function __construct()
    {
        $this->regions = new ArrayCollection();
        $this->departements = new ArrayCollection();
        $this->customerAddresses = new ArrayCollection();
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

    /**
     * @return Collection|CityRegion[]
     */
    public function getRegions(): Collection
    {
        return $this->regions;
    }

    public function addRegion(CityRegion $region): self
    {
        if (!$this->regions->contains($region)) {
            $this->regions[] = $region;
            $region->setCity($this);
        }

        return $this;
    }

    public function removeRegion(CityRegion $region): self
    {
        if ($this->regions->removeElement($region)) {
            // set the owning side to null (unless already changed)
            if ($region->getCity() === $this) {
                $region->setCity(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Departement[]
     */
    public function getDepartements(): Collection
    {
        return $this->departements;
    }

    public function addDepartement(Departement $departement): self
    {
        if (!$this->departements->contains($departement)) {
            $this->departements[] = $departement;
            $departement->setCity($this);
        }

        return $this;
    }

    public function removeDepartement(Departement $departement): self
    {
        if ($this->departements->removeElement($departement)) {
            // set the owning side to null (unless already changed)
            if ($departement->getCity() === $this) {
                $departement->setCity(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CustomerAddress>
     */
    public function getCustomerAddresses(): Collection
    {
        return $this->customerAddresses;
    }

    public function addCustomerAddress(CustomerAddress $customerAddress): self
    {
        if (!$this->customerAddresses->contains($customerAddress)) {
            $this->customerAddresses[] = $customerAddress;
            $customerAddress->setCity($this);
        }

        return $this;
    }

    public function removeCustomerAddress(CustomerAddress $customerAddress): self
    {
        if ($this->customerAddresses->removeElement($customerAddress)) {
            // set the owning side to null (unless already changed)
            if ($customerAddress->getCity() === $this) {
                $customerAddress->setCity(null);
            }
        }

        return $this;
    }
}
