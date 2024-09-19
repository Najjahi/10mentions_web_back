<?php

namespace App\Controller;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ArticleController extends AbstractController
{
    // on a la posibilitée de crée des routes dynamique en passant des vaarriable dans le chemin de la route
    #[Route('/article/{id}', name: 'app_article',requirements:["id"=>"[0-9]+"])] // affin de presiser que dans ma route j'ai une variable et pour identifier il faut la mêtre dans les accolades
    public function index(ArticleRepository $articleRepository, int $id): Response
    {

        $article = $articleRepository->findOneById($id);

        $categories = $categorieRepository->findAll();
        return $this->render('article/index.html.twig', [
            "articleUnique" => $article,
            'categoriesMenu'=> $categories,
        ]);
    }
}


