<?php

namespace App\Flexy\FrontBundle\Controller\Admin;

use App\Flexy\FrontBundle\Entity\CategoryPage;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CategoryPageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CategoryPage::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
