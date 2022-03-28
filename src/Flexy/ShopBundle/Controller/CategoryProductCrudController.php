<?php

namespace App\Flexy\ShopBundle\Controller;

use App\Flexy\ShopBundle\Entity\Product\CategoryProduct;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\PercentField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CategoryProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CategoryProduct::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextEditorField::new('description'),
            ImageField::new('image',"Image principale")->setUploadDir("public/uploads")->setBasePath("/uploads"),
            ChoiceField::new('forProductType',"Pour les produits de type")->setChoices(
                [
                    "Simple"=>"simple",
                    "Service"=>"offer",
                    //"Produit Variable"=>"variable"
                ]
            ),
            PercentField::new('commission'),
        ];
    }
    
}
