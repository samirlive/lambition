<?php

namespace App\Flexy\ShopBundle\Controller;

use App\Flexy\ShopBundle\Entity\Payment\PaymentMethod;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PaymentMethodCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PaymentMethod::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
