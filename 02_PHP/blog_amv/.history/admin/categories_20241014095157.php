<?php
require_once "../inc/functions.inc.php";
$info = "";

// gestion de l'accessibilité des pages admin 
if (empty($_SESSION['user'])) { //On vérifie si l'utilisateur n'est pas connecté ou n'est pas authentifié.

    header('location:' . RACINE_SITE . 'authentification.php');
} elseif ($_SESSION['user']['role'] == 'ROLE_USER') {

    header('location:' . RACINE_SITE . 'index.php');
}

// si le formulaire est envoyé  On vérifie si un champ est vide
// une boucle pour vérifier si un champs est vide

if (!empty($_POST)) {

    $verif = true;
    foreach ($_POST as $key => $value) {

        if (empty(trim($value))) {

            $verif = false;
        }
    }
    // si la variable $verif passe en false donc j'ai un champ vide j'affiche un message d'erreur
    if ($verif == false) {

        $info = alert("Veuillez renseigner tous les champs", "danger");

        // si tous les champps sont remplis on passe à la validation des données

    } else {

        $name = trim($_POST['name']);

        $description = trim($_POST['description']);

        // validation des données saisies

        if (!isset($name) || strlen($name) < 3 || preg_match('/[0-9]/', $name)) {

            $info = alert("le champs nom de la catégorie n'est pas valide", "danger");
        }
        if (!isset($description) || strlen($description) < 20) {

            $info .= alert("le champs nom de la description n'est pas valide", "danger");
        } elseif (empty($info)) {

            // on verifie si la categorie existe de la bdd

            $name = htmlentities($name);
            $categoryBdd = showCategory($name);
            if ($categoryBdd) {

                $info = alert("la categorie existe déjà", "danger");
            } else {

                // si elle n'existe pas on va l'insérer

                $description = htmlentities($description);
                if (isset($_GET) && $_GET['action'] == 'update' && !empty($_GET['id_category'])) {

                    $id_category = htmlentities($_GET['id_category']);
                    updateCategory($id_category, $name, $description);
                } else {
                    //J'appalle la fonction pour ajouter une catégorie 
                    addCategory($name, $description);
                }

                header('location: categories.php');
            }
        }
    }
}
// Suppression d'une categorie

if (isset($_GET) && isset($_GET['action']) && isset($_GET['id_category'])) {

    $idCategory = htmlentities($_GET['id_category']);

    if ($_GET['action'] == 'delete' && !empty($_GET['id_category'])) {

        deleteCategory($idCategory);
    }

    // Modification d'une categorie

    if ($_GET['action'] == 'update' && !empty($_GET['id_category'])) {


        $category = showCategoryViaId($idCategory);

        //die();
    }
    // header('location:categories.php');
}

require_once "../inc/header.inc.php";
?>
<main>
    
    <div class="container m-auto vh-100">
        <div class="row mt-5" style="padding-top: 8rem;">
        
            <!-- 1ere div pour ajouter une catégorie dans la BDD   -->
        
            <div class="col-sm-12 col-md-6 mt-5">
                <h3 class="text-center fw-bolder mb-5 text-red">AJOUTER UNE CATEGORIE</h3>
        
                <?php $info; ?>
        
                <form action="" method="post" class="back">
        
                    <div class="row">
                        <div class="col-md-8 mb-5">
                            <label for="name">Nom de la catégorie</label>
                            <input type="text" id="name" name="name" class="form-control" value="<?= $category['name'] ?? "" ?>">
                        </div>
                        <div class="col-md-12 mb-5">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" class="form-control" rows="10"><?= isset($category) ? $category['description'] : '' ?></textarea>
                        </div>
        
                    </div>
                    <div class="row justify-content-center">
                        <!-- si la catégorie existe on la modifie sinon on l'insére -->
                        <button type="submit" class="btn btn-danger p-3"><?= isset($category) ? 'MODIFIER UNE CATEGORIS' : 'Ajouter une catégorie' ?> </button>
                    </div>
                </form>
            </div>
        
            <div class="col-sm-12 col-md-6 d-flex flex-column mt-5 pe-3">
        
                <!-- 2eme div pour afficher toutes les catégories qui existent dans la BDD   -->
        
                <h3 class="text-center fw-bolder mb-5 text-red">LISTE DES CATEGORIES</h3>
                <?php
                $categories = allCategories();
                ?>
                <table class="table table-dark table-bordered mt-5 ">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Supprimer</th>
                            <th>Modifier</th>
                        </tr>
                    </thead>
                    <tbody>
        
                        <?php
                        foreach ($categories as $key => $categorie) {
        
                        ?>
                            <tr>
                                <td><?= $categorie['id_category'] ?></td>
                                <td><?= html_entity_decode(ucfirst($categorie['name'])) ?></td>
                                <td><?= substr(html_entity_decode($categorie['description']), 0, 100) . '...' ?></td>
                                <td class="text-center"><a href="?action=delete&id_category=<?= $categorie['id_category'] ?>"><i class="bi bi-trash3-fill"></i></a></td>
                                <td class="text-center"><a href="?action=update&id_category=<?= $categorie['id_category'] ?>"><i class="bi bi-pen-fill"></i></a></td>
                            </tr>
                        <?php
                        }
                        ?>
        
                    </tbody>
        
                </table>
            </div>
        </div>
    </div>
</main>

    <?php

    require_once "../inc/footer.inc.php";

    ?>