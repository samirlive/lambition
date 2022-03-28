<?php

namespace App\Flexy\FrontBundle\Controller\Admin;

use App\Flexy\FrontBundle\Entity\PubBanner;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class PubBannerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PubBanner::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            ImageField::new('image')->setUploadDir("public/uploads")->setBasePath("/uploads"),
            UrlField::new('lien'),
            TextField::new('grandTitre'),
            TextField::new('petitTitre'),
            TextField::new('textePrix'),
            TextField::new('titreBtn',"Texte Bouton CTA"),
            BooleanField::new("isTextWhite"),
            ChoiceField::new("emplacement")->setChoices([
                "TopBanner"=>"topBanner",
                "Debut de page accueil"=>"beginHeader",
                "En bas de produit phares"=>"bellowArrival",
                "Section black friday"=>"blackFridaySection",
                "Grande banniere millieu"=>"bigBanner",
                
            ]),
            BooleanField::new('isEnabled',"Activer/Desactiver"),
        ];
    }
    
}
