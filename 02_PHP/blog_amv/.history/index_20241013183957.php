<?php
require_once "inc/functions.inc.php";
$info = '';

if (isset($_GET)  && !empty($_GET)) {

    if (isset($_GET['id_category'])) {

        $idCategory = htmlentities($_GET['id_category']); // Sécurise l'ID en échappant les caractères spéciaux
        if (is_numeric($idCategory)) {  // Vérifie si l'ID est numérique

            $cat = showCategoryViaId($idCategory); // Récupère les détails de la catégorie via son ID

            if (($cat['id_category'] != $idCategory)  || empty($idCategory)) {

                header('location:index.php');
            } else {

                $articles = articlesByCategory($idCategory); // Récupère les articles par catégorie

                $message = "Cette catégorie contient: ";

                if (!$articles) { //si lacatégorie n'existe pas

                    $info = alert("Désolé ! cette catégorie ne contient aucun article", "danger");
                }
            }
        } else {

            header('location:index.php'); // Redirige vers la page d'accueil si l'ID n'est pas numérique
        }
    } elseif (isset($_GET['action']) && $_GET['action'] == 'voirPlus') { // Vérifie si l'action est 'voirPlus'

        $articles = allArticles(); // Récupère tous les articles
        $message = "Le nombre total de articles : ";
    }
} else {

    $articles = articleByDate(); // Récupère les articles par date
    $message = "Le nombre de articles sortie en dernier : ";
}

