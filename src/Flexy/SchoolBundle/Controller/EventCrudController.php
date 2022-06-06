<?php

namespace App\Flexy\SchoolBundle\Controller;

use App\Flexy\SchoolBundle\Entity\Event;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class EventCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Event::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new('title'),
            Field::new('slug'),
            TextareaField::new('description'),
            ImageField::new('image')->setUploadDir("public/uploads")->setBasePath("uploads/"),
            ChoiceField::new('type')->setChoices([
                "Maternelle"=>"maternelle",
                "Primaire"=>"primaire",
                "College"=>"college",
                "Lycee"=>"lycee",
            ]),
            Field::new('startAt'),
            Field::new('endAt'),
        ];
    }
    
}
