<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class RegisterController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function index(Request $request, UserPasswordHasherInterface $userPasswordHasherInterface, EntityManagerInterface $entityManagerInterface, CategorieRepository $categorieRepository): Response
    {
        if ($this->getUser()) { // si une utilisateur est connecté 
            
            return $this->redirectToRoute('app_home'); // je le redirige vers la page d'accueil
        }

        $user = new User();// on crée un objet de classe user et je le stock dans la variable $user
        
        $form = $this->createForm(RegisterType::class, $user);// cette methode prend en paramètre :la classe du form et l'objet gerer par le form
        
        // Il faut que mon formulaire écoute et analyse la requete qui viens de la vue et vérifier s'il ya un post envoyé ou pas 
        // On utilise l'objet request crée pas symfony  et qui représente la requet HTTP entrante ( ici la requete conient des données de formulaire )

        $form->handleRequest($request);

        if ($form-> isSubmitted() && $form->isvalid()) {

            //il faut hasher le mot de passe
           
            $password = $form->get('password') ->getData();

            $passwordHasher = $userPasswordHasherInterface->hashPassword($user,$password);
            $user -> setPassword($passwordHasher);
            
            // afin de stocker les données de mon utilisateur dans la BDD on va utiliser doctrine et plus précisement l'objet insctancier de la  classe EntityManagerInterface 
            // à partir de cette variable j'utlise la mèthode propre à doctrine persiste
            
            $entityManagerInterface->persist($user);
            $entityManagerInterface->flush();

            return $this->redirectToRoute('app_login');
        }

        //Récupération des catégories

        $categories = $categorieRepository->finfAll();
       
        
        return $this->render('register/register.html.twig', [
            'formInscription' => $form->createView(),// je passe le form en var et je lui dis de me crée la vue dr mon form
            'categoriesMenu'=>$categories
        ]);
    }
}
