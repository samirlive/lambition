<?php

namespace App\Flexy\BookingBundle\Controller;

use App\Flexy\BookingBundle\Entity\Offer;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class OfferCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Offer::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextareaField::new('description'),
            MoneyField::new('price')->setCurrency("MAD"),
            MoneyField::new('oldPrice')->setCurrency("MAD"),
            ImageField::new("image")->setUploadDir("public/uploads")->setBasePath("uploads/"),
            Field::new('endAt'),
            AssociationField::new('categoryOffer'),
        ];
    }
    
}
