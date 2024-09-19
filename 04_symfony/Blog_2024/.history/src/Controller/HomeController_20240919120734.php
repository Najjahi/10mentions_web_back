<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

//c'est une classe abstarite avec plusieur méthode que nous pourrons après les utiliser dans  les classes filles, il faut indiquer  la provenance de cette classe  dans ce fichier en utilisant le use à la ligne 5
// dans un controller nous avons des actions : c'est les mèthodes qi'on trouve dans le controller

class HomeController extends AbstractController
{

    //"/" => le chemin de cette route
    // "app_home" => LE NOM de la route qui nous servira au moment de l'appel des routes dans twig
    #[Route('/', name: 'app_home')]// cette ligne représente les annotations: elle permet d'indiquer que la route test appelle l'action  index et on aura comme affichage le rendu du fichier index.html.twig qui se trouve dans le dossier test dans templates
    public function index(ArticleRepository $articleRepository, CategorieRepository $categoriesRepository): Response// chaque action repon avec une Reponcse
    {
        // au niveau de cette acction il faut recupere les articles et les stocker dans une variable
        // afin de recuperer les donnee des articles on va uttiliser le repository lié à l'entite en question on appelle cela le mecanisme d'injection de depeendance en symfony il s'ajit de dire en synfony que je veut que tu rentre dans cette action en embarquant avec toi l'object $articleRepository qui est une instance stockée dans une variable

        // je me sert de la variable $articleRepository pour iutiliser les methode et pour interroger la bdd
     /* The code snippet ` = ->findAll();// un tableau avec tout les
     articles
     dd();` is retrieving all articles from the database using the `findAll()` method
     provided by the ``. The `findAll()` method typically fetches all
     records/entities from the database table associated with the `Article` entity. */
        $articles = $articleRepository->findAll();// un tableau avec tout les articles
        // dump($articles);

        $catergories = $categoriesRepository->findAll();// un tableau avec tout les articles
        // dd($catergories);       
    
        // l'action index() retourne la méthode render() qui provien de la classe abstractController
        return $this->render('home/accueil.html.twig', [// render prends 2 arguments : 
            // 1 -  le fichier que nous voulons rendre ( il seras géré par ce controller)
            // 2 - Les données que nous voulons fournir à cette page

            "articlesBlog" => $articles, // ici in linject une variable Qui s'appelle articlesBlog avec sa valeur : le chaine de canractére HomeControler
            "menuCatiegorie" => $catergories,
        ]);
    }
    #[Route('/category/{name}', name: 'app_article_category')]
    public function selectCategorie(ArticleRepository $articleRepository, CategorieRepository           $categorieRepository, sting $name) :Response{

       
        $catergorie = $categoriesRepository->findByName($name) ;       
      

        $articles = $articleRepository->findByCategorie($idCat);
        return $this->rebdor('home/accueil.html.twig',[

         //pour la barre de navigation
         $catergorie = $categoriesRepository->findAll();
       
        
        $articles = $articleRepository->findByCategorie($catergorie);
        return $this->rebdor('home/accueil.html.twig',[
                "articles" => $articles,
                
        ] )
        ]);

    }
    
}
