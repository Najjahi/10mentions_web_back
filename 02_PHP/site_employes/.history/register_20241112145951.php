<?php
require_once "inc/functions.inc.php";

if (
    !empty($_SESSION['user'])
) {

    header('location:profil.php');
}

$info = "";

if (!empty($_POST)) {

    $verif = true; // On vérifie si un champ est vide
    foreach ($_POST as $key => $value) {

        if (empty(trim($value))) {

            $verif = false;
        }
    }

    if ($verif == false) {

        $info = alert("Veuillez renseigner tout les champs", "danger");
        
    } else { 
         // on récupére les valeurs de nos champs et on les stocke dans des variables
        
        if ($_FILES['image']['error'] != 0 || $_FILES['image']['size'] == 0 || !isset($_FILES['image']['type'])) {

            $info .= alert("L'image n'est pas valide", "danger"); 
        }
        $nom = trim($_POST['nom']);
        $prenom = trim($_POST['prenom']);
        $matricule = trim($_POST['matricule']);
        //$dateNaissance = isset($_POST["dateNaissance"]) ? strtotime($_POST["dateNaissance"]) : 0;
        //$dateNaissance = strtotime($_POST['dateNaissance']);
        $dateNaissance = trim($_POST['dateNaissance']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);
        $situation = trim($_POST['situation']);
        //$nbreEnfants = trim($_POST["nbreEnfants"]);
        $nbreEnfants = isset($_POST["nbreEnfants"]) ? trim((string)$_POST["nbreEnfants"]) : '';
        $ville = trim($_POST['ville']);
        $dateEmbauche = trim($_POST['dateEmbauche']);
        $mdp = $_POST['mdp'];
        $confirmMdp = $_POST['confirmMdp'];

        $regex = '/[0-9]/'; // je stocks mon expression rationnelle dans une variable et je passe aux vérifications

        if (!isset($nom) || strlen($nom) < 2 || strlen($nom) > 15 || preg_match($regex, $nom)) { //preg_match — Effectue une recherche de correspondance avec une expression rationnelle standard

            $info = alert("Le champs nom n'est pas valide", "danger");
        }
        if (!isset($prenom) || strlen($prenom) < 2 || strlen($prenom) > 15 || preg_match($regex, $prenom)) {

            $info .= alert("Le champs prenom n'est pas valide", "danger");
        }
        if (!isset($matricule) || strlen($matricule) < 8 || strlen($matricule) > 8) {

            $info .= alert("Le champs matricule n'est pas valide", "danger");
        }

        $year1 = ((int) date('Y')) - 13; //2011
        $month = (date('m'));
        $date = (date('d'));
        // date limite supérieure
        $dateLimitSup = $year1 . "-" . $month . "-" . $date;

        //date limite inférieure

        $year2 = ((int) date('Y')) - 90;
        $dateLimitInf = $year2 . "-" . $month . "-" . $date;
        if (!isset($dateNaissance) || ($dateNaissance >  $dateLimitSup && $dateNaissance < $dateLimitInf)) {

            $info .= alert("La date de naissance n'est pas valide", "danger");
        }

        // on utilise la constante FILTER_VALIDATE_EMAIL dans la fonction filter_var() pour vérifier si l'adresse e-mail est valide selon le format standard des e-mails.
        if (!isset($email) || strlen($email) > 50 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $info .= alert("l'email n'est pas valide.", "danger");
        }

        if (!isset($phone) ||   !preg_match('/^[0-9]{10}$/', $phone)) { // Vérifie si le téléphone contient 10 chiffres


            $info .= alert("Le téléphne n'est pas valide.", "danger");
        }

        if (!isset($situation) || !in_array($situation, ['C', 'M', 'D', 'V', 'P'])) {


            $info .= alert("La civilité n'est pas valide.", "danger");
        }

        if (!isset($nbreEnfants) || strlen($nbreEnfants) < 0 || strlen($nbreEnfants) > 20) {

            $info .= alert("Le champs nbre d'Enfants n'est pas valide", "danger");
        }

        $regexMdp = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';

        if (!isset($mdp) || !preg_match($regexMdp, $mdp)) {

            $info .= alert("Le mot de passe n'est pas valide.", "danger");
        }
        if (!isset($confirmMdp) || $mdp !== $confirmMdp) {

            $info .= alert("Le mot de passe et la confirmation doivent être identiques.", "danger");
        }

        if (!isset($ville) || strlen($ville) > 50 || preg_match($regex, $ville)) {

            $info .= alert("Le champs ville n'est pas valide ", "danger");
        } 
        if (!isset($dateEmbauche) || ($dateEmbauche >  $dateLimitSup && $dateEmbauche < $dateLimitInf)) {

            $info .= alert("La date d'Embauche n'est pas valide", "danger");
        }
        
        else if (empty($info)) { // vérifier si l'adresse email existe dans la BDD    

            $emailExist = checkEmailUser($email); //on stocke la fonction 

            if ($emailExist) {
                $info = alert("ce mail n'est pas disponible ", "danger");
            }

            if ($emailExist && $matriculeExist) { // vérifier si le matricule existe dans la BDD
                $info = alert("Vous avez déjà un compte", "danger");
            } else if (empty($info)) {

                $mdpHash = password_hash($mdp, PASSWORD_DEFAULT);
                $nbreEnfants = isset($_POST["nbreEnfants"]) ? trim((string)$_POST["nbreEnfants"]) : '';
                $nbreEnfants = isset($_POST["nbreEnfants"]) ? (int)$_POST["nbreEnfants"] : 0;
                // $dateNaissance = isset($_POST["dateNaissance"]) ? strtotime($_POST["dateNaissance"]) : 0;
                $dateNaissance = isset($_POST["dateNaissance"]) ? date("Y-m-d", (int)$_POST["dateNaissance"]) : null;
                inscriptionUsers($nom, $prenom, $dateNaissance, $matricule, $email, $phone, $situation, $nbreEnfants, $ville, $dateEmbauche $mdpHash);

                $info = alert('vous êtes bien inscrit, vous pouvez <a href="authentification.php" class="text-danger fw-bold"> vous connecter </a>', 'success');
            }
        }
    }
}
require_once "inc/header.inc.php";
?>

