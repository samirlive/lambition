<?php

namespace App\Flexy\StockBundle\Controller;

use App\Flexy\StockBundle\Entity\Document;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class DocumentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Document::class;
    }


    public function configureCrud(Crud $crud): Crud
    {
        return $crud->overrideTemplates([
            "crud/edit"=>"@Flexy/StockBundle/templates/documents/edit.html.twig"
        ]);
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            ChoiceField::new("type")->setChoices([
                "Devis"=>"estimate",
                "Bon de commande"=>"purchase-order",
                "Bon de livraison"=>"delivery",
                "Facture"=>"invoice",
                "Avoir/Retour"=>"credit-memo",
            ]),
            AssociationField::new("stocks"),
            TextareaField::new("description")
        ];
    }
    
}
