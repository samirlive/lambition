<?php

namespace App\Flexy\ShopBundle\Controller;

use App\Controller\Admin\ProductCrudController;
use App\Flexy\ShopBundle\Entity\Shipping\City;
use App\Flexy\ShopBundle\Controller\ProductCrudController as ControllerProductCrudController;
use App\Flexy\ShopBundle\Entity\Brand;
use App\Flexy\ShopBundle\Entity\Order\Order;
use App\Flexy\ShopBundle\Entity\Promotion\Coupon;
use App\Flexy\ShopBundle\Entity\Customer\Customer;
use App\Flexy\ShopBundle\Entity\Order\DemandeFund;
use App\Flexy\ShopBundle\Entity\Payment\PaymentMethod;
use App\Flexy\ShopBundle\Entity\Product\Attribut;
use App\Flexy\ShopBundle\Entity\Product\CategoryProduct;
use App\Flexy\ShopBundle\Entity\Product\Comment;
use App\Flexy\ShopBundle\Entity\Product\Product;
use App\Flexy\ShopBundle\Entity\Promotion\Promotion;
use App\Flexy\ShopBundle\Entity\Shipping\Departement;
use App\Flexy\ShopBundle\Entity\Vendor\Vendor;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class DashboardController extends AbstractDashboardController
{


    public function configureMenuItems(): iterable
    {
        return [];
        yield MenuItem::section('Market Place');
        
        yield MenuItem::linkToCrud("Produits","fas fa-tags",Product::class)->setController(ControllerProductCrudController::class);
        yield MenuItem::linkToCrud("CategoryProduct","fas fa-code-branch",CategoryProduct::class);
        yield MenuItem::linkToCrud("Attributs","fas fa-tag",Attribut::class);
        yield MenuItem::linkToCrud("Marques","fas fa-copyright",Brand::class);
        yield MenuItem::linkToCrud("Vendeurs","fas fa-user-tie",Vendor::class);

        yield MenuItem::section('Services');
        yield MenuItem::linkToCrud("Services","fas fa-tags",Product::class)->setController(OfferProductCrudController::class);
        yield MenuItem::linkToCrud("Familles services","fas fa-code-branch",CategoryProduct::class)->setController(CategoryOfferCrudController::class);
          
        yield MenuItem::section('Gestion platform');
        yield MenuItem::subMenu('Villes', 'fas fa-home')->setSubItems([
            MenuItem::linkToCrud("Villes","fas fa-user-tie",City::class),
            MenuItem::linkToCrud('Departements', 'fas fa-home', Departement::class),
        ]);


        yield MenuItem::linkToCrud("Clients","fas fa-users",Customer::class);
        yield MenuItem::linkToCrud("Commandes","fas fa-file-invoice",Order::class)->setController(OrderCrudController::class);
        yield MenuItem::linkToCrud("Modes paiements","fas fa-wallet",PaymentMethod::class);
        yield MenuItem::linkToCrud("Promotions","fas fa-percent",Promotion::class);
        yield MenuItem::linkToCrud("Coupon","fas fa-gifts",Coupon::class);
        yield MenuItem::linkToCrud("Etat financier","fas fa-money-bill-wave",DemandeFund::class)->setController(DemandeFundCrudController::class);
        yield MenuItem::linkToCrud("Commentaires","fas fa-user-tie",Comment::class);

        
        
        
        

        
    }
}
