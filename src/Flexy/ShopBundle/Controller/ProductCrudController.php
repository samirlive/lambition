<?php

namespace App\Flexy\ShopBundle\Controller;

use App\Flexy\ShopBundle\Entity\Product\AttributValue;
use App\Flexy\ShopBundle\Entity\Product\Product;
use App\Flexy\ShopBundle\Form\ImageProductType;
use App\Flexy\ShopBundle\Form\Product\AttributValueType;
use App\Flexy\ShopBundle\Form\Product\ProductVariantType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\BatchActionDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\PercentField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use phpDocumentor\Reflection\Types\Boolean;


use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\FieldDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            // ...
            ->addBatchAction(Action::new('publish', 'Publish/UnPublish')
                ->linkToCrudAction('publishProducts')
                ->addCssClass('btn btn-primary')
                ->setIcon('fa fa-user-check'))
        ;
    }


    public function configureCrud(Crud $crud): Crud
    {
        return $crud
     
            ->setDefaultSort(['id' => 'DESC'])
    
        ;
    }

    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {

        $em = $this->getDoctrine()->getManager();

        

        parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);



        
        $response = $this->get(EntityRepository::class)->createQueryBuilder($searchDto, $entityDto, $fields, $filters);
        
        $response->andWhere("entity.productType <> 'offer'");
        return $response;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('name')
            ->add('price')
            ->add('categoriesProduct')
            ->add('promotion')
            ->add('vendor')
        ;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addTab('Details de produit'),
            IdField::new('id')->onlyOnIndex(),
            BooleanField::new("isPublished"),
            TextField::new('name',"Nom de produit"),
            AssociationField::new('categoriesProduct'),
            AssociationField::new('brand',"Marque"),
            TextField::new('skuCode',"Code SKU "),
            TextField::new('skuCodeShop',"Code SKU O'Mall")->onlyOnIndex(),
            /*ChoiceField::new('productType',"Type de produit")->setChoices(
                [
                    "Simple"=>"simple",
                    "Produit Variable"=>"variable"
                ]
            ),*/
            ImageField::new('image',"Image principale")->setUploadDir("public/uploads")->setBasePath("/uploads"),

            TextareaField::new('shortDescription',"Description courte"),
            TextEditorField::new('description'),

            FormField::addTab('Tarification'),
            MoneyField::new('price',"Prix de vente")->setCurrency("MAD"),
            MoneyField::new('oldPrice',"Ancien prix")->setCurrency("MAD"),
            AssociationField::new("promotion"),
            //BooleanField::new('isPriceReducedPerPercent',"Réduction pourcentage"),
            //PercentField::new('percentReduction',"Reduction prix"),
            NumberField::new('quantity',"Stock disponible"),
            
            FormField::addTab('Associations'),
            AssociationField::new("vendor"),
            CollectionField::new('attributValues')->setEntryType(AttributValueType::class)->setEntryIsComplex(true),
            
            FormField::addTab('Section SEO'),
            TextField::new('metaTitle'),
            TextareaField::new('metaDescription'),
            ArrayField::new('metaKeywords'),
            
            FormField::addTab('Gallerie images'),
            CollectionField::new('images')->setEntryType(ImageProductType::class),
            /*
            FormField::addTab('Variations de produit'),
            CollectionField::new('productVariants',"Ajouter des variations produit")->setEntryType(ProductVariantType::class)->setEntryIsComplex(true),
            */
        ];
    }


    public function publishProducts(BatchActionDto $batchActionDto)
    {
        $entityManager = $this->getDoctrine()->getManagerForClass($batchActionDto->getEntityFqcn());
        foreach ($batchActionDto->getEntityIds() as $id) {
            $user = $entityManager->find(Product::class,$id);
            $user->setIsPublished(!$user->getIsPublished());
        }

        $entityManager->flush();

        return $this->redirect($batchActionDto->getReferrerUrl());
    }
    
}
