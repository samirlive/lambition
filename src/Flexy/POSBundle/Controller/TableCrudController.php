<?php

namespace App\Flexy\POSBundle\Controller;

use App\Flexy\POSBundle\Entity\Table;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;

class TableCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Table::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            'name',
            'canvasX',
            'canvasY',
            'canvasScaleX',
            'canvasScaleY',
            'canvasAngle',
            ColorField::new('backgroundColor'),
        ];
    }
    
}
