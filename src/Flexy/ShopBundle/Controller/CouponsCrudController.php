<?php

namespace App\Flexy\ShopBundle\Controller;

use App\Flexy\ShopBundle\Entity\Promotion\Coupon;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CouponsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Coupon::class;
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
