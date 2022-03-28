<?php

namespace App\Flexy\FrontBundle\Form\Customer;

use App\Flexy\ShopBundle\Entity\Customer\CustomerAddress;
use App\Flexy\ShopBundle\Entity\Shipping\City;
use App\Flexy\ShopBundle\Entity\Shipping\Departement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
           // ->add('companyName')
            ->add('addressIndication')
           // ->add('country')
            ->add('postCode')
            ->add('description')
            ->add('city')
            
            ->add('departement')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CustomerAddress::class,
        ]);
    }
}