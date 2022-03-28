<?php

namespace App\Flexy\ShopBundle\Controller;

use App\Flexy\ShopBundle\Entity\Product\ImportExcel;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class ImportExcelCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ImportExcel::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new("createdAt")->onlyOnIndex(),
            ImageField::new('file')->setUploadDir("public/uploads")->setBasePath("/uploads")->onlyOnForms(),
            TextareaField::new('description'),
            Field::new("totalLinesImported")->onlyOnIndex(),
            Field::new("totalLinesIgnored")->onlyOnIndex(),
        ];
    }
    
}
