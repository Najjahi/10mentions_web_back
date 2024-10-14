<?php

require_once "inc/functions.inc.php";

$info = "";

if (!empty($_POST)) {

    $verif = true; // On vérifie si un champ est vide
    foreach ($_POST as $key => $value) {

        if (empty(trim($value))) {

            $verif = false;
        }
    }

    if ($verif == false) {

        $info = alert("Veuillez renseigner tous les champs", "danger");
    } else {
        $pseudo = trim($_POST['pseudo']);
        $email = trim($_POST['email']);
        $mdp = $_POST['mdp'];

        // Je vérifie si les données passés dans le formulaire existe dans la BDD , il faut récuperer l'utilisateur de la BDD s'il existe

        $user = checkUser($pseudo, $email); // un tableau avec les données de l'utilisateur inscrit dans la BDD 

        // pour récupérer le mdp => $user['mdp']
        // pour récupérer le email => $user['email']

        if ($user) {

            if (password_verify($mdp, $user['mdp'])) {  //Je vérifie si le mot de passe est bon    

                session_start(); // Création ou ouverture d'une session Ensuite on y stock les données 
                $_SESSION['user'] = $user;

                header('location:profil.php');
            } else {
                $info = alert('les identifiants sont incorrectes1', 'danger');
            }
        } else {
            $info = alert('les identifiants sont incorrectes2', 'danger');
        }
    }
}
require_once "inc/header.inc.php";
?>
<main style=" background:url(assets/img/logoviet3.jpg) no-repeat; background-size: 30%; background-attachment: fixed; background-position: center;">

    <div class="w-75 m-auto p-5" style="background: rgba(20, 20, 20,0.5); ">
        <h2 id="text3d" class="text-center mb-5 p-3 ">Connectez-vous</h2>
        <?php
        echo $info;
        ?>
        <form action="" method="post" class="p-5">
            <div class="row mb-3">
                <div class="col-12 mb-5">
                    <label for="pseudo" class="form-label mb-3">Pseudo</label>
                    <input type="text" class="form-control fs-5" id="pseudo" name="pseudo">
                </div>
                <div class="col-12 mb-5">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control fs-5" id="email" name="email" placeholder="exemple.email@exemple.com">
                </div>
                    <label for="mdp" class="form-label mb-3">Mot de passe</label>
                    <input type="password" class="form-control fs-5 mb-3" id="mdp" name="mdp">
                <div class="col-12 mb-5">  
                    <input type="checkbox" id="checkbox"  onclick="myFunction()"> <span class="text-danger">Afficher/masquer le mot de passe</span>
                </div>

                <button class="w-25 m-auto btn btn-danger btn-lg fs-5" type="submit">Se connecter</button>
                <p class="mt-5 text-center">Vous n'avez pas encore de compte ! <a href="register.php" class=" text-danger">créer un compte ici</a></p>
            </div>
        </form>
    </div>
</main>

<?php


require_once "inc/footer.inc.php"

?>