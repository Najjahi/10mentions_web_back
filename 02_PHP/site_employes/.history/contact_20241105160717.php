<?php

require_once "inc/functions.inc.php";

// vérifie si un utilisateur est connecté .

if (empty($_SESSION['user'])) {

    header("location:" . RACINE_SITE . "authentification.php");
}
//on vérifie si l'id article existe dans GET, alors il récupère l'article et le stocke dans la variable $idarticle
if (isset($_GET) && isset($_GET['id_article']) && !empty($_GET['id_article'])) {

    $idarticle = htmlentities($_GET['id_article']);

    if (is_numeric($idarticle)) {

        //On appelle la fonction pour récupérer les informations de l'article correspondant à cet id.
        $article  = showEmployeViaId($idarticle);

        if (!$article) {

            header('location:index.php');
        }
    } else {
        header('location:index.php');
    }
}
$info = "";
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

        // si tous les champs sont remplis on passe à la validation des données
    } else {

        $email = trim($_POST['email']);
        $sujet = trim($_POST['sujet']);
        $message = trim($_POST['message']);

        // on utilise la constante FILTER_VALIDATE_EMAIL dans la fonction filter_var() pour vérifier si l'adresse e-mail est valide selon le format standard des e-mails.
        if (!isset($email) || strlen($email) > 50 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $info .= alert("l'email n'est pas valide.", "danger");
        }
        if (!isset($sujet) || strlen($sujet) < 3 || preg_match('/[0-9]/', $sujet)) {

            $info .= alert("le champs sujet n'est pas valide", "danger");
        }
        if (!isset($message) || strlen($message) < 20) {

            $info .= alert("le champs message n'est pas valide", "danger");
        } elseif (empty($info)) {

            $info .= alert("Votre message a bien été envoyé", "success");

            //header('location: index.php');
        }
    }
}

require_once "inc/header.inc.php";
?>

<main style=" background:url(assets/img/sara4.png) no-repeat; background-size: 50%; background-attachment: fixed; background-position: center;">

    <!-- div pour le formulaire de contact -->

    <div class="d-flex flex-column m-auto ">
        <h2 id="text3d" class="text-center fw-bolder mb-5 text-red">LAISSEZ NOUS UN MESSAGE</h2>
        <h4 class="col-sm-12 col-lg-12 text-center ">Utiliser le formulaire de contact pour nous transmettre un message,</h4>
        <p class="col-sm-12 col-lg-12 text-center mb-5"> nous vous répondrons dans les plus brefs délais.</p>
        <?= $info; ?>

        <form action="" method="post" class="back">

            <div class="row">
                <div class="col-md-8 mb-5">
                    <label for="">id_employe</label>
                    <input type="text" id="id_employe" name="id_employe" class="form-control" value="">
                </div>
                <div class="col-md-8 mb-5">
                    <label for="name">Sujet</label>
                    <select class="form-select" aria-label="Default select example">
                        <option selected class=" fs-1 "> veillez selectionner votre demande</option>
                        <option value="1">Demande de congé</option>
                        <option value="2">Demande de buletin de paie</option>
                        <option value="3">Demande de formation</option>
                    </select>

                    <input type="text" id="sujet" name="sujet" class="form-control" value="">

                </div>
                <div class="col-md-12 my-3">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" class="form-control" rows="20"></textarea>
                </div>

            </div>

            <div class="row justify-content-center">
                <button type="submit" class="btn btn-info p-3 my-3 text-light fw-bolder">Envoyer</button>
                <button type="reset" class="btn btn-warning p-3 my-3 text-light fw-bolder">Effacer</button>
            </div>

        </form>
    </div>

</main>

<?php

require_once "inc/footer.inc.php";
?>