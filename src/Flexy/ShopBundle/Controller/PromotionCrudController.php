<?php

namespace App\Flexy\ShopBundle\Controller;

use App\Flexy\ShopBundle\Entity\Promotion\Promotion;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;

class PromotionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Promotion::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new("code"),
            Field::new('valeur'),
            ChoiceField::new('type')->setChoices([
                "Prix"=>"price",
                "Pourcentage"=>"percent"

            ]),
            Field::new("priority"),
            Field::new("usageLimit"),
            Field::new("startAt"),
            Field::new("endAt"),
            

        ];
    }
    
}
