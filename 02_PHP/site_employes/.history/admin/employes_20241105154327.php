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

// On vérifie l'existence de la superglobale GET, du paramètre action et id_employe dans l'URL et pas vide.

if (isset($_GET) && isset($_GET['action']) && isset($_GET['id_employe']) && !empty($_GET['action']) && !empty($_GET['id_employe'])) {

    $idemploye = htmlentities($_GET['id_employe']);

    if (is_numeric($idemploye)) { //On vérifie si la valeur soumise pour le champ "id_employe" est bien un nombre.

        $employe  = showEmployeViaId($idemploye);

        if ($employe) {

            deleteEmploye($idemploye); //J'appalle la fonction pour supprimer un employe via son ID

            header('location:employes.php');
        } else {

            header('location:employes.php');
        }
    } else {

        header('location:employes.php');
    }
}
$employes = allEmployes();

require_once "../inc/header.inc.php";
?>

<main>
    <div class="container">

        <!-- Section pour afficher tous les employes qui existent dans la BDD  -->

        <div class="d-flex flex-column m-auto mt-5">

            <h2 id="text3d" class="text-center fw-bolder mb-5 text-danger"> LISTE DES EMPLOYES</h2>

            <!-- Lien qui nous raméne vers une autre page pour modifier un employe s'il existe sinon ou l'insérer -->

            <a href="gestion_employes.php" class="btn btn-danger align-self-end "> <?= isset($employe) ? 'Modifier un employe' : 'Ajouter un employe' ?></a>

            <table class="table table-dark table-bordered mt-5 ">

                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Photo de l'employe</th>
                        <th>Nom de l'employe</th>
                        <th>Prénom de l'employe</th>
                        <th>Matricule de l'employe</th>
                        <th>Date d'embauche</th>
                        <th>Email de l'employe</th>
                        <th>Téléphone de l'employe</th>
                        <th>Ville de l'employe</th>
                        <th>Supprimer</th>
                        <th>Modifier</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    // On parcouri le tableau employe par employe et À chaque boucle, la clé actuelle est stockée dans la variable $key, et l'élément lui-même est stocké dans la variable $employe. 
                    foreach ($employes as $key => $employe) {

                        $filiale = showFilialeViaId($employe['filiale_id']); // on appelle la fonction
                        $filialeName = $filiale['name']; // on stocke le nom de la catégorie dans $categoryName
                    ?>

                        <!-- Je récupére les valeus de mon tabelau $employe dans des td -->
                        <tr>
                            <td><?= $employe['id_employe'] ?></td>
                            <td> <img src="<?= RACINE_SITE . "assets/img/" . $employe['image'] ?>" alt="affiche de l' employe" class="img-fluid"></td> <!-- on Spécifie l'URL de l'image -->
                            <td> <?= $employe['nom'] ?></td>
                            <td> <?= $employe['prenom'] ?></td>
                            <td> <?= $employe['matricule'] ?></td>
                            <td> <?= $employe['email'] ?></td>
                            <td> <?= $employe['phone'] ?></td>
                            <td> <?= $employe['ville'] ?></td>
                            <td> <?= $employe['dateEmbauche'] ?></td>

                            <!--On crée un lien cliquable pour supprimer l'employe.-->
                            <td class="text-center"><a href="?action=delete&id_employe=<?= $employe['id_employe'] ?>"><i class="bi bi-trash3-fill"></i></a></td>

                            <!--On crée un lien cliquable pour modifier l'employe.-->
                            <td class="text-center"><a href="gestion_employe.php?action=update&id_employe=<?= $employe['id_employe'] ?>"><i class="bi bi-pen-fill"></i></a></td>
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