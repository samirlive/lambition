<?php

namespace App\Flexy\SchoolBundle\Controller;

use App\Flexy\SchoolBundle\Entity\Exam;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ExamCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Exam::class;
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
