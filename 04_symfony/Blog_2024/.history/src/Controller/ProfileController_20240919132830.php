<?php

namespace App\Controller;

use App\Entity\Profile;
use App\Form\Profile1Type;
use App\Repository\ProfileRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/account')]
final class ProfileController extends AbstractController
{
    #[Route(name: 'app_profile_index', methods: ['GET'])]
    public function index(ProfileRepository $profileRepository  ): Response
    {
        $user = $this->getUser();

        $categories = $categorieRepository->findAll();
        return $this->render('account/account.html.twig', [
            'profiles' => $profileRepository->findByUser($user),
            'categoriesMenu'=> $categories,
        ]);
    }

    #[Route('/new', name: 'app_profile_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger ): Response
    {
        $profile = new Profile();
        $form = $this->createForm(Profile1Type::class, $profile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $user = $this->getUser(); //Récupération de l'utilisateur connecté

            //On stock l'utilisateur connecté dans la propriété user de l'entité article
            $profile->setUser($user);

            // gestion de la picture uploadée

            $picture =$form->get('picture')->getData(); // le fichier picture
            // le nom d'origine de l'mage
            $originalPicture = pathinfo($picture->getClientOriginalName(),PATHINFO_FILENAME);

            // Sécurisation du nom du fichier (slugification)
            $safePicture = $slugger->slug($originalPicture);

            //Génération d'un nomunique pour la picture en ajoutant un identifiant unique
            $newPicture = $safePicture. '-' .uniqid() .'-'.$picture->guessExtension();

            try {
                // Déplacement de la picture vers le répértoire configuré
                $picture->move($this->getParameter('image_directory'),$newPicture);//Récupération du chemin du dossier d'images + le nouveau nom unique de la picture 
                

            } catch (FileException $th) {  //$th l'objet qui affiche l'erreur
                //Gestion des erreurs : on peut afficher un message d'erreur à l'utilisateur

                $this->addFlash('error', 'Une erreur est survenue lors du téléchargement de l\'image');
                //redirecttion vers la page du formulaire : la page actuelle
                return $this->redirectToRoute('app_article_crud_new');                               
            }

            // Mise à jour de la propriété 'picture du profile' de l'article avec le nouveau nom du fichier
            $profile->setPicture($newPicture);

            
            $entityManager->persist($profile);
            $entityManager->flush();

            return $this->redirectToRoute('app_profile_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('profile/new.html.twig', [
            'profile' => $profile,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_profile_show', methods: ['GET'])]
    public function show(Profile $profile): Response
    {
        return $this->render('profile/show.html.twig', [
            'profile' => $profile,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_profile_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Profile $profile, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(Profile1Type::class, $profile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser(); //Récupération de l'utilisateur connecté

            //On stock l'utilisateur connecté dans la propriété user de l'entité article
            $profile->setUser($user);

            // gestion de l'image uploadée

            $picture =$form->get('picture')->getData(); // le fichier image
            // le nom d'origine de l'mage
            $originalPicture = pathinfo($picture->getClientOriginalName(),PATHINFO_FILENAME);

            // Sécurisation du nom du fichier (slugification)
            $safePicture = $slugger->slug($originalPicture);

            //Génération d'un nomunique pour l'image en ajoutant un identifiant unique
            $newPicture = $safePicture. '-' .uniqid() .'-'.$picture->guessExtension();

            try {
                // Déplacement de l'image vers le répértoire configuré
                $picture->move($this->getParameter('image_directory'),$newPicture);//Récupération du chemin du dossier d'images + le nouveau nom unique de l'image 
                

            } catch (FileException $th) {  //$th l'objet qui affiche l'erreur
                //Gestion des erreurs : on peut afficher un message d'erreur à l'utilisateur

                $this->addFlash('error', 'Une erreur est survenue lors du téléchargement de l\'image');
                //redirecttion vers la page du formulaire : la page actuelle
                return $this->redirectToRoute('app_article_crud_new');                               
            }

            // Mise à jour de la propriété 'picture du profile' de l'article avec le nouveau nom du fichier
            $profile->setPicture($newPicture);
            $entityManager->flush();

            return $this->redirectToRoute('app_profile_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('profile/edit.html.twig', [
            'profile' => $profile,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_profile_delete', methods: ['POST'])]
    public function delete(Request $request, Profile $profile, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$profile->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($profile);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_profile_index', [], Response::HTTP_SEE_OTHER);
    }
}
