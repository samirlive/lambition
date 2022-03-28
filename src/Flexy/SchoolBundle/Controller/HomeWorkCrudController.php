<?php

namespace App\Flexy\SchoolBundle\Controller;

use App\Flexy\SchoolBundle\Entity\HomeWork;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class HomeWorkCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return HomeWork::class;
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
