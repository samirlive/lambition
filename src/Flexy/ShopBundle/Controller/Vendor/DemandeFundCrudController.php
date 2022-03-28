<?php

namespace App\Flexy\ShopBundle\Controller\Vendor;

use App\Flexy\ShopBundle\Entity\Order\DemandeFund;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class DemandeFundCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DemandeFund::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            AssociationField::new('orders')->setQueryBuilder(function($queryBuilder){
                $queryBuilder->andWhere("entity.demandeFund IS NULL");
            }),
            TextareaField::new('comment'),
        ];
    }
    
}
