<?php
require_once "inc/functions.inc.php";
require_once "inc/header.inc.php";

//// Une fonction qui Récupère tous les articles////////////////

$articles = allArticles();
?>

<main class="container" >
    <div class="row articles" >
        <h2 id="text3d" class=" mx-5 mb-3 text-center ">NOS ARTICLES</h2>
        <?php
        //// Une Boucle à travers les articles   ////////////////
    
        foreach ($articles as $article) {
        ?>
            <div class="col-sm-10 col-md-6 col-lg-4 mt-5">
                <div class="card">
                    <img src="<?= RACINE_SITE ?>assets/img/<?= $article['image'] ?>" alt="image de l' article" height="400"> <!-- Affiche l'image du article -->
                    <div class="card-body">
                        <h3><?= $article['title'] ?></h3> <!-- Affiche le titre du article -->
                        <p><span class="fw-bolder"> Résumé:</span><?= substr($article['description'], 0, 90) . '...' ?></p> <!-- Affiche une description du article -->
                        <!-- Lien pour voir plus de détails -->
                        <a href="<?= RACINE_SITE ?>show_article.php?id_article=<?= $article['id_article'] ?>" class="btn btn-warning">Voir plus de détails sur cet article</a>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</main>

<?php

// pour Inclure le fichier de pied de page
require_once "inc/footer.inc.php";
?>