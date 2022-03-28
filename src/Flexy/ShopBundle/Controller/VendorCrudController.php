<?php

namespace App\Flexy\ShopBundle\Controller;

use App\Flexy\ShopBundle\Entity\Vendor\Vendor;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class VendorCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Vendor::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            TextField::new('fullName'),
            TextField::new('address'),
            TextField::new('city'),
            TextField::new('tel'),
            TextField::new('email'),
            ImageField::new('image')->setUploadDir("public/uploads")->setBasePath("/uploads"),
            ImageField::new('coverImage')->setUploadDir("public/uploads")->setBasePath("/uploads"),
            TextField::new('email'),
            TextField::new('ICE'),
            TextField::new('RC'),
            TextEditorField::new('description'),
            TextField::new('user.username'),
            TextField::new('user.password')->onlyOnForms()->hideWhenUpdating(),
            BooleanField::new('user.isValid',"Validation de compte")->onlyOnIndex(),
        ];
    }
    
}
