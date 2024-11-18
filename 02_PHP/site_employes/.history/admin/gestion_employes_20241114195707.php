<?php
require_once "../inc/functions.inc.php";

// gestion de l'accessibilité des pages admin 
if (empty($_SESSION['user'])) { //On vérifie si l'utilisateur n'est pas connecté ou n'est pas authentifié.

    header('location:' . RACINE_SITE . 'authentification.php');
} else {

    if ($_SESSION['user']['role'] == 'ROLE_USER') {

        header('location:' . RACINE_SITE . 'index.php');
    }
}

// Suppression d'un employe

if (isset($_GET) && isset($_GET['action']) && isset($_GET['id_employe']) && !empty($_GET['action']) && !empty($_GET['id_employe'])) {

    $idemploye = htmlentities($_GET['id_employe']);

    if (is_numeric($idemploye)) {

        $employe  = showUserViaId($idemploye);

        if ($employe) {

            if ($_GET['action'] !== 'update') {

                //deleteFiliale($idemploye);
                header('location:employes.php');
            }
        } else {
            header('location:employes.php');
        }
    } else {
        header('location:employes.php');
    }
    // Modification d'un employe

    if ($_GET['action'] == 'update' && !empty($_GET['id_employe'])) {

        $employe = showUserViaId($idemploye);
    }
}

$info = ""; //j'initialise la variable $info que j'utilise pour stocker des messages d'alerte 
    
if (!empty($_POST)) { //je vérifie si le tableau n'est pas vide, cela veut dire que le formulaire a été envoyé.

    $verif = true;// vérifier si tout est valide (true) sinon la valeur passe à false si des erreurs sont trouvées.
    
    foreach ($_POST as $key => $value) { //Boucle foreach pour vérifier les valeurs envoyées dans $_POST. 
        
        if (empty(trim($value))) { //Vérification de champs vides

            $verif = false;
        }
    }
    if (!empty($_FILES['image']['name'])) { //Vérifier si un fichier image a été téléchargé

        $image =  $_FILES['image']['name']; //On stocke le nom du fichier téléchargé dans la variable $image 

        //On Copie le fichier temporaire: $_FILES['image']['tmp_name'] vers son emplacement../assets/img/).

        copy($_FILES['image']['tmp_name'], '../assets/img/' . $image);
    }

    if ($verif == false || empty($image)) {  // Vérifie s'il y a des champs vides et si l'image n'est téléchargée.        
        
        $info = alert("Veuillez renseigner tous les champs", "danger"); // on stocke dans $info un message d'alerte.
   
    } else { 

        // On Vérifie s'il a eu un probléme lors du téléchargement de l'image.
      
        if ($_FILES['image']['error'] != 0 || $_FILES['image']['size'] == 0 || !isset($_FILES['image']['type'])) {

            $info .= alert("L'image n'est pas valide", "danger"); 
        }

        // On récupére tous les champs de la table employes en supprimant les espaces

        $nom = trim($_POST['nom']);
        $prenom = trim($_POST['prenom']);
        $matricule = trim($_POST['matricule']);
        $email = trim($_POST['email']);
        $phone = $_POST['phone'];
        //$phone = trim($_POST['phone']);
        $ville = trim($_POST['ville']);
        $dateEmbauche = date('y-m-d');
        $regex = '/[0-9]/';

        //$id_filiale = ($_POST['filiales']);


        if (!isset($nom) || strlen($nom) < 2) {
           
            $info .= alert("le nom n'est pas valide ", "danger");
        } 
        if (!isset($prenom) || strlen($prenom) < 2) {
           
            $info .= alert("le nom n'est pas valide ", "danger");
        } 
        
        if (!isset($matricule) || strlen($matricule) < 8 || strlen($matricule) > 8) {

            $info .= alert("Il faut que le matricule contienne 8 caractéres", "danger");         
        } 
        if (!isset($email) || strlen($email) > 50 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $info .= alert("l'email n'est pas valide.", "danger");
        }
    
        if (!isset($phone) || !preg_match('/^[0-9]{10}$/', $phone)) {     
    
            $info .= alert("Le téléphne n'est pas valide.", "danger");
        }
    
        if (!isset($ville) || strlen($ville) > 50 || preg_match($regex, $ville)) {

            $info .= alert("Le champs ville n'est pas valide ", "danger");
        }
        if (!isset($dateEmbauche)) {

            $info .= alert("La date n'est pas valide", "danger");
        }

        if (!isset($filiale) ||  showFilialeViaId($filiale) == false) {

            $info .= alert("la filiale n'est pas correcte", "danger");
        }
        else if (empty($info)) { //Si aucune erreur n'a été détéctée 

        //on vérifie si l'action dans l'URL est définie, s'il s'agit d'un update, et si l' id_employe existe. 

            if (isset($_GET) && isset($_GET['action']) && isset($_GET['id_employe']) && !empty($_GET['action']) && !empty($_GET['id_employe']) && $_GET['action'] == 'update') {

                $idemploye = htmlentities($_GET['id_employe']); // On évite les injections malveillantes .
                //On appelle la fonction updateEmployes() pour modifier l'employe.
               
                updateEmployes($image, $nom, $prenom, $matricule, $email, $phone, $ville, $dateEmbauche, $filiale_id);
                
                header('location:employes.php');

            } else { //Si l'employe n'existe pas, on passe à la création d'un nouvel employe.

                //on vérifie si l'Employe existe déjà avec le même titre et la même date de création .
                if (verifEmploye($matricule, $dateEmbauche)) {

                    $info = alert("L'employe existe déjà", "danger");
                    
                } else {

                    //On insére le nouvel employe dans la BDD (titre, description, date, image et catégorie).
                    
                    addEmployes($image, $nom, $prenom, $matricule, $email, $phone, $ville, $dateEmbauche, $filiale_id);
                   
                    header('location:employes.php');
                }
            }
        }
    }
}

