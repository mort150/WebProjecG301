<?php

namespace App\Form;

use App\Entity\StudentDetail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StudentDetailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('address', TextType::class,[
                'label' => 'Address',
                'required' => true,
            ])
            ->add('birthday', DateType::class,[
                'label' => 'Birthday',
                'required' => true,
                'widget' => 'single_text'
            ])
            ->add('email', TextType::class,[
                'label' => 'Email',
                'required' => true,
            ])
            ->add('phone', TextType::class,[
                'label' => 'Phone Number',
                'required' => true,
                'attr' => [
                    'minlength' => 1,
                    'maxlength' => 10,
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => StudentDetail::class,
        ]);
    }
}
