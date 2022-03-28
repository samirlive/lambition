<?php

namespace App\Flexy\ShopBundle\Form;

use App\Flexy\ShopBundle\Entity\Product\ImageProduct;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class ImageProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('imageFile', VichFileType::class, [
            'required' => false,
            'allow_delete' => true,
            'delete_label' => '...',
            'download_uri' => '...',
            'download_label' => '...',
            'asset_helper' => true,
        ])
            //->add('path')
            ->add('alt')
            //->add('updatedAt')
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ImageProduct::class,
        ]);
    }
}
