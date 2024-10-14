<?php

require_once "inc/functions.inc.php";
require_once "inc/header.inc.php";

if (empty($_SESSION['user'])) {

    header("location:" . RACINE_SITE . ":authetification.php");
}
?>
<main class="profil">
    <div class="mx-auto p-2 row flex-column align-items-center">
        <h2 class="text-center mb-5" id="text3d">Bonjour <?= $_SESSION['user']['firstName'] ?></h2>
        <div class="cardarticle">
            <div class="image w-25 d-flex ">
                <img src="assets/img/<?= $_SESSION['user']['civility'] == 'h' ? 'avatar_h.png' : 'avatar_f.png' ?>" alt="Image avatar de l'utilisateur">

                <div class="details">
                    <div class="center ">

                        <table class="table">
                            <tr>
                                <th scope="row" class="fw-bold">Nom</th>
                                <td><?= $_SESSION['user']['lastName'] ?></td>

                            </tr>
                            <tr>
                                <th scope="row" class="fw-bold">Prenom</th>
                                <td><?= $_SESSION['user']['firstName'] ?></td>

                            </tr>
                            <tr>
                                <th scope="row" class="fw-bold">Pseudo</th>
                                <td colspan="2"><?= $_SESSION['user']['pseudo'] ?></td>

                            </tr>
                            <tr>
                                <th scope="row" class="fw-bold">email</th>
                                <td colspan="2"><?= $_SESSION['user']['email'] ?></td>

                            </tr>
                            <tr>
                                <th scope="row" class="fw-bold">Tel</th>
                                <td colspan="2"><?= $_SESSION['user']['phone'] ?></td>

                            </tr>
                            <tr>
                                <th scope="row" class="fw-bold">Ville</th>
                                <td colspan="2"><?= $_SESSION['user']['city'] ?></td>
                            </tr>
                        </table>

                        <!-- <h2 class="text-center fw-bolder mb-5 text-danger"><? //= isset($user['id_user']) ? 'MODIFIER UN UTILISATEUR' : 'AJOUTER UN UTILISATEUR' 
                                                                                ?> </h2>  -->
                        <a href="register.php" class="btn btn-danger mt-5">MODIFIER LES INFORMATIONS</a>

                    </div>
                </div>
            </div>
</main>
<?php

require_once "inc/footer.inc.php";
?>