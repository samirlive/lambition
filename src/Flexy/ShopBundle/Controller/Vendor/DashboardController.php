<?php

namespace App\Flexy\ShopBundle\Controller\Vendor;


use App\Flexy\ShopBundle\Entity\Order\Order;
use App\Flexy\ShopBundle\Entity\CategoryProductShop;
use App\Flexy\ShopBundle\Entity\Promotion\Coupon;
use App\Flexy\ShopBundle\Entity\Customer\Customer;
use App\Flexy\ShopBundle\Entity\Payment\PaymentMethod;
use App\Flexy\ShopBundle\Entity\Product\Product;
use App\Flexy\ShopBundle\Entity\Promotion\Promotion;
use App\Flexy\ShopBundle\Entity\Shipping\ShippingMethod;
use App\Flexy\ShopBundle\Entity\Vendor\Vendor;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Flexy\ShopBundle\Controller\Vendor\ProductCrudController as VendorProductCrudController;
use App\Flexy\ShopBundle\Entity\Brand;
use App\Flexy\ShopBundle\Entity\Order\DemandeFund;
use App\Flexy\ShopBundle\Entity\Product\Attribut;
use App\Flexy\ShopBundle\Entity\Product\ImportExcel;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\RedirectResponse;



/**
     * @Route("/vendor")
     * @IsGranted("ROLE_VENDOR")
     */
class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/", name="shop_vendor")
     * @IsGranted("ROLE_VENDOR")
     */
    public function index(): Response
    {
        return parent::index();
    }




    public function configureDashboard(): Dashboard
    {

        $em = $this->getDoctrine()->getManager();
        $vendor = $em->getRepository(Vendor::class)->findOneBy(["user"=>$this->getUser()]);


        if($vendor){
            $urlImage ="../uploads/".$vendor->getImage();

        }else{
            $urlImage ="../omall/logo.png";
        }
        
        return Dashboard::new()

        ->setTitle('
        <img  style="margin:10px 0 0px 40px" src="/omall/logo.png" width="90px" />
        <br>
        <img  style="margin:0 0 0 30px" src="'.$urlImage.'" width="130px" />
        
        
        
        ')
       // ->setFaviconPath('flexy/img/favicon-flexy-white.png')
        ->setTranslationDomain('admin')
        
        
        ;
    }

    public function configureMenuItems(): iterable
    {

        $em = $this->getDoctrine()->getManager();
        $vendor = $em->getRepository(Vendor::class)->findOneBy(["user"=>$this->getUser()]);
        
        


 


        yield MenuItem::linkToCrud("Mes Produits","fas fa-tags",Product::class)->setController(VendorProductCrudController::class);
        yield MenuItem::linkToCrud("Mes Services","fas fa-tags",Product::class)->setController(OfferProductCrudController::class);
        yield MenuItem::linkToCrud("Mes commandes","fas fa-list",Order::class)->setController(MyOrdersCrudController::class);
        yield MenuItem::linkToCrud("Attributs","fas fa-tag",Attribut::class);
        yield MenuItem::linkToCrud("Marques","fas fa-copyright",Brand::class);
        yield MenuItem::linkToCrud("Promotions","fas fa-percent",Promotion::class);
        yield MenuItem::linkToCrud("Coupon","fas fa-gifts",Coupon::class);
        yield MenuItem::linkToCrud("Demande de fond (beta)","fas fa-money-bill-wave",DemandeFund::class)->setController(DemandeFundCrudController::class);
        if($vendor){
            yield MenuItem::linkToCrud("Editer mon profil","fas fa-edit",Vendor::class)->setController(VendorCrudController::class)->setAction('edit')->setEntityId($vendor->getId());
        }
        

        yield MenuItem::section('Mes services');
        

        yield MenuItem::section('Importation');
        yield MenuItem::linkToCrud("Importer produits","fas fa-file-excel",ImportExcel::class);
        yield MenuItem::linkToRoute("Aide","fas fa-file-excel","flexy_shop_bundle_import_excel_documentation");

        

        yield MenuItem::section('Infos personnelles');

       


        yield MenuItem::section('Ma boutique');
        
 yield MenuItem::linkToRoute("Mon contrat","fas fa-file","flexy_shop_bundle_pages_contract");

        //yield MenuItem::linkToCrud("Modes paiements","fas fa-list",PaymentMethod::class);

        
        yield MenuItem::linkToCrud("Etat financier","fas fa-money-bill-wave",Order::class)->setController(VendorStatementCrudController::class);


        if($vendor){
            yield MenuItem::linkToRoute('Ma boutique', 'fas fa-eye',"single_vendor", ['id' => $vendor->getId()]);
        }
        yield MenuItem::linkToRoute("Mon contrat","fas fa-file","flexy_shop_bundle_pages_contract");

         
        
    }
}
