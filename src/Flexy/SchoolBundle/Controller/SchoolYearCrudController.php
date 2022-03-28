<?php

namespace App\Flexy\SchoolBundle\Controller;

use App\Flexy\SchoolBundle\Entity\SchoolYear;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SchoolYearCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SchoolYear::class;
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
