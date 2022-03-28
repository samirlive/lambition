<?php

namespace App\Flexy\SchoolBundle\Controller;

use App\Flexy\SchoolBundle\Entity\SchoolClass;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SchoolClassCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SchoolClass::class;
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
