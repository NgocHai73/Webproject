<?php

namespace App\Form;

use App\Entity\Teacher;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TeacherType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,
            [
                'label' => 'teacher name', 
                'required' => true,
                'attr' =>
                [
                    'minlength'=> 3
                ]
            ])
            ->add('subject', TextType::class,
            [
                'label' => 'subject name', 
                'required' => true,
                'attr' =>
                [
                    'minlength'=> 3
                ]
            ])
            ->add('email', TextType::class,
            [
                'label' => 'email name', 
                'required' => true,
                'attr' =>
                [
                    'minlength'=> 3
                ]
            ])
            ->add('phone', TextType::class, 
            [
                'label' => 'phone name', 
                'required' => true,
                'attr' =>
                [
                    'minlength'=> 3
                ]
            ])
            //ti code
            ->add('image')
            ->add('teachers')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Teacher::class,
        ]);
    }
}