require_once "inc/header.inc.php"; // Inclut le fichier d'en-tête
?>
<main class="accueil">
    <div class="container-fluid d-flex flex-column align-items-center ">
        <!-- Section 1  pour afficher une video de démonstration du viet vo dao   -->
        <h2  id="text3d" class=" mx-5 text-center p-4"> VIDEO DE DEMONSTRATION AMV </h2>
        <div class="row mb-1 justify-content-center">
            <div col-sm-12 col-md-6>
                <iframe width="560" height="315" src="https://www.youtube.com/embed/ohFhYT-Nv1c?si=XSA84O2xLx2pAlcq" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

                <div class="bloc-btn d-flex justify-content-between align-items-center ">
                    <i class="bi bi-emoji-neutral"></i>
                    <button class="btn-abonner">Abonnez-vous</button>
                </div>
            </div>
        </div>

        <div class="slider d-flex flex-column align-items-center ">

            <!-- Section 2 pour afficher un carousel avec des images du viet vo dao   -->

            <h2 id="text3d" class=" mx-5 text-center p-4"> IMAGES ET ILLUSTRATIONS AMV </h2>
            <div class="outils d-flex  ">
                <div class="left p-3" title="Image précédente">
                    <i class="bi bi-skip-backward-fill"></i>
                </div>
                <div class="automatic p-3" title="Démarrer le carrousel">
                    <i class="bi bi-caret-right-fill"></i>
                </div>
                <div class="right p-3" title="Image suivante">
                    <i class="bi bi-skip-forward-fill"></i>
                </div>
            </div>
            <div>
                <img src="assets/img/1.jpg" alt="Image 1">
            </div>
        </div>
    </div>
    <div class="articlesAccueil ">

        <!-- Section 3 pour afficher les valeurs du viet vo dao   -->

        <h2 id="text3d" class=" mx-5 text-center p-4">VALEURS DES AMV</h2> <!-- Affiche le message et le nombre de articles -->
        <div class="row mb-1 justify-content-center">
            <div class="card col-lg-3 col-6 border border-warning text-center ">
                <i class="fa-solid fa-brain "></i>
                <h3  class=" text-gold my-4 fw-bold  ">PREPARATION MENTALE</h3>
                <p>Un travail de fond pour que l'esprit soit au rgFendez-vous. L'expertise des professeurs permet de proposer un suivi adapté à l'élève .</p>
            </div>
            <div class="card col-lg-3 col-6 border border-warning text-center">
                <i class="fa-solid fa-dumbbell "></i>
                <h3 class="text-gold my-4 fw-bold ">PREPARATION PHYSIQUE</h3>
                <p>Nos maîtres sont à la disposition des élèves souhaitant se surpasser et marquer les esprits lors des compétitions régionales et nationales.
                </p>
            </div>
            <div class=" card col-lg-3 col-6 border border-warning text-center">
                <i class="fa-solid fa-child-combatant"></i>
                <h3 class=" my-4 fw-bold  ">MAITRISE TECHNIQUE</h3>
                <p c>Un art martial possède une infinité de codes et de tableaux précis et détaillés au niveau des quyens et des combats et la self défense.
                </p>
            </div>
            <div class="card col-lg-3 col-6 border border-warning text-center">
                <i class="fa-solid fa-people-group"></i>
                <h3  class=" my-4 fw-bold  ">TRAVAIL D'ÉQUIPE</h3>
                <p>L’esprit d'équipe et l'entraide sont notre devise de notre club, pour une progression permanente et rapide, pour un maximum de savoir faire.
                </p>
            </div>
            <div class="card col-lg-3 col-6 border border-warning text-center">
                <i class="fa-solid fa-face-grin-squint"></i>
                <h3  class=" my-4 fw-bold  ">BIEN ÊTRE </h3>
                <p>Une alimentation équilibrée, beaucoup de repos et une hygiène de vie sont des ingrédients indispensables pour notre recette magique; La Réussite .
                </p>
            </div>
            <div class="card col-lg-3 col-6 border border-warning text-center">
                <i class="fa-solid fa-calendar-days"></i>
                <h3 class="  fw-bold  ">ÉVÉNEMENTS</h3>
                <p>Fêtes du sport, fêtes de fin d'année, Stages et Compétitions font partie de nos actions afin de pouvoir s'exprimer avec détermination sur le tatami.
                </p>
            </div>
        </div>
        <div class="row mb-1 justify-content-center">

            <!-- Section 4 pour afficher une video de démonstration du viet vo dao   -->

        <h2 id="text3d" class=" mx-5 text-center ">NOS ARTICLES</h2>
            <?php echo $info; // Affiche les informations (alertes)
            foreach ($articles as $article) { // Boucle à travers les articles
            ?>
                <div class="col-sm-12 col-md-6 col-lg-4 col-xxl-3">

                    <div class="card"> <!-- Affiche l'image du article -->
                        <img src="<?= RACINE_SITE ?>assets/img/<?= $article['image'] ?>" alt="image du article">
                        <div class="card-body">
                            <h3><?= $article['title'] ?></h3>
                            <p><span class="fw-bolder"> Résumé:</span> <?= substr($article['description'], 0, 90) . '...' ?></p> <!-- Affiche un résumé du article -->
                            <a href="<?= RACINE_SITE ?>articles.php?id_article=<?= $article['id_article'] ?>" class="btn btn-warning">Voir plus de articles</a> <!-- Lien pour voir plus de détails -->
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
        <?php
        if (empty($_GET)) { // Si aucun paramètre n'est passé dans l'URL  : on affiche le bouton que sur le rendu avec les 6 articles     
        ?>
            <div class="col-12 text-center mb-5 ">
                <a href="<?= RACINE_SITE ?>?action=voirPlus" class="btn btn-abonner fs-3">Voir plus d'articles</a>
            </div>

            <div class="row d-flex justify-content-evenly flex-wrap ">

                <!-- Section pour afficher les images qui illustrent le viet vo dao   -->

        <h2 id="text3d" class=" mx-5 text-center"> IMAGES DIVERSES AMV </h2>
                <div class="col-lg-3 col-6">
                    <a href="">
                        <img src="assets/img/souplesse.jpg" alt="image qui represente la souplesse" class="img-fluid imgb" />
                    </a>
                </div>
                <div class="col-lg-3 col-6">
                    <a href=""> <img src="assets/img/viet23.jpg" alt="image qui represente l'eventail'" lass="img-fluid imgb" />
                    </a>
                </div>
                <div class="col-lg-3 c2ol-6">
                    <a href="">
                        <img src="assets/img/tai.jpg" alt="image qui represente la Tai Chi" class="img-fluid imgb" />
                    </a>
                </div>
                <div class="col-lg-3 col-6">
                    <a href="">
                        <img src="assets/img/photobaton.jpg" alt="image qui represente le baton" class="img-fluid imgb" />
                    </a>
                </div>
                <div class="col-lg-3 col-6">
                    <a href="">
                        <img src="assets/img/viet26.jpg" alt="image qui represente les batons" class="img-fluid imgb" />
                    </a>
                </div>
                <div class="col-lg-3 col-6">
                    <a href="">
                        <img src="assets/img/viet3.jpg" alt="image qui represente le sabre" class="img-fluid imgb" />
                    </a>
                </div>
                <div class="col-lg-3 col-6">
                    <a href="">
                        <img src="assets/img/arm.jpg" alt="image qui represente les arms" class="img-fluid imgb" />
                    </a>
                </div>
                <div class="col-lg-3 col-6">
                    <a href="">
                        <img src="assets/img/photobois.jpg" alt="image qui represente la souplesse dans le bois" class="img-fluid imgb" />
                    </a>
                </div>
                <div class="col-lg-3 col-6">
                    <a href="">
                        <img src="assets/img/viet66.jpg" alt="image qui represente le combat" class="img-fluid imgb" />
                    </a>
                </div>
                <div class="col-lg-3 col-6">
                    <a href="">
                        <img src="assets/img/viet90.jpg" alt="image qui represente l'eventail et le tai chi'" class="img-fluid imgb" />
                    </a>
                </div>
                <div class="col-lg-3 col-6">
                    <a href="">
                        <img src="assets/img/viet99.jpg" alt="image qui represente les coups de pied" class="img-fluid imgb" />
                    </a>
                </div>
                <div class="col-lg-3 col-6">
                    <a href="">
                        <img src="assets/img/photologo.jpg" alt="image qui represente le logo" class="img-fluid imgb" />
                    </a>
                </div>
            </div>
        <?php
        }

        ?>
</main>
<?php

require_once "inc/footer.inc.php";
?>