<?php

namespace App\Form;

use App\Entity\Student;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', TextType::class,[
            'label' => 'Student name',
            'required'=> true,
            'attr' =>[
                'minlength' => 3,
                'maxlength' => 30
            ]
        ])

        ->add('code', TextType::class,[
            'label' => 'Student code',
            'required' =>true,
            'attr' =>[
                'minlength' => 5,
                'maxlength' => 10
            ]
        ])
        ->add('gender', ChoiceType::class,[
            'label' => 'Student gender',
            'required' => true,
            'choices' => [
                'Male' => 'Male',
                'Female' => 'Female',
                'Both' => 'Both'
            ]
        ])
        ->add('image', FileType::class,[
            'label' => 'Image',
            'data_class' => null,
            'require' => is_null($builder->getData()->getImage())
        ])
        ->add('detail', StudentDetailType::class)
    ;    
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Student::class,
        ]);
    }
}
