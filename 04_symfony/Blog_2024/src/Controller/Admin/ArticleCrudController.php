<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            
        IdField::new('id')->hideOnForm()
        ->hideOnIndex(),
        TextField::new('title'),
        TextEditorField::new('content'),
        ImageField::new('image')->setBasePath('assets/uploads/images/')//le dossier à partir duquel il cherche nos images
                    ->setUploadDir('/public/assets/uploads/images/')//le dossier dans lequel il stock les images à partir du easyAdmin
                    ->setUploadedFileNamePattern('[randomhash].[extension]'),
        DateTimeField::new('createdAt'),
        DateTimeField::new('updatedAt')->hideOnForm(),

        AssociationField::new('categorie','Catégories' ),//pour le relation et le champ category_id, qu'on vas le récupérer sous forme de string (la méthode est dans le fichier catégorie.php dans Entity)
        AssociationField::new('user','Utilisateur'),
        ];
    }
  
}
