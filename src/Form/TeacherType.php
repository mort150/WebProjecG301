<?php

namespace App\Form;

use App\Entity\Teacher;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TeacherType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'name',
                TextType::class,
                [
                    'label' => 'Name of Teacher',
                    'required' => true,
                    'attr' => [
                        'minlength' => 2,
                        'maxlength' => 15
                    ]
                ]
            )
            ->add(
                'image',
                FileType::class,
                [
                    'label' => 'Avatar',
                    'data_class'=> null,
                    'required' => is_null($builder->getData()->getImage())

                ]
            )
            ->add('gender', ChoiceType::class, [
                'label' => 'Gender',
                'required' => true,
                'choices' => [
                    'Male' => 'Male',
                    'Female' => 'Female'
                ]
            ])
            ->add('birthday', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add(
                'email',
                TextType::class,
                [
                    'label' => 'Teacher Mail',
                    'required' => true,
                    'attr' => [
                        'minlength' => 2,
                        'maxlength' => 50
                    ]
                ]
            )
            ->add(
                'phone',
                NumberType::class,
                [
                    'label' => 'Teacher Number',
                    'required' => true,
                    'attr' => [
                        'min' => 10,
                        'max' => 10
                    ]
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Teacher::class,
        ]);
    }
}
