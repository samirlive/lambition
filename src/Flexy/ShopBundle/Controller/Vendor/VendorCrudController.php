<?php

namespace App\Flexy\ShopBundle\Controller\Vendor;

use App\Flexy\ShopBundle\Entity\Vendor\Vendor;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\RedirectResponse;

class VendorCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Vendor::class;
    }

    protected function getRedirectResponseAfterSave(AdminContext $context, string $action): RedirectResponse
    {
        
            $url = $this->get(AdminUrlGenerator::class)
                ->setController(ProductCrudController::class)
                ->setAction(Action::INDEX)
                ->generateUrl();
    
            return $this->redirect($url);
        
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            ImageField::new('image')->setUploadDir("public/uploads")->setBasePath("/uploads"),
            ImageField::new('coverImage')->setUploadDir("public/uploads")->setBasePath("/uploads"),
            TextField::new('email'),
            TextEditorField::new('description'),
            TextField::new('user.username'),
            TextField::new('user.password')->onlyOnForms()->hideWhenUpdating(),
        ];
    }
    
}
