<?php

namespace App\Form;

use App\Entity\Notification;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactNotifType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',null,["label"=>"Sujet"])
            ->add('nomContact',null,["label"=>"Nom"])
            ->add('emailContact',null,["label"=>"Email"])
            ->add('message',null,["label"=>"Message"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Notification::class,
        ]);
    }
}
