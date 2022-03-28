<?php 
# src/EventSubscriber/EasyAdminSubscriber.php
namespace App\Flexy\ShopBundle\EventSubscriber;

use App\Entity\BlogPost;
use App\Flexy\ShopBundle\Entity\Brand;
use App\Flexy\ShopBundle\Entity\Order\DemandeFund;
use App\Flexy\ShopBundle\Entity\Product\CategoryProduct;
use App\Flexy\ShopBundle\Entity\Product\ImportExcel;
use App\Flexy\ShopBundle\Entity\Product\Product;
use App\Flexy\ShopBundle\Entity\Product\ProductShop;
use App\Flexy\ShopBundle\Entity\Vendor\Vendor;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;
use Doctrine\ORM\EntityManagerInterface;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class EasyAdminSubscriber implements EventSubscriberInterface
{
    private $security;
    private $passwordEncoder;
    private $em;

    public function __construct(Security $security,UserPasswordEncoderInterface $passwordEncoder,EntityManagerInterface $entityManagerInterface)
{
        $this->security = $security;
        $this->passwordEncoder = $passwordEncoder;
        $this->em = $entityManagerInterface;
    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['beforePersist'],
            BeforeEntityUpdatedEvent::class => ['beforeUpdated'],
        ];
    }

    public function beforePersist(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        
        if ($entity instanceof ImportExcel) {


            

           
           $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        
        
            
           $spreadsheet = $reader->load("uploads/".$entity->getFile());

           
           
           $spreadsheetToArray = $spreadsheet->getActiveSheet()->toArray();
           
           $headers=$spreadsheetToArray[0];
           $dataFiltred=[];
           $allData=[];

           foreach($spreadsheetToArray as $singleRow){
            if($headers == $singleRow){
                continue;
            }
            foreach($headers as $key=>$value){
                if($value===null or $value===""){
                    continue;
                }
                $dataFiltred[str_replace(" ","",$value)]=$singleRow[$key];
            }
            $allData[]= $dataFiltred;
        }

       // dd($allData);

       

       $vendor = $this->em->getRepository(Vendor::class)->findOneBy(["user"=>$this->security->getUser()]);
       if($vendor){
           $counterImported=0;
           $counterIgnored = 0;
        foreach($allData as $singleData){

           
            $product = new Product();
            
            //BySamir : ToModify
            $product->setName((string)$singleData["NOM_PRODUIT"]);
            $product->setSkuCode((string)$singleData["CODE_EAN"]);
            $product->setName((string)$singleData["NOM_PRODUIT"]);


            $cat1 =  $this->em->getRepository(CategoryProduct::class)->findOneBy(["name"=>$singleData["CAT1"]]);
            $cat2 =  $this->em->getRepository(CategoryProduct::class)->findOneBy(["name"=>$singleData["CAT2"]]);
            $cat3 =  $this->em->getRepository(CategoryProduct::class)->findOneBy(["name"=>$singleData["CAT3"]]);
            $cat4 =  $this->em->getRepository(CategoryProduct::class)->findOneBy(["name"=>$singleData["CAT4"]]);
            $cat5 =  $this->em->getRepository(CategoryProduct::class)->findOneBy(["name"=>$singleData["CAT5"]]);

            $brand =  $this->em->getRepository(Brand::class)->findOneBy(["name"=>$singleData["MARQUE"]]);

            if($cat1){
                $product->addCategoryProduct($cat1);
            }
            if($cat2){
                $product->addCategoryProduct($cat2);
            }
            if($cat3){
                $product->addCategoryProduct($cat3);
            }
            if($cat4){
                $product->addCategoryProduct($cat4);
            }
            if($cat5){
                $product->addCategoryProduct($cat5);
            }
            
            if($brand){
                $product->setBrand($brand);
            }else{
                $brand = new Brand();
                $brand->setName((string)$singleData["MARQUE"]);
                $product->setBrand($brand);
            }
            

            $product->setPrice((float)$singleData["PRIX_VENTE"] * 100 );
            $product->setOldPrice((float)$singleData["ANCIEN_PRIX"] * 100 );
            $product->setQuantity((int)$singleData["STOCK"]);

            if($singleData["IMAGE"]){

                $newImagePath = $this->slugify($singleData["NOM_PRODUIT"]);
                copy($singleData["IMAGE"], "uploads/".$newImagePath);
                $product->setImage($newImagePath);
            }
            
            $product->setShortDescription((string)$singleData["DESCRIPTION_COURTE"]);
            $product->setDescription((string)$singleData["DESCRIPTION_COMPLETE"]);

            $product->setVendor($vendor);
            


            $this->em->persist($product);
            
            $counterImported = $counterImported + 1;
        }

        

        $entity->setTotalLinesImported($counterImported);
        $entity->setTotalLinesIgnored($counterIgnored);
       }
     


           
           
        }

        if ($entity instanceof DemandeFund) {

            foreach($entity->getOrders() as $singleOrder){
                $singleOrder->setDemandeFund($entity);
                $entity->addOrder($singleOrder);
            }
           
        }

        if ($entity instanceof Vendor) {

            
            $entity->setSimulateUsername("");
            $entity->getUser()->setRoles(["ROLE_VENDOR"]);
            $entity->getUser()->setPassword(
                $this->passwordEncoder->encodePassword(
                         $entity->getUser(),
                         $entity->getUser()->getPassword()
             ));
             //dd($entity);
        }
        if ($entity instanceof Product ) {
            $entity->setSkuCodeShop("OM".$entity->getCreatedAt()->format("ymdhs").$entity->getId());
            $vendor = $this->em->getRepository(Vendor::class)->findOneBy(["user"=>$this->security->getUser()]);
            
            $entity->setVendor($vendor);
           
        }

     
    }


    public function beforeUpdated(BeforeEntityUpdatedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if ($entity instanceof DemandeFund) {

            foreach($entity->getOrders() as $singleOrder){
                $singleOrder->setDemandeFund($entity);
                $entity->addOrder($singleOrder);
            }
           
        }

        if ($entity instanceof Vendor) {
            //dd($entity->getUser()->getPassword());
            
            /*$entity->getUser()->setRoles(["ROLE_VENDOR"]);
            $entity->getUser()->setPassword(
                $this->passwordEncoder->encodePassword(
                         $entity->getUser(),
                         $entity->getUser()->getPassword()
             ));*/
        }

        if ($entity instanceof Product ) {
            $entity->setSkuCodeShop($entity->getSkuCodeShop().$entity->getId());
            $vendor = $this->em->getRepository(Vendor::class)->findOneBy(["user"=>$this->security->getUser()]);
            
            
           
        }

     
    }


    public static function slugify($text, string $divider = '-')
{
  // replace non letter or digits by divider
  $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);

  // trim
  $text = trim($text, $divider);

  // remove duplicate divider
  $text = preg_replace('~-+~', $divider, $text);

  // lowercase
  $text = strtolower($text);

  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}

}