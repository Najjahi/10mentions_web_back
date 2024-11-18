<?php

require_once "inc/functions.inc.php";

if(!empty($_SESSION['user'])) {

    header('location:profil.php');
}
if (!empty($_POST)) {

    $verif = true; // On vérifie si un champ est vide
    foreach ($_POST as $key => $value) {

        if (empty(trim($value))) {

            $verif = false;
        }
    }

    if ($verif == false) {
        $info=
        $info = alert("Veuillez renseigner tous les champs", "danger");
    } else {
        $matricule = trim($_POST['matricule']);
        $email = trim($_POST['email']);
        $mdp = $_POST['mdp'];

        // Je vérifie si les données passés dans le formulaire existe dans la BDD , il faut récuperer l'utilisateur de la BDD s'il existe

        $employe = checkUser($matricule, $email); // un tableau avec les données de l'utilisateur inscrit dans la BDD 

        if ($employe) {

            if (password_verify($mdp, $employe['mdp'])) {  //Je vérifie si le mot de passe est bon    

                session_start(); // Création ou ouverture d'une session Ensuite on y stock les données 
                $_SESSION['user'] = $employe;

                header('location:employes.php');
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
<main style=" background:url(assets/img/sara2.png) no-repeat; background-size: 50%; background-attachment: fixed; background-position: center;">

    <div class="w-75 m-auto p-5" >
        <h2 id="text3d" class="text-center mb-5 p-3 ">Connectez-vous</h2>
        <?php echo $info;
        ?>
        <form action="" method="post" class="p-5">
            <div class="row mb-3">
                <div class="col-12 mb-5">
                    <label for="matricule" class="form-label mb-3">matricule</label>
                    <input type="text" class="form-control fs-5" id="matricule" name="matricule">
                </div>
                <div class="col-12 mb-5">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control fs-5" id="email" name="email" placeholder="exemple.email@exemple.com">
                </div>
                    <label for="mdp" class="form-label mb-3">Mot de passe</label>
                    <input type="password" class="form-control fs-5 mb-3" id="mdp" name="mdp">
                <div class="col-12 mb-5">  
                    <input type="checkbox" id="checkbox"  onclick="myFunction()"> <span class="text-primary">Afficher/masquer le mot de passe</span>
                </div>

                <button class="w-25 m-auto btn btn-primary btn-lg fs-5" type="submit">Se connecter</button>
                <p class="mt-5 text-center">Vous n'avez pas encore de compte ! <a href="register.php" class=" text-primary">créer un compte ici</a></p>
            </div>
        </form>
    </div>
</main>

<?php


require_once "inc/footer.inc.php"

?>