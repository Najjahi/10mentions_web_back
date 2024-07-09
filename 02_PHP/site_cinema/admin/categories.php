<?php
require_once "../inc/functions.inc.php";
$info = "";

// gestion de l'accessibilité des pages admin 
if (empty($_SESSION['user'])) {

    header('location:' . RACINE_SITE . 'authentification.php');
} elseif ($_SESSION['user']['role'] == 'ROLE_USER') {

        header('location:' . RACINE_SITE . 'index.php');
    }

if (!empty($_POST)) { // si le formulaire est envoyé
    // On vérifie si un champ est vide

    $verif = true;
    foreach ($_POST as $key => $value) { // une boucle pour vrifier si un champs est vide

        if (empty(trim($value))) {

            $verif = false;
        }
    }
    if ($verif == false) { // si la variable $verif passe en false donc j'ai un champ vide

        $info = alert("Veuillez renseigner tous les champs", "danger"); // j'affiche un message d'erreur

    } else { // tous les champps sont remplis on passe à la validation des données

        $name = trim($_POST['name']);

        $description = trim($_POST['description']);

        // validation

        if (!isset($name) || strlen($name) < 3 || preg_match('/[0-9]/', $name)) {

            $info = alert("le champs nom de la catégorie n'est pas valide", "danger");
        }
        if (!isset($description) || strlen($description) < 20) {

            $info .= alert("le champs nom de la description n'est pas valide", "danger");
        } elseif (empty($info)) {

            // on verifie si la categorie existe de la bdd
            // $name = strtolower($name); // mais la chaine en miniscule
            $name = htmlentities($name);
            $categoryBdd = showCategory($name);
            if ($categoryBdd) {

                $info = alert("la categorie existe déjà", "danger");
            } else {  // si elle n'existe pas on va l'insérer

                $description = htmlentities($description);
                if (isset($_GET) && $_GET['action'] == 'update' && !empty($_GET['id_category'])) {


                    $id_category = htmlentities($_GET['id_category']);
                    updateCategory($id_category, $name, $description);
                    
                } else {

                    addCategory($name, $description);
                }

                // header('location: categories.php');
            }
        }
    }
}
// suppression et modification d'une categorie

if (isset($_GET) && isset($_GET['action']) && isset($_GET['id_category'])) {

    $idCategory = htmlentities($_GET['id_category']);

    if ($_GET['action'] == 'delete' && !empty($_GET['id_category'])) {

        deleteCategory($idCategory);
    }

    // suppression et modification d'une categorie

    if ($_GET['action'] == 'update' && !empty($_GET['id_category'])) {


        $category = showCategoryViaId($idCategory);

        debug($category);
        //die();

    }
    // header('location:categories.php');

}

require_once "../inc/header.inc.php";
?>

<div class="row mt-5" style="padding-top: 8rem;">
    <div class="col-sm-12 col-md-6 mt-5">
        <h2 class="text-center fw-bolder mb-5 text-danger">Gestion des catégories</h2>

        <?php $info; ?>

        <form action="" method="post" class="back">

            <div class="row">
                <div class="col-md-8 mb-5">
                    <label for="name">Nom de la catégorie</label>
                    <!-- <input type="text" id="name" name="name" class="form-control" value="<? //= isset($category)? $category['name'] : "" 
                                                                                                ?>"> -->
                    <input type="text" id="name" name="name" class="form-control" value="<?= $category['name'] ?? "" ?>">
                    <!-- est appelée l'opérateur de coalescence nulle en PHP. Cet opérateur permet de vérifier si une variable est définie et nulle, et de fournir une valeur par défaut si ce n'est pas le cas. -->
                </div>
                <div class="col-md-12 mb-5">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" class="form-control" rows="10"><?= isset($category) ? $category['description'] : '' ?></textarea>
                </div>

            </div>
            <div class="row justify-content-center">
                <button type="submit" class="btn btn-danger p-3"><?= isset($category) ? 'Modifier une catégorie' : 'Ajouter une catégorie' ?> </button>
            </div>
        </form>
    </div>

    <div class="col-sm-12 col-md-6 d-flex flex-column mt-5 pe-3">
        <!-- tableau pour afficher toute les catégories avec des boutons de suppression et de modification -->
        <h2 class="text-center fw-bolder mb-5 text-danger">Liste des catégories</h2>
        <?php
        $categories = allCategories();
        //debug($categories);

        ?>


        <table class="table table-dark table-bordered mt-5 ">
            <thead>
                <tr>
                    <!-- th*7 -->
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
                        <td><?= html_entity_decode(ucfirst($categorie['name'])) ?></td> <!-- une majuscule sur la première lettre avec ucfirst()-->
                        <td><?= substr(html_entity_decode($categorie['description']), 0, 100) . '...' ?></td> <!-- html_entity_decode convertit les netités HTML à leurs caractéres correspendants-->
                        <td class="text-center"><a href="?action=delete&id_category=<?= $categorie['id_category'] ?>"><i class="bi bi-trash3-fill"></i></a></td>
                        <td class="text-center"><a href="?action=update&id_category=<?= $categorie['id_category'] ?>"><i class="bi bi-pen-fill"></i></a></td>

                    </tr>

                <?php
                }
                ?>






        </table>







    </div>




    <?php

    require_once "../inc/footer.inc.php";

    ?>