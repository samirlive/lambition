<?php

namespace App\Flexy\ShopBundle\Form\Product;

use App\Flexy\ShopBundle\Entity\Product\AttributValue;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class AttributValueType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options): void
    {



        $builder

            ->add('attribut')
            ->add('value')
            ->add('price')
            ->add('quantity')
            
        ;

        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AttributValue::class,
        ]);
    }
}
