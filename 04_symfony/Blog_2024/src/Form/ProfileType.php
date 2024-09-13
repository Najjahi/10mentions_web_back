<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Profile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class Profile1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('picture', FileType::class, [
            'label' => 'Image de votre profile',

            // unmapped means that this field is not associated to any entity property
            'mapped' => false,

            // unmapped fields can't define their validation using annotations
            // in the associated entity, so you can use the PHP constraint classes
            'constraints' => [
                new File([
                    'maxSize' => '1024k',
                    'mimeTypes' => [
                        'image/png',
                        'image/jpeg',
                    ],
                    'mimeTypesMessage' => 'Merci d\'insérer une image valide (.jpeg ou .png)',
                ])
            ],
        ])
        ->add('description', TextareaType::class, [
            'attr' => [
                'rows' => 10
            ]
        ])
        ->add('dateBirth', BirthdayType::class, [

            'input' => 'datetime_immutable',
            'placeholder' => [
                'year' => 'Year',
                'month'=> 'Month',
                'day' => 'Day'
            ]
        ])
        ->add('submit',SubmitType::class, [

            'label'=> 'Enregister'
        ])

;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Profile::class,
        ]);
    }
}
