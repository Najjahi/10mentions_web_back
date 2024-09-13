<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Article;
use App\Entity\Categorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title' , TextType::class,
            [
                'label'=> "Titre de l'article"
            ])
            ->add('content', TextareaType::class,
            [
                'label'=> "Description de l'article"
            ])
            ->add('image', FileType::class,
            
            [
                'label'=> "Image de l'article",
                'mapped'=> false,
                'constraints'=> [
                    new File([
                        'maxSize'=>'1024k',                       
                        'mimeTypes'=> [
                            'image/png',
                            'image/jpeg'
                        ],
                        'mimeTypesMessage' => "Merci s'insérer une image valide(.jpeg ou .png)"                        
                    ])
                ]
            ])
           
            ->add('categorie', EntityType::class,
             [
                'label'=> "Catégorie de l'article",
                'class' => Categorie::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded'=> true
            ])            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
