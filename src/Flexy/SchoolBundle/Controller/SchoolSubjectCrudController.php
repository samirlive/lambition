<?php

namespace App\Flexy\SchoolBundle\Controller;

use App\Flexy\SchoolBundle\Entity\SchoolSubject;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SchoolSubjectCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SchoolSubject::class;
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
