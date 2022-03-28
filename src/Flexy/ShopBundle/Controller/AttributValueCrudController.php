<?php

namespace App\Flexy\ShopBundle\Controller;

use App\Flexy\ShopBundle\Entity\Product\AttributValue;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AttributValueCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return AttributValue::class;
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
