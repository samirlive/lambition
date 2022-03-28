<?php

namespace App\Flexy\BookingBundle\Controller;

use App\Flexy\BookingBundle\Entity\CategoryOffer;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CategoryOfferCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CategoryOffer::class;
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
