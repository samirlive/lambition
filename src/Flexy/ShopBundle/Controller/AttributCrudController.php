<?php

namespace App\Flexy\ShopBundle\Controller;

use App\Flexy\ShopBundle\Entity\Product\Attribut;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class AttributCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Attribut::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            ChoiceField::new('type')->setChoices(
                [
                    "texte"=>"text",
                    "Couleur"=>"color",
                    "Selection"=>"select",
                    "Image"=>"image"
                ]
            ),
            AssociationField::new("categoriesProduct"),
            TextEditorField::new('description'),
        ];
    }
}
