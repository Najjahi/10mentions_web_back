<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

   
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm()
                            ->hideOnIndex(),
            TextField::new('firstName','Prénom'),
            TextField::new('lastName', 'nom'),
            EmailField::new('email'),
            ChoiceField::new('roles','Rôle')-> setChoices(

                [
                    'Utilisateurs' =>'ROLE_USER',
                    'Administrateur' =>'ROLE_ADMIN'
                ]
            )->allowMultipleChoices(),
            
        ];
    }
    public function configureActions(Actions $actions): Actions
    {
        return $actions
        ->add(Crud::PAGE_INDEX,Action::DETAIL)       
        ->remove(Crud::PAGE_INDEX, Action::NEW);
    }

}
