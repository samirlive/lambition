<?php

namespace App\Flexy\FrontBundle\Controller\Admin;

use App\Flexy\FrontBundle\Entity\MasterSlider;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class MasterSliderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return MasterSlider::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [

            ImageField::new('image')->setUploadDir("public/uploads")->setBasePath("/uploads"),
            TextField::new('grandTitre'),
            TextField::new('petitTitre'),
            TextField::new('textePrix'),
            BooleanField::new('isEnabled'),
            TextField::new('titreBtn',"Text de bouton CTA"),
            UrlField::new('lien'),
        ];
    }
    
}
