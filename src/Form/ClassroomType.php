<?php

namespace App\Form;

use App\Entity\Classroom;
use App\Entity\Student;
use App\Entity\Subject;
use App\Entity\Teacher;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClassroomType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'name',
                TextType::class,
                [
                    'label' => 'Name of Class',
                    'required' => true,
                    'attr' => [
                        'minlength' => 2,
                        'maxlength' => 15
                    ]
                ]
            )
            ->add(
                'teacher',
                EntityType::class,
                [
                    'label' => 'Teacher will manage class',
                    'required' => true,
                    'class' => Teacher::class,
                    'choice_label' => 'name',
                    'multiple' => false,
                    'expanded' => true
                ]
            )
            ->add(
                'subjects',
                EntityType::class,
                [
                    'label' => 'Subjects will be in class',
                    'required' => true,
                    'class' => Subject::class,
                    'choice_label' => 'name',
                    'multiple' => true,
                    'expanded' => true
                ]
            )
            ->add(
                'students',
                EntityType::class,
                [
                    'label' => 'Subjects will be in class',
                    'required' => true,
                    'class' => Student::class,
                    'choice_label' => 'name',
                    'multiple' => true,
                    'expanded' => true
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Classroom::class,
        ]);
    }
}
