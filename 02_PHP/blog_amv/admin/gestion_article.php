<?php
require_once "../inc/functions.inc.php";

// gestion de l'accessibilité des pages admin 
if (empty($_SESSION['user'])) { //On vérifie si l'utilisateur n'est pas connecté ou n'est pas authentifié.

    header('location:' . RACINE_SITE . 'authentification.php');
} else {

    if ($_SESSION['user']['role'] == 'ROLE_USER') {

        header('location:' . RACINE_SITE . 'index.php');
    }
}

// Suppression d'un article

if (isset($_GET) && isset($_GET['action']) && isset($_GET['id_article']) && !empty($_GET['action']) && !empty($_GET['id_article'])) {


    $idarticle = htmlentities($_GET['id_article']);

    if (is_numeric($idarticle)) {

        $article  = showArticleViaId($idarticle);

        if ($article) {

            if ($_GET['action'] !== 'update') {

                //deleteCategory($idarticle);
                header('location:articles.php');
            }
        } else {
            header('location:articles.php');
        }
    } else {
        header('location:articles.php');
    }
    // Modification d'un article

    if ($_GET['action'] == 'update' && !empty($_GET['id_article'])) {

        $article = showArticleViaId($idarticle);
    }
}

$info = ""; //j'initialise la variable $info que j'utilise pour stocker des messages d'alerte 
    
if (!empty($_POST)) { //je vérifie si le tableau n'est pas vide, cela veut dire que le formulaire a été envoyé.

    $verif = true;// vérifier si tout est valide (true) sinon la valeur passe à false si des erreurs sont trouvées.
    
    foreach ($_POST as $key => $value) { //Boucle foreach pour vérifier les valeurs envoyées dans $_POST. 
        
        if (empty(trim($value))) { //Vérification de champs vides

            $verif = false;
        }
    }
    if (!empty($_FILES['image']['name'])) { //Vérifier si un fichier image a été téléchargé

        $image =  $_FILES['image']['name']; //On stocke le nom du fichier téléchargé dans la variable $image 

        //On Copie le fichier temporaire: $_FILES['image']['tmp_name'] vers son emplacement../assets/img/).

        copy($_FILES['image']['tmp_name'], '../assets/img/' . $image);
    }

    if ($verif == false || empty($image)) {  // Vérifie s'il y a des champs vides et si l'image n'est téléchargée.
        
        
        $info = alert("Veuillez renseigner tous les champs", "danger"); // on stocke dans $info un message d'alerte.
    } else { 

        // On Vérifie s'il a eu un probléme lors du téléchargement de l'image.
        if ($_FILES['image']['error'] != 0 || $_FILES['image']['size'] == 0 || !isset($_FILES['image']['type'])) {

            $info .= alert("L'image n'est pas valide", "danger"); 
        }

        // On récupére tous les champs de la table articles en supprimant les espaces

        $titleArticle = trim($_POST['title']);
        $description = trim($_POST['description']);
        $dateCreation = date('y-m-d');
        $dateModification = date('y-m-d');
        $id_category = ($_POST['categories']);


        if (!isset($titleArticle) || strlen($titleArticle) < 2) {
            $info .= alert("le champ titre n'est pas valide ", "danger");
        }

        if (!isset($description) ||  strlen($description) < 50) {

            $info .= alert("Il faut que la description dépasse 50 caractéres", "danger");
        } else if (empty($info)) { //Si aucune erreur n'a été détéctée 

        //on vérifie si l'action dans l'URL est définie, s'il s'agit d'un update, et si l' id_article existe. 
            if (isset($_GET) && isset($_GET['action']) && isset($_GET['id_article']) && !empty($_GET['action']) && !empty($_GET['id_article']) && $_GET['action'] == 'update') {

                $idarticle = htmlentities($_GET['id_article']); // On évite les injections malveillantes .
                //On appelle la fonction updateArticles() pour modifier l'article.
               
                updateArticles($image, $titleArticle, $description, $dateCreation, $dateModification, $id_category, $idarticle);
                header('location:articles.php');
            } else { //Si l'article n'existe pas, on passe à la création d'un nouvel article.
                //on vérifie si l'article existe déjà avec le même titre et la même date de création .
                if (verifArticle($titleArticle, $dateCreation)) {

                    $info = alert("L'article' existe déjà", "danger");
                } else {

                    //On insére le nouvel article dans la BDD (titre, description, date, image et catégorie).
                    
                    addArticles($titleArticle, $description, $dateCreation, $image, $id_category);
                   
                    header('location:articles.php');
                }
            }
        }
    }
}

require_once "../inc/header.inc.php";
?>

<main>
    <!-- si l'article existe on le modifie sinon on l'insére -->
    <h2 id="text3d" class="text-center fw-bolder mb-5 text-danger"><?= isset($article) ? 'MODIFIER UN ARTICLE' : 'AJOUTER UN ARTICLE' ?> </h2> 

    <?php echo $info;  ?>
    <form action="" method="post" class="back" enctype="multipart/form-data">
        <div class="row bg-dark.bg-gradient">
            <div class="col-md-6 mb-5">
                <label for="title">Titre de article</label>
                <!-- Si la clé 'title' dans $article n'existe pas ou est null,on affiche une chaîne vide (''). -->
                
                <input type="text" name="title" id="title" class="form-control" value="<?= $article['title'] ?? '' ?>">
            </div>
            <div class="col-md-6 mb-5">
                <label for="image">Photo de l'article</label>
                <br>
                <input type="file" name="image" id="image">
            </div>
        </div>


        <div class="row">
            <label for="categories">Description de l'article</label>
            <!-- On vérifie si la variable $article existe, on affiche sa description. sinon, on retourne une chaîne vide. -->
            <textarea type="text" class="form-control " id="description" name="description" rows="20"><?= isset($article) ? $article['description'] : '' ?></textarea>

            <?php
            $categories = allCategories();

            foreach ($categories as $key => $categorie) {
            ?>
                <div class="form-check col-sm-12 col-md-3">

                <!-- si l'article a déjà une catégorie, le bouton est pré-coché, Sinon le bouton reste décoché. -->
                    <input class="form-check-input" type="radio" name="categories" id="<?= html_entity_decode($categorie["name"]) ?>" value="<?= $categorie["id_category"] ?>" <?= isset($article['category_id']) && $article['category_id'] == $categorie['id_category'] ? 'checked' : '' ?>>

                    <!-- l'ID est décodé pour gérer les caractères spéciaux, le contenu du label est généré avec le nom de la catégorie, la 1ére lettre du nom de la catégorie est en majuscule. -->
                    <label class="form-check-label" for="<?= html_entity_decode($categorie["name"]) ?>"><?= ucfirst(html_entity_decode($categorie["name"])) ?></label>
                </div>
            <?php
            }
            ?>
        </div>

        <div class="row justify-content-center">
            <button type="submit" class="btn btn-danger p-3 w-25"> <?= isset($article) ? 'MODIFIER UN ARTICLE' : 'AJOUTER UN ARTICLE' ?></button>
        </div>
    </form>
</main>
<?php

require_once "../inc/footer.inc.php";
?>