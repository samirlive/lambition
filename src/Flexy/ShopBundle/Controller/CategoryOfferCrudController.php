<?php

namespace App\Flexy\ShopBundle\Controller;

use App\Flexy\BookingBundle\Entity\CategoryOffer;
use App\Flexy\ShopBundle\Entity\Product\CategoryProduct;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\PercentField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\FieldDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;

class CategoryOfferCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CategoryProduct::class;
    }


    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {

        $em = $this->getDoctrine()->getManager();

        

        parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);



        
        $response = $this->get(EntityRepository::class)->createQueryBuilder($searchDto, $entityDto, $fields, $filters);
        
        $response->andWhere("entity.forProductType = 'offer'");
        return $response;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setPageTitle('index', 'Familles Services')
        ->setEntityLabelInSingular('Famille')
        ->setEntityLabelInPlural('Familles Services')
            ->setDefaultSort(['id' => 'DESC'])
    
        ;
    }

    public function createEntity(string $entityFqcn)
    {
        $entity = new CategoryProduct();
        $entity->setForProductType("offer");

        return $entity;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextEditorField::new('description'),
            ImageField::new('image',"Image principale")->setUploadDir("public/uploads")->setBasePath("/uploads"),
            PercentField::new('commission'),
        ];
    }
    
}
