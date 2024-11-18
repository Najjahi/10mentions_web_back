<?php

require_once "../inc/functions.inc.php";

$info = "";

// gestion de l'accessibilité des pages admin 
if (empty($_SESSION['user'])) { //On vérifie si l'utilisateur n'est pas connecté ou n'est pas authentifié.

    header('location:' . RACINE_SITE . 'authentification.php');

} else {
    if ($_SESSION['user']['role'] == 'ROLE_USER') {

    header('location:' . RACINE_SITE . 'index.php');
}
}
if (isset($_GET) && isset($_GET['action']) && isset($_GET['id_filiale']) && !empty($_GET['action']) && !empty($_GET['id_filiale'] )) {
        
                
    $idFiliale = htmlentities($_GET['id_filiale']);

    if(is_numeric($idFiliale)) { 

        $filiale  = showFilialeViaId($idFiliale);
        if($filiale) {

            if($_GET['action'] == 'delete') {

                deleteFiliale($idFiliale);

            }
            if ($_GET['action'] !== 'update') {
                
                header('location:filiales.php');
            }
         } 
         else{
            header('location:filiales.php');          
   }
}
else{
    header('location:filiales.php');
}
} 

// si le formulaire est envoyé On vérifie si un champ est vide
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

            // on verifie si la filiale existe de la bdd

            $name = htmlentities($name);

            $filialeBdd = showFiliale($name);

            if ($filialeBdd) {

                $info = alert("la filiale existe déjà", "danger");

            } else {

                // si elle n'existe pas on va l'insérer

                $description = htmlentities($description);

                if (isset($_GET) && $_GET['action'] == 'update' && !empty($_GET['id_filiale'])) {

                    $id_filiale = htmlentities($_GET['id_filiale']);

                    updateFiliale($id_filiale, $name, $description);
                    
                } else {

                    //J'appalle la fonction pour ajouter une catégorie 

                    addFiliale($name, $description);
               
                header('location: filiales.php');
            }
        }
    }
}
// Suppression d'une filiale

if (isset($_GET) && isset($_GET['action']) && isset($_GET['id_filiale'])) {

    $idFiliale = htmlentities($_GET['id_filiale']);

    if ($_GET['action'] == 'delete' && !empty($_GET['id_filiale'])) {

        deleteFiliale($idFiliale);
    }

    // Modification d'une filiale

    if ($_GET['action'] == 'update' && !empty($_GET['id_filiale'])) {

        $filiale = showFilialeViaId($idFiliale);

        //die();
    }
    // header('location:filiales.php');
}

require_once "../inc/header.inc.php";
?>
<main>

    <div class="container m-auto vh-100">
        <div class="row mt-5" style="padding-top: 8rem;">
        
            <!-- 1ere div pour ajouter une filiale dans la BDD   -->
        
            <div class="col-sm-12 col-md-6 mt-5">
                <h2 id="text3d" class="text-center fw-bolder mb-5 text-red">AJOUTER UNE FILIALE</h2>
        
                <?php $info; ?>
        
                <form action="" method="post" class="back">
        
                    <div class="row">
                        <div class="col-md-8 mb-5">
                            <label for="name">Nom de la filiale</label>
                            <input type="text" id="name" name="name" class="form-control" value="<?= $filiale['name'] ?? "" ?>">
                        </div>
                        <div class="col-md-12 mb-5">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" class="form-control" rows="10"><?= isset($filiale) ? $filiale['description'] : '' ?></textarea>
                        </div> 
        
                    </div>
                    <div class="row justify-content-center">
                        <!-- si la catégorie existe on la modifie sinon on l'insére -->
                        <button type="submit" class="btn btn-danger p-3"><?= isset($filiale) ? 'Modifier une filiale' : 'Ajouter une filiale' ?> </button>
                    </div>
                </form>
            </div>
        
            <div class="col-sm-12 col-md-6 d-flex flex-column mt-5 pe-3">
        
                <!-- 2eme div pour afficher toutes les catégories qui existent dans la BDD   -->
        
                <h2 id="text3d" class="text-center fw-bolder mb-5 text-red">LISTE DES FILIALES</h2>
                <?php
                $filiales = allFiliales();
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
                        foreach ($filiales as $key => $filiale) {
        
                        ?>
                            <tr>
                                <td><?= $filiale['id_filiale'] ?></td>
                                <td><?= html_entity_decode(ucfirst($filiale['name'])) ?></td>
                                <td><?= substr(html_entity_decode($filiale['description']), 0, 100) . '...' ?></td>
                                <td class="text-center"><a href="?action=delete&id_filiale=<?= $filiale['id_filiale'] ?>"><i class="bi bi-trash3-fill"></i></a></td>
                                <td class="text-center"><a href="?action=update&id_filiale=<?= $filiale['id_filiale'] ?>"><i class="bi bi-pen-fill"></i></a></td>
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