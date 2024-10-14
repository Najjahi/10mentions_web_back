<?php

require_once "../inc/functions.inc.php";  

// gestion de l'accessibilité des pages admin 
 if (empty($_SESSION['user'])) { //On vérifie si l'utilisateur n'est pas connecté ou n'est pas authentifié.

    header("location:" . RACINE_SITE . "authentification.php");
} else {

    if ($_SESSION['user']['role'] == 'ROLE_USER') {

        header("location:" . RACINE_SITE . "index.php");
    }
}

// On vérifie l'existence de la superglobale GET, du paramètre action et id_article dans l'URL et pas vide.

if (isset($_GET) && isset($_GET['action']) && isset($_GET['id_article']) && !empty($_GET['action']) && !empty($_GET['id_article'])) {

    $idarticle = htmlentities($_GET['id_article']);

    if (is_numeric($idarticle)) { //On vérifie si la valeur soumise pour le champ "id_article" est bien un nombre.
        
        $article  = showarticleViaId($idarticle);

        if ($article) {
            
            deleteArticle($idarticle); //J'appalle la fonction pour supprimer un article via son ID

            header('location:articles.php');

        } else {

            header('location:articles.php');
        }
    } else {

        header('location:articles.php');
    }
}
$articles = allArticles();

require_once "../inc/header.inc.php";
?>

<main>
   <div class="container">
        <!-- Section pour afficher tous les articles qui existent dans la BDD   -->
        <div class="d-flex flex-column m-auto mt-5">
        
            <h2 id="text3d" class="text-center fw-bolder mb-5 text-danger"> LISTE DES ARTICLES</h2>
        
            <!-- Lien qui nous raméne vers une autre page pour modifier un article s'il existe sinon on l'insére -->
            
            <a href="gestion_article.php" class="btn btn-danger align-self-end "> <?= isset($article) ? 'Modifier un article' : 'Ajouter un article' ?></a>
           
        
            <table class="table table-dark table-bordered mt-5 ">
        
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Photo de l'article</th>
                        <th>Titre de l'article</th>
                        <th>description de l'article</th>
                        <th>Date de création</th>
                        <th>Date de modification</th>
                        <th>Supprimer</th>
                        <th>Modifier</th>
                    </tr>
                </thead>
                <tbody>
        
                    <?php
                    // On parcouri le tableau article par article et À chaque boucle, la clé actuelle est stockée dans la variable $key, et l'élément lui-même est stocké dans la variable $article. 
                    foreach ($articles as $key => $article) {
        
                        $category = showCategoryViaId($article['category_id']); // on appelle la fonction
                        $categoryName = $category['name']; // on stocke le nom de la catégorie dans $categoryName
                    ?>
        
                    <!-- Je récupére les valeus de mon tabelau $article dans des td -->
                        <tr> 
                            <td><?= $article['id_article'] ?></td>
                            <td> <?= $article['title'] ?></td>                    
                            <td> <img src="<?= RACINE_SITE . "assets/img/" . $article['image'] ?>" alt="affiche de l' article" class="img-fluid"></td> <!-- on Spécifie l'URL de l'image -->
                            <td> <?= $article['description'] ?></td>
                            <td> <?= $article['dateCreation'] ?></td>
                            <td> <?= $article['dateModification'] ?></td>
        
                            <!--On crée un lien cliquable pour supprimer l'article.-->
                            <td class="text-center"><a href="?action=delete&id_article=<?= $article['id_article'] ?>"><i class="bi bi-trash3-fill"></i></a></td>
                            <!--On crée un lien cliquable pour modifier l'article.-->
                            <td class="text-center"><a href="gestion_article.php?action=update&id_article=<?= $article['id_article'] ?>"><i class="bi bi-pen-fill"></i></a></td>
                        </tr>
                    <?php
                    }
        
                    ?>
                </tbody>
            </table>
        </div>
   </div>
</main>
<?php

require_once "../inc/footer.inc.php";
?>