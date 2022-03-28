<?php

namespace App\Flexy\SchoolBundle\Controller;

use App\Flexy\SchoolBundle\Entity\Bulletin;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BulletinCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Bulletin::class;
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
