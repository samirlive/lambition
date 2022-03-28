<?php

namespace App\Flexy\ShopBundle\Controller\Vendor;


use Doctrine\ORM\QueryBuilder;
use App\Flexy\ShopBundle\Entity\Order\Order;
use App\Flexy\ShopBundle\Entity\Vendor\Vendor;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Dto\FieldDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;


use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;
use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\DateTimeFilter;

class VendorStatementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Order::class;
    }


    public function configureCrud(Crud $crud): Crud
{
    return $crud
        // the visible title at the top of the page and the content of the <title> element
        // it can include these placeholders:
        //   %entity_name%, %entity_as_string%,
        //   %entity_id%, %entity_short_id%
        //   %entity_label_singular%, %entity_label_plural%
        ->setPageTitle('index', 'Etat Financier')

        
    ;
}


    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(DateTimeFilter::new('createdAt'))
        ;
    }

    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {

        $em = $this->getDoctrine()->getManager();

        

        parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);



        $vendor = $em->getRepository(Vendor::class)->findOneBy(["user"=>$this->getUser()]);
        $response = $this->get(EntityRepository::class)->createQueryBuilder($searchDto, $entityDto, $fields, $filters);
        $response->leftJoin("entity.orderItems ","orderItems");
        $response->leftJoin("orderItems.product ","product");
        $response->andWhere("product.vendor = :vendor");
        $response->setParameter("vendor",$vendor);
        return $response;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new('orderNumber'),
            
            
            AssociationField::new('demandeFund',"Demandé")->hideOnIndex(),
            //AssociationField::new('customer'),
            ChoiceField::new('status')->setChoices([
                "new"=>"new",
                "order_finance_verification_pending"=>"order_finance_verification_pending",
                "order_verification_in_progress"=>"order_verification_in_progress",
                "exportable"=>"exportable",
                "exported"=>"exported",
                "shipped"=>"shipped",
                "out_for_delivery"=>"out_for_delivery",
                "delivered"=>"delivered",
                "delivery_failed"=>"delivery_failed",
                "closed"=>"closed",
                "in_return"=>"in_return",
                "returned"=>"returned",
                "replaced"=>"replaced",
                "return_denied"=>"return_denied",
                "refunded"=>"refunded",
                "canceled"=>"canceled",
            ]),
            Field::new("totalAmount"),
            MoneyField::new("refunds")->setCurrency("MAD"),
            MoneyField::new("revenus")->setCurrency("MAD"),
            MoneyField::new("balance")->setCurrency("MAD"),
            MoneyField::new("payout")->setCurrency("MAD"),
        ];
    }
    
}
