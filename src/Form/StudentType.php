<?php

namespace App\Form;

use App\Entity\Student;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,
            [
                'label' => 'student name', 
                'required' => true,
                'attr' =>
                [
                    'minlength'=> 3
                ]
            ])
            ->add('birthday', DateType::class,
            [
                'label' => 'student birthday', 
                'required' => true,
                'widget' => 'single_text'
            ])
            ->add('address', TextType::class,
            [
                'label' => 'Course name', 
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
            ])
            ->add('email', TextType::class,
            [
                'label' => 'Course name', 
                'required' => true,
                'attr' =>
                [
                    'minlength'=> 3                    
                ]
            ])
            ->add('image')
            ->add('course')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
        ]);
    }
}