<main style="background:url(assets/img/saramat2.png) no-repeat; background-size:50%; background-attachment: fixed; background-position: center">

    <div class="w-75 m-auto p-5">
        <h2 class="text-center mb-5 p-3" id="text3d">CREER UN COMPTE</h2>
        <?php

        echo $info;

        ?>

        <form action="" method="post" class="p-5">
            <div class="row mb-3">
                <div class="mb-5">
                    <label for="nom" class="form-label mb-3">Nom</label>
                    <input type="text" class="form-control fs-5" id="nom" name="nom">
                </div>
                <div class=" mb-5">
                    <label for="prenom" class="form-label mb-3">Prenom</label>
                    <input type="text" class="form-control fs-5" id="prenom" name="prenom">
                </div>
            </div>
            <div class="row mb-3">
                <div class=" mb-5">
                    <div class="col-md-6 mb-5">
                        <label for="dateNaissance" class="form-label mb-3">Date de naissance</label>
                        <input type="date" class="form-control fs-5" id="dateNaissance" name="dateNaissance">
                    </div>
                    <label for="matricule" class="form-label mb-3">Matricule</label>
                    <input type="text" class="form-control fs-5" id="matricule" name="matricule">
                </div>
                <div class=" mb-5">
                    <label for="email" class="form-label mb-3">Email</label>
                    <input type="text" class="form-control fs-5" id="email" name="email" placeholder="exemple.email@exemple.com">
                </div>
                <div class="col-md-4 mb-5">
                    <label for="phone" class="form-label mb-3">Téléphone</label>
                    <input type="text" class="form-control fs-5" id="phone" name="phone">
                </div>
            </div>
            <div class="col-md-6 mb-5">
                <label class="form-label mb-3">Situation</label>
                <select class="form-select fs-5" name="situation">
                    <option value="C"> Célibataire </option>
                    <option value="M"> Marié/Mariée </option>
                    <option value="D"> Divorcé/ Divorcée</option>
                    <option value="V"> Veuf/ Veuve</option>
                    <option value="P"> Paxé / Paxée </option>
                </select>
            </div>
            <div class="col-md-5">
                <label for="nbreEenfans" class="form-label mb-3">Nombre d'enfants</label>
                <input type="text" class="form-control fs-5" id="nbreEenfans" name="nbreEenfans">
            </div>
            <div class="col-md-5">
                <label for="ville" class="form-label mb-3">Ville</label>
                <input type="text" class="form-control fs-5" id="ville" name="ville">
            </div>
            <div class="col-md-6 mb-5">
                        <label for="dateEmbauche" class="form-label mb-3">Date d'Embauche</label>
                        <input type="date" class="form-control fs-5" id="dateEmbauche" name="dateEmbauche">
                    </div>
            <div class="row mb-3">
                <div class="col-md-6 mb-5">
                    <label for="mdp" class="form-label mb-3">Mot de passe</label>
                    <input type="password" class="form-control fs-5" id="mdp" name="mdp" placeholder="Entrer votre mot de passe">
                </div>
                <div class="col-md-6 mb-5">
                    <label for="confirmMdp" class="form-label mb-3">Confirmation mot de passe</label>
                    <input type="password" class="form-control fs-5 mb-3" id="confirmMdp" name="confirmMdp" placeholder="Confirmer votre mot de passe ">
                    <input type="checkbox" id="checkbox" onclick="myFunction()"> <span class="text-danger">Afficher/masquer le mot de passe</span>
                </div>
            </div>


    </div>
    <div class="row mt-5">
        <button class="w-25 m-auto btn btn-success btn-lg fs-5" type="submit">S'inscrire</button>
        <p class="mt-5 text-center">Vous avez dèjà un compte ! <a href="authentification.php" class=" text-danger">connectez-vous ici</a></p> <!-- lien qui nous raméne vers la page authentification-->
    </div>
    </form>
    </div>



</main>



<?php


require_once "inc/footer.inc.php"

?>