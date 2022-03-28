<?php

namespace App\Flexy\ShopBundle\Form\Product;

use App\Flexy\ShopBundle\Entity\Customer\CustomerAddress;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomerAddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            //->add('email')
            //->add('createdAt')
           // ->add('firstName')
            //->add('lastName')
            ->add('address')
            ->add('phone')
            ->add('companyName')
            ->add('addressIndication')
            ->add('country')
            ->add('postCode')
            ->add('description')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CustomerAddress::class,
        ]);
    }
}
