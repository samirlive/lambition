<?php

namespace App\Flexy\FrontBundle\Controller\Admin;

use App\Flexy\FrontBundle\Entity\Page;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class PageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Page::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('title'),
            TextEditorField::new('contentHtml'),
            ImageField::new('image')->setUploadDir("public/uploads")->setBasePath("uploads/"),
            ChoiceField::new('type')->setChoices([
                'Page Niveau'=>"pageniveau",
                'PageVie'=>"pagevie",
                'Page'=>"page",
                'Event'=>"event",
            ]),
            Field::new('position'),
        ];
    }
    
}
