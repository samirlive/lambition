<?php

namespace App\Flexy\POSBundle\Controller;

use App\Flexy\POSBundle\Entity\Caisse;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CaisseCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Caisse::class;
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
