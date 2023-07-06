<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', TextType::class,[
            'attr' => [
                'class' => 'form-control'
            ],
            'label'=>'nom',
            'label_attr'=> [
                'class'=>'form-label'
            ]
        ])
            ->add('email',TextType::class,[
                'attr'=>[
                    'class'=>'form-control'
                ],
                'label'=>'email',
                'label_attr'=>['class'=>'form-label']

            ])
            ->add('password',TextType::class,[
                'attr'=>['class'=>'form-control'],
                'label'=>'password',
                'label_attr'=>['class'=>'form-label']
            ])
            ->add('age',TextType::class,[
                'attr'=>['class'=>'form-control'],
                'label'=>'age',
                'label_attr'=>['class'=>'form-label']
            ])
            ->add('submit',SubmitType::class,[
                'attr'=>['class'=>' btn btn-primary my-4'],
                'label'=>'Create User'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
