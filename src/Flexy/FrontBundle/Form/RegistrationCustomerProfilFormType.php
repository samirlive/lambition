<?php

namespace App\Flexy\FrontBundle\Form;

use App\Entity\User;
use App\Flexy\ShopBundle\Entity\Customer\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class RegistrationCustomerProfilFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            //->add('description')
            ->add('email',null,["required"=> true])
            //->add('createdAt')
            ->add('firstName')
            ->add('lastName')
           // ->add('address',null,["required"=> true])
            ->add('phone')
           // ->add('companyName')  
            ->add('dateOfBirth',DateType::class, ['required'=>false,
            'widget' => 'single_text'])
            ->add('gender', ChoiceType::class, [  
            'choices'  => [     
                   'Male'=> 'male',
                   'Female'=> 'female',
                        
               ],]) 
          //  ->add('addressIndication')
            //->add('country')
            ->add('postCode')
            //->add('customerGroup')
             
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Customer::class,
        ]);
    }
}
