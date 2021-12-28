<?php

namespace App\Form;

use App\Entity\Course;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CourseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, 
            [
                'label' => 'Course name', 
                'required' => true,
                'attr' =>
                [
                    'minlength'=> 3
                ]
            ])
            ->add('member', TextType::class,
            
                [
                    'label' => 'member name', 
                    'required' => true,
                    'attr' =>
                    [
                        'minlength'=> 3
                    ]
                ])
            ->add('code', TextType::class,
            [
                'label' => 'code name', 
                'required' => true,
                'attr' =>
                [
                    'minlength'=> 3
                ]
            ])
            ->add('note', TextType:: class,
            [
                'label' => 'note name', 
                'required' => true,
                'attr' =>
                [
                    'minlength'=> 3
                ]
            ])
            ->add('teachers')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Course::class,
        ]);
    }
}
