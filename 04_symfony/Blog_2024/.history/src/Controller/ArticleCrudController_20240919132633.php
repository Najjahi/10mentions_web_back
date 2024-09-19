<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/account/article/crud')]
final class ArticleCrudController extends AbstractController
{
    #[Route(name: 'app_article_crud_index', methods: ['GET'])]
    public function index(ArticleRepository $articleRepository, Ca): Response
    {
        $user = $this->getUser();
        $categories = $categorieRepository->findAll();

        return $this->render('article_crud/index.html.twig', [
            
            'articles' => $articleRepository->findByUser($user),
        ]);
    }

    #[Route('/new', name: 'app_article_crud_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);//$this fait réf à l'objet instancié en cours
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $this->getUser(); //Récupération de l'utilisateur connecté

            //On stock l'utilisateur connecté dans la propriété user de l'entité article
            $article->setUser($user);

            //Récupération de la catégorie séléctionnée dans le formulaire 

            $categories = $article->getCategorie()->getValues();

            foreach ($categories as $category) {
                //ajout de l'article à chaque catégorie
                $category->addArticle($article);
                $entityManager->persist($category);
            }

            // gestion de l'image uploadée

            $image =$form->get('image')->getData(); // le fichier image
            // le nom d'origine de l'mage
            $originalImage = pathinfo($image->getClientOriginalName(),PATHINFO_FILENAME);

            // Sécurisation du nom du fichier (slugification)
            $safeImage = $slugger->slug($originalImage);

            //Génération d'un nomunique pour l'image en ajoutant un identifiant unique
            $newImage = $safeImage. '-' .uniqid() .'-'.$image->guessExtension();

            try {
                // Déplacement de l'image vers le répértoire configuré
                $image->move($this->getParameter('image_directory'),$newImage);//Récupération du chemin du dossier d'images + le nouveau nom unique de l'image 
                

            } catch (FileException $th) {  //$th l'objet qui affiche l'erreur
                //Gestion des erreurs : on peut afficher un message d'erreur à l'utilisateur

                $this->addFlash('error', 'Une erreur est survenue lors du téléchargement de l\'image');
                //redirecttion vers la page du formulaire : la page actuelle
                return $this->redirectToRoute('app_article_crud_new');                               
            }

            // Mise à jour de la propriété 'image' de l'article avec le nouveau nom du fichier
            $article->setImage($newImage);

            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('app_article_crud_index', [], Response::HTTP_SEE_OTHER);
        }
        
        return $this->render('article_crud/new.html.twig', [
            'article' => $article,
            'form' => $form,
            'categoriesMenu'=> $categories,
        ]);
    }

    #[Route('/{id}', name: 'app_article_crud_show', methods: ['GET'])]
    public function show(Article $article): Response
    {
        return $this->render('article_crud/show.html.twig', [
            'article' => $article,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_article_crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Article $article, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser(); //Récupération de l'utilisateur connecté

            //On stock l'utilisateur connecté dans la propriété user de l'entité article
            $article->setUser($user);

            //Récupération de la catégorie séléctionnée dans le formulaire 

            $categories = $article->getCategorie()->getValues();

            foreach ($categories as $category) {
                //ajout de l'article à chaque catégorie
                $category->addArticle($article);
                $entityManager->persist($category);
            }

            // gestion de l'image uploadée

            $image =$form->get('image')->getData(); // le fichier image
            // le nom d'origine de l'mage
            $originalImage = pathinfo($image->getClientOriginalName(),PATHINFO_FILENAME);

            // Sécurisation du nom du fichier (slugification)
            $safeImage = $slugger->slug($originalImage);

            //Génération d'un nomunique pour l'image en ajoutant un identifiant unique
            $newImage = $safeImage. '-' .uniqid() .'-'.$image->guessExtension();

            try {
                // Déplacement de l'image vers le répértoire configuré
                $image->move($this->getParameter('image_directory'),$newImage);//Récupération du chemin du dossier d'images + le nouveau nom unique de l'image 
                

            } catch (FileException $th) {  //$th l'objet qui affiche l'erreur
                //Gestion des erreurs : on peut afficher un message d'erreur à l'utilisateur

                $this->addFlash('error', 'Une erreur est survenue lors du téléchargement de l\'image');
                //redirecttion vers la page du formulaire : la page actuelle
                return $this->redirectToRoute('app_article_crud_new');                               
            }

            // Mise à jour de la propriété 'image' de l'article avec le nouveau nom du fichier
            $article->setImage($newImage);

            $entityManager->flush();

            return $this->redirectToRoute('app_article_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('article_crud/edit.html.twig', [
            'article' => $article,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_article_crud_delete', methods: ['POST'])]
    public function delete(Request $request, Article $article, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($article);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_article_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
