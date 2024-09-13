<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Profile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName',TextType::class, [

                'label'=> false,
                'required'=> false,
                'attr' => [
                    'placeholder'=> 'Votre prénom',
                ],
                'constraints'=> [
                    new Length([
                        'min'=> 2,
                        'minMessage'=> 'Votre prénom doit avoir au minimum {{ limit }} caractères',
                        'max'=> 30,
                        'maxMessage'=> 'Votre prénom doit avoir au maximum {{ limit }} caractères',
                    ]),
                    new NotBlank([
                        'message' => 'Veuillez entrer votre prenom'
                    ])
                ]
            ])
            ->add('lastName',TextType::class, [

                'label'=> false,
                'required'=> false,
                'attr' => [
                    'placeholder'=> 'Votre prénom',
                ],
                'constraints'=> [
                    new Length([
                        'min'=> 2,
                        'minMessage'=> 'Votre prénom doit avoir au minimum {{ limit }} caractères',
                        'max'=> 30,
                        'maxMessage'=> 'Votre prénom doit avoir au maximum {{ limit }} caractères',
                    ]),
                    new NotBlank([
                        'message' => 'Veuillez entrer votre nom'
                    ])
                ]
            ])
            ->add('email', EmailType::class, [

                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder'=> 'Votre email',
                ],
                'constraints'=> [                    
                    new NotBlank([
                        'message' => 'Veuillez entrer votre email'
                    ])
                ]
            ])
            // ->add('roles')
            ->add('password', RepeatedType::class, [
                'type'=> PasswordType::class,
                'required' => true,
                'first_options' => [
                    'label' => false,
                    'attr' => [
                    'placeholder'=> 'Votre mot de passe',
                ],
                'constraints'=> [
                    new Length([
                        'min'=> 8,
                        'minMessage'=> 'Votre prénom doit avoir au minimum {{ limit }} caractères',
                        'max'=> 12,
                        'maxMessage'=> 'Votre prénom doit avoir au maximum {{ limit }} caractères',
                    ])
                ]
                ],
                'second_options' => [
                    'label' => false,
                    'attr' => [
                    'placeholder'=> 'Confirmez votre mot de passe',
                    ],
               ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'S\'inscrire',
                    'attr' => [
                    'class'=> 'btn-success',
                    ],
            ]);
            // ->add('profile', EntityType::class, [
            //     'class' => Profile::class,
            //     'choice_label' => 'id',
            // ])
       }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}