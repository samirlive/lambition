<?php

namespace App\Flexy\StockBundle\Controller;

use App\Flexy\StockBundle\Entity\Stock;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class StockCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Stock::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            //IdField::new('id')->onlyOnIndex(),
            //AssociationField::new("article"),
            ChoiceField::new("movementType")->setChoices(
                [
                    "Entrée"=>"in",
                    "Sortie"=>"out"
                ]
            ),
            ChoiceField::new("movementObjectif")->setChoices(
                [
                    "Achat"=>"buy",
                    "Vente"=>"out",
                    "Composition Produit"=>"composite-product",
                    "Retour"=>"return"
                ]
            ),
            //NumberField::new("quantity"),
            TextEditorField::new('description'),
        ];
    }
    
}
