<?php

namespace App\Form;

use App\Entity\SubjectCategory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Major Name',
                'required' => true,
                'attr' => [
                    'minlength' => 2,
                    'maxlength' => 30
                ]
            ])
            ->add('description', TextType::class, [
                'label' => 'Description',
                'required' => true,
                'attr' => [
                    'minlength' => 5,
                    'maxlength' => 50
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SubjectCategory::class,
        ]);
    }
}
