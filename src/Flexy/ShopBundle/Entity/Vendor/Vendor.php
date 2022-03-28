<?php

namespace App\Flexy\ShopBundle\Entity\Vendor;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\User;
use App\Flexy\ShopBundle\Entity\Product\ImportExcel;
use App\Flexy\ShopBundle\Entity\Product\Product;
use App\Flexy\ShopBundle\Entity\Product\ProductShop;
use App\Flexy\ShopBundle\Repository\VendorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=VendorRepository::class)
 * @Vich\Uploadable
 */
#[ApiResource]
class Vendor
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
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\OneToOne(targetEntity=User::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;



    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isValid;

    /**
     * @ORM\OneToMany(targetEntity=Product::class, mappedBy="vendor")
     */
    private $products;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fullName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tel;

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
    private $ICE;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $RC;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $simulateUsername;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $simulatePassword;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $coverImage;


    /**
     * @Vich\UploadableField(mapping="join_images", fileNameProperty="pathRCImage")
     * @var File
     */
    private $imageRCFile;

        /**
     * @Vich\UploadableField(mapping="join_images", fileNameProperty="pathIceImage")
     * @var File
     */
    private $imageIceFile;

        /**
     * @Vich\UploadableField(mapping="join_images", fileNameProperty="pathIFIMAGE")
     * @var File
     */
    private $imageIFFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pathRCImage;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pathIceImage;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $pathIFImage;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $IdentifiantFiscale;

    /**
     * @ORM\OneToMany(targetEntity=ImportExcel::class, mappedBy="vendor")
     */
    private $importExcels;






    public function __toString()
    {
       return (string)$this->name;
    }
    public function __construct()
    {
        $this->user = new User();
        $this->products = new ArrayCollection();
        $this->categoryProducts = new ArrayCollection();
        $this->importExcels = new ArrayCollection();
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

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

    public function getIsValid(): ?bool
    {
        return $this->isValid;
    }

    public function setIsValid(?bool $isValid): self
    {
        $this->isValid = $isValid;

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
            $product->setVendor($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getVendor() === $this) {
                $product->setVendor(null);
            }
        }

        return $this;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): self
    {
        $this->fullName = $fullName;

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

    public function getICE(): ?string
    {
        return $this->ICE;
    }

    public function setICE(string $ICE): self
    {
        $this->ICE = $ICE;

        return $this;
    }

    public function getRC(): ?string
    {
        return $this->RC;
    }

    public function setRC(string $RC): self
    {
        $this->RC = $RC;

        return $this;
    }

    public function getSimulateUsername(): ?string
    {
        return $this->simulateUsername;
    }

    public function setSimulateUsername(string $simulateUsername): self
    {
        $this->simulateUsername = $simulateUsername;

        return $this;
    }

    public function getSimulatePassword(): ?string
    {
        return $this->simulatePassword;
    }

    public function setSimulatePassword(string $simulatePassword): self
    {
        $this->simulatePassword = $simulatePassword;

        return $this;
    }

    public function getCoverImage(): ?string
    {
        return $this->coverImage;
    }

    public function setCoverImage(?string $coverImage): self
    {
        $this->coverImage = $coverImage;

        return $this;
    }

    public function setImageRCFile(File $path = null)
    {
        $this->imageRCFile = $path;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost

    }

    public function getImageRCFile()
    {
        return $this->imageRCFile;
    }

    public function setImageIceFile(File $path = null)
    {
        $this->imageIceFile = $path;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost

    }

    public function getImageIceFile()
    {
        return $this->imageIceFile;
    }

    public function setImageIFFile(File $path = null)
    {
        $this->imageIFFile = $path;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
 
    }

    public function getImageIFFile()
    {
        return $this->imageIFFile;
    }

    public function getPathRCImage(): ?string
    {
        return $this->pathRCImage;
    }

    public function setPathRCImage(?string $pathRCImage): self
    {
        $this->pathRCImage = $pathRCImage;

        return $this;
    }

    public function getPathIceImage(): ?string
    {
        return $this->pathIceImage;
    }

    public function setPathIceImage(?string $pathIceImage): self
    {
        $this->pathIceImage = $pathIceImage;

        return $this;
    }

    public function getPathIFImage(): ?string
    {
        return $this->pathIFImage;
    }

    public function setPathIFImage(?string $pathIFImage): self
    {
        $this->pathIFImage = $pathIFImage;

        return $this;
    }

    public function getIdentifiantFiscale(): ?string
    {
        return $this->IdentifiantFiscale;
    }

    public function setIdentifiantFiscale(?string $IdentifiantFiscale): self
    {
        $this->IdentifiantFiscale = $IdentifiantFiscale;

        return $this;
    }

    /**
     * @return Collection<int, ImportExcel>
     */
    public function getImportExcels(): Collection
    {
        return $this->importExcels;
    }

    public function addImportExcel(ImportExcel $importExcel): self
    {
        if (!$this->importExcels->contains($importExcel)) {
            $this->importExcels[] = $importExcel;
            $importExcel->setVendor($this);
        }

        return $this;
    }

    public function removeImportExcel(ImportExcel $importExcel): self
    {
        if ($this->importExcels->removeElement($importExcel)) {
            // set the owning side to null (unless already changed)
            if ($importExcel->getVendor() === $this) {
                $importExcel->setVendor(null);
            }
        }

        return $this;
    }


}
