<?php

namespace App\Flexy\ShopBundle\Controller\Vendor;

use App\Flexy\ShopBundle\Entity\Order\Order;
use App\Flexy\ShopBundle\Entity\Vendor\Vendor;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;


use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\FieldDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;

class MyOrdersCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Order::class;
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

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->overrideTemplates([
            "crud/detail"=>"@Flexy/ShopBundle/templates/vendor/orders/orderDetail.html.twig"
        ]);
    }


    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
        ;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new('orderNumber'),
            AssociationField::new('orderItems')->hideOnIndex(),
            AssociationField::new('customer'),
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
        ];
    }
    
}
