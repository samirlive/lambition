<?php

namespace App\Flexy\ShopBundle\Controller;

use App\Flexy\ShopBundle\Entity\Customer\Customer;
use App\Flexy\ShopBundle\Form\Product\CustomerAddressType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;

class CustomerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Customer::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('firstName'),
            TextField::new('lastName'),
            CollectionField::new("customerAddresses")->setEntryType(CustomerAddressType::class)
        ];
    }
    
}
