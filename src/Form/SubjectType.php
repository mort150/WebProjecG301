<?php

namespace App\Form;

use App\Entity\Subject;
use App\Entity\SubjectCategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SubjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Subject Name',
                'required' => true,
                'attr' => [
                    'minlength' => 2,
                    'maxlength' => 30
                ]
            ])
            ->add('code', TextType::class, [
                'label' => 'Subject Code',
                'required' => true,
                'attr' => [
                    'minlength' => 3,
                    'maxlength' => 10
                ]
            ])
            ->add('description', TextType::class, [
                'label' => 'Description',
                'required' => true,
                'attr' => [
                    'minlength' => 3,
                    'maxlength' => 50,
                ]
            ])
            ->add('credit', IntegerType::class, [
                'label' => 'Credit',
                'required' => true,
                'attr' => [
                    'min' => 3,
                    'max' => 20
                ]
            ])
            // ->add('classrooms')
            ->add('subjectcategory', EntityType::class, [
                'label' => 'Major',
                'required' => true,
                'class' => SubjectCategory::class,
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Subject::class,
        ]);
    }
}
