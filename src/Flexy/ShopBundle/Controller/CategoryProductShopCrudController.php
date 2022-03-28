<?php

namespace App\Flexy\ShopBundle\Controller;


use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CategoryProductShopCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CategoryProductShop::class;
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
