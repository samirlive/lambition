<?php

namespace App\Flexy\FrontBundle\Form;

use App\Entity\User;
use App\Flexy\ShopBundle\Entity\Vendor\Vendor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Vich\UploaderBundle\Form\Type\VichFileType;

class RegistrationVendorFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name')
        ->add('fullName')
        ->add('tel')
        ->add('email',null,["required"=> true])
        ->add('address')
        ->add('city',null,["label"=>"ville"])
        ->add('ICE')
        ->add('imageIceFile', VichFileType::class, [
            'required' => false,
            'allow_delete' => true,
            'delete_label' => '...',
            'download_uri' => '...',
            'download_label' => '...',
            'asset_helper' => true,
        ])
        ->add('RC')
        ->add('imageRCFile', VichFileType::class, [
            'required' => false,
            'allow_delete' => true,
            'delete_label' => '...',
            'download_uri' => '...',
            'download_label' => '...',
            'asset_helper' => true,
        ])
        ->add('IdentifiantFiscale')
        ->add('imageIFFile', VichFileType::class, [
            'required' => false,
            'allow_delete' => true,
            'delete_label' => '...',
            'download_uri' => '...',
            'download_label' => '...',
            'asset_helper' => true,
        ])
        ->add('simulateUsername',null,["label"=>"identifiant"])
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
        

        /*
            ->add('username')
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
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


            */
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vendor::class,
        ]);
    }
}