require_once "../inc/header.inc.php";
?>

<main>

    <!-- si l'employe existe on le modifie sinon on l'insére -->
    
    <h2 id="text3d" class="text-center fw-bolder mb-5 "><?= isset($employe) ? 'MODIFIER UN EMPLOYE' : 'AJOUTER UN EMPLOYE' ?> </h2> 

    <?php echo $info;  ?>
    
    <form action="" method="post" class="back" enctype="multipart/form-data">
        <div class="row bg-dark.bg-gradient">
            <div class="col-md-6 mb-5">
                <label for="image">Photo de l'employe</label>
                <br>
                <input type="file" name="image" id="image">
            </div>
            <div class="col-md-6 mb-5">
                <label for="nom">Nom de l'employe</label>
                <!-- Si la clé 'nom' dans $Employe n'existe pas ou est null,on affiche une chaîne vide ('').-->
                
                <input type="text" name="nom" id="nom" class="form-control" value="<?= $employe['nom'] ?? '' ?>">
            </div>
            <div class="col-md-6 mb-5">
                <label for="nom">Prenom de l'employe</label>
                <input type="text" name="prenom" id="prenom" class="form-control" value="<?= $employe['prenom'] ?? '' ?>">
            </div>
            <div class="col-md-6 mb-5">
                <label for="matricule">Matricule de l'employe</label>
                <input type="text" name="matricule" id="matricule" class="form-control" value="<?= $employe['matricule'] ?? '' ?>">
            </div>
            <div class="col-md-6 mb-5">
                <label for="email">email de l'employe</label>
                <input type="text" name="email" id="email" class="form-control" value="<?= $employe['email'] ?? '' ?>">
            </div>
            <div class="col-md-6 mb-5">
                <label for="phone ">Téléphone de l'employe</label>
                <input type="text" name="phone" id="phone" class="form-control" value="<?= $employe['phone'] ?? '' ?>">
            </div>
            <div class="col-md-6 mb-5">
                <label for="ville">Ville de l'employe</label>
                <input type="text" name="ville" id="ville" class="form-control" value="<?= $employe['ville'] ?? '' ?>">
            </div>
            <div class="col-md-6 mb-5">
                <label for="dateEmbauche">Date d'Embauche de l'employe</label>
                <input type="text" name="dateEmbauche" id="dateEmbauche" class="form-control" value="<?= $employe['dateEmbauche'] ?? '' ?>">
            </div>
           
        </div>

        <div class="row">
            <label for="filiales">Filiale de l'employe</label>
            <?php
            $filiales = allFiliales();

            foreach ($filiales as $key => $filiale) {
            ?>
                <div class="form-check col-sm-12 col-md-3">

                <!-- si l'employe a déjà une filiale, le bouton est pré-coché, Sinon le bouton reste décoché. -->
                    <input class="form-check-input" type="radio" name="filiales" id="<?= html_entity_decode($filiale["name"]) ?>" value="<?= $filiale["id_filiale"] ?>" <?= isset($employe['filiale_id']) && $employe['filiale_id'] == $filiale['id_filiale'] ? 'checked' : '' ?>>

                    <!-- l'ID est décodé pour gérer les caractères spéciaux, le contenu du label est généré avec le nom de la catégorie, la 1ére lettre du nom de la catégorie est en majuscule. -->                    
                    <label class="form-check-label" for="<?= html_entity_decode($filiale["name"]) ?>"><?= ucfirst(html_entity_decode($filiale["name"])) ?></label>
                </div>
            <?php
            }
            ?>
        </div>

        <div class="row justify-content-center">
            <button type="submit" class="btn btn-success p-3 w-25"> <?= isset($employe) ? 'MODIFIER UN EMPLOYE' : 'AJOUTER UN EMPLOYE' ?></button>
        </div>
    </form>
</main>
<?php

require_once "../inc/footer.inc.php";
?>