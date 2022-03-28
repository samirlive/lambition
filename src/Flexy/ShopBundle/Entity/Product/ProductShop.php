<?php

namespace App\Flexy\ShopBundle\Entity\Product;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Flexy\ShopBundle\Entity\Product\Product as EntityProduct;

use App\Flexy\ShopBundle\Entity\Vendor\Vendor ;
use App\Flexy\ShopBundle\Repository\ProductShopRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Table ;

/**
 * @ORM\Entity(repositoryClass=ProductShopRepository::class)
 * @Table(name="shop_product")
 */
#[ApiResource]
class ProductShop extends EntityProduct
{



    


    /**
     * @ORM\ManyToOne(targetEntity=Vendor::class, inversedBy="products")
     */
    private $vendor;



    public function __construct()
    {
        parent::__construct();
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

 

}
