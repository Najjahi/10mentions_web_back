<?php

require_once "inc/functions.inc.php";
require_once "inc/header.inc.php";
if (empty($_SESSION['user'])) {

    header("location:" . RACINE_SITE . ":authetification.php");
}

?>
<main class="profil">
    <div class="mx-auto p-2 row flex-column align-items-center">
        <h2 class="text-center mb-5" id="text3d">Bonjour <?= $_SESSION['user']['prenom'] ?></h2>
        <div class="cardarticle">
            <div class="image w-25 d-flex ">
                 <div class="details">
                    <div class="center ">

                        <table class="table pe-5">
                            <tr>
                                <th scope="row" class="fw-bold">Nom</th>
                                <td><?= $_SESSION['user']['nom'] ?></td>

                            </tr>
                            <tr>
                                <th scope="row" class="fw-bold">Prenom</th>
                                <td><?= $_SESSION['user']['prenom'] ?></td>

                            </tr>
                            <tr>
                                <th scope="row" class="fw-bold">Matricule</th>
                                <td colspan="2"><?= $_SESSION['user']['matricule'] ?></td>

                            </tr>
                            <tr>
                                <th scope="row" class="fw-bold">Date de Naissance</th>
                                <td colspan="2"><?= $_SESSION['user']['dateNaissance'] ?></td>

                            </tr>
                            <tr>
                                <th scope="row" class="fw-bold">email</th>
                                <td colspan="2"><?= $_SESSION['user']['email'] ?></td>

                            </tr>
                            <tr>
                                <th scope="row" class="fw-bold">Telephone</th>
                                <td colspan="2"><?= $_SESSION['user']['phone'] ?></td>

                            </tr>
                            <tr>
                                <th scope="row" class="fw-bold">situation</th>
                                <td colspan="2"><?= $_SESSION['user']['situation'] ?></td>

                            </tr>
                            <tr>
                                <th scope="row" class="fw-bold">Nombre d'Enfants</th>
                                <td colspan="2"><?= $_SESSION['user']['nbreEnfants'] ?></td>

                            </tr>
                            <tr>
                                <th scope="row" class="fw-bold">Ville</th>
                                <td colspan="2"><?= $_SESSION['user']['ville'] ?></td>
                            </tr>
                            <tr>
                                <th scope="row" class="fw-bold">Ville</th>
                                <td colspan="2"><?= $_SESSION['user']['dateEmbauche'] ?></td>
                            </tr>
                        </table>

                        <!-- <h2 class="text-center fw-bolder mb-5 text-danger"><? //= isset($user['id_user']) ? 'MODIFIER UN UTILISATEUR' : 'AJOUTER UN UTILISATEUR' 
                                                                                ?> </h2>  -->
                        <a href="register.php" class="btn btn-success mt-5">MODIFIER LES INFORMATIONS</a>

                    </div>
                </div>
            </div>
</main>
<?php

require_once "inc/footer.inc.php";
?>