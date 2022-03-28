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
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Validator\Constraints\Email;

class RegistrationCustomerFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            //->add('description')
            ->add('email',EmailType::class,
            [
                "required"=> true,
                'constraints' => [new Email()]
            ])
            //->add('createdAt')
            ->add('firstName')
            ->add('lastName')
            ->add('address',null,["required"=> true])
            ->add('phone')
            ->add('companyName')  
            ->add('dateOfBirth',DateType::class, ['required'=>false,
            'widget' => 'single_text'])
            ->add('gender', ChoiceType::class, [  
            'choices'  => [     
                   'Male'=> 'male',
                   'Female'=> 'female',
                        
               ],]) 
            ->add('addressIndication')
            //->add('country')
            ->add('postCode')
            //->add('customerGroup')
            ->add('simulateUsername',null,["label"=>"identifiant",'mapped' => false,])
            //->add('simulatePassword')
            ->add('simulatePassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                "label"=>"Mot de passe",
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                "label"=>'Accepter les conditions génerales',
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Customer::class,
        ]);
    }
}
