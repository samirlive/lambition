<?php

namespace App\Flexy\StockBundle\Controller;

use App\Flexy\ShopBundle\Entity\Product\CategoryProduct;
use App\Flexy\StockBundle\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            //IdField::new('id'),
            TextField::new('name'),
            ImageField::new('image')->setUploadDir("public/uploads")->setBasePath("/uploads"),
            "regularPrice",
            "price",
            //AssociationField::new("categoryProducts"),
            TextEditorField::new('description'),
            AssociationField::new("stocks")

        ];
    }
    
}
