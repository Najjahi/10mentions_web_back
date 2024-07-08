<?php
require_once "../inc/functions.inc.php";

// gestion de l'accessibilité des pages admin

if (empty($_SESSION['user'])) {

    header('location:'.RACINE_SITE.'authentification.php');

} else {

    if ($_SESSION['user']['role']== 'ROLE_USER') {

        header('location:'.RACINE_SITE.'index.php');
    }
}


$info = "";


////////////////// Validation du formulaire //////////////////

// On vérifie si un champs est vide

if (!empty($_POST)) {
    
    $verif=true;
   
    foreach ($_POST as $key => $value) { // une boucle pour vérifier si un champ est vide
      
        if (empty(trim($value))) {

            $verif = false;
        }
    }
    
    // la superglobale $_FILES a un indice "image" qui correspond au "name" de l'input type="file" du formulaire, ainsi qu'un indice "name" qui contient le nom du fichier en cours de téléchargement.
   
    if (!empty($_FILES['image']['name'])) { //si le nom du fichier en cours de téléchargement n'est pas vide, alors c'est qu'on est en train de télécharger une photo

        $image = 'img/'.$_FILES['image']['name'];  // $image contient le chemin relatif de la photo et sera enregistré en BDD. On utilise ce chemin pour les "src" des balises <img>.
        
        copy($_FILES['image']['tmp_name'],'../assets/'.$image );
      
        // on enregistre le fichier image qui se trouve à l'adresse contenue dans $_FILES['image']['tmp_name'] vers la destination qui est le dossier "img" à l'adresse "../asstes/nom_du_fichier.jpg".
    }
   
    if($verif == false || empty($image)){  // si la variable $verif passe en false ou la variable image est vide 
       
        $info = alert("Veuillez renseigner tout les champs", "danger");
   
    } else {

        // on vérifie l'image : 
            // $_FILES['image']['name'] Nom
            // $_FILES ['image']['type'] Type
            // $_FILES ['image']['size'] Taille
            // $_FILES ['image']['tmp_name'] Emplacement temporaire
            // $_FILES ['image']['error'] Erreur si oui/non l'image a été réceptionné
            debug($_FILES['image']['name']);
            debug($_FILES['image']['type']);
            debug($_FILES['image']['size']);
            debug($_FILES['image']['tmp_name']);
            debug($_FILES['image']['error']);

        if($_FILES['image']['error'] != 0 || $_FILES['image']['size'] == 0 || !isset($_FILES['image']['type'])){

            $info .= alert("L'image n'est pas valide","danger");


        }
        
        
        $title = trim($_POST['title']);
        $image = trim($_POST['image']);
        $director = trim($_POST['director']);
        $actor = trim($_POST['actors']);
        $ageLimit = trim($_POST['ageLimit']);
        $duration = trim($_POST['duration']);
        $date = trim($_POST['date']);
        $price = trim($_POST['price']);
        $stock = trim($_POST['stock']);
        $synopsis = trim($_POST['synopsis']);

        // validation
        if (!isset($title)) {
            $info = alert("le champs titre n'est pas valide", "danger");
        }

        if (!isset($director)) {
            $info = alert("le champs réalisateur n'est pas valide", "danger");
        }

        if (!isset($image)) {
            $info = alert("le champs image n'est pas valide", "danger");
        }

        if (!isset($actor)) {
            $info = alert("le champs nom de la catégorie n'est pas valide", "danger");
        }

        if (!isset($ageLimit)) {
            $info = alert("le champs nom de la catégorie n'est pas valide", "danger");
        }

        if (!isset($duration)) {
            $info = alert("le champs nom de la catégorie n'est pas valide", "danger");
        }

        if (!isset($date)) {
            $info = alert("le champs nom de la catégorie n'est pas valide", "danger");
        }

        if (!isset($price)) {
            $info = alert("le champs nom de la catégorie n'est pas valide", "danger");
        }

        if (!isset($stock)) {
            $info = alert("le champs nom de la catégorie n'est pas valide", "danger");
        }

        if (!isset($synopsis)) {
            $info = alert("le champs nom de la catégorie n'est pas valide", "danger");
        }

    }

}


require_once "../inc/header.inc.php";
?>

<main>
    <h2 class="text-center fw-bolder mb-5 text-danger">Ajouter un film</h2>

    <?php
    echo $info;
    ?>
<form action="" method="post" class="back" enctype="multipart/form-data">
    <!-- il faut isérer une image pour chaque film, pour le traitement des images et des fichiers en PHP on utilise la surperglobal $_FILES -->
    <div class="row">
        <div class="col-md-6 mb-5">
            <label for="title">Titre de film</label>
            <input type="text" name="title" id="title" class="form-control" value="">

        </div>
        <div class="col-md-6 mb-5">
            <label for="image">Photo</label>
            <br>
            <input type="file" name="image" id="image" >
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-5">
            <label for="director">Réalisateur</label>
            <input type="text" class="form-control" id="director" name="director" value="" >
        </div>
        <div class="col-md-6">
            <label for="actors">Acteur(s)</label>
            <input type="text" class="form-control" id="actors" name="actors" value=""  placeholder="séparez les noms d'acteurs avec un /">
        </div>
    </div>
    <div class="row">
        <!-- raccouci bs5 select multiple -->
        <div class="mb-3">
            <label for="ageLimit" class="form-label">Àge limite</label>
            <select multiple class="form-select form-select-lg" name="ageLimit" id="ageLimit">
                <option value="10">10</option>
                <option value="13">13</option>
                <option value="16">16</option>
            </select>
        </div>
    </div>
    <div class="row">
        <label for="categories">Genre du film</label>

        <!--  Ici c'est les catégories qui sont déjà stockés dans la BDD et qu'on vas les récupérer à partir de cette dernière -->
            <?php
            $categories = allCategories();

            foreach ($categories as $key => $categorie) {

            ?>

            <div class="form-check col-sm-12 col-md-4">
                <input class="form-check-input" type="radio" name="categories" id="flexRadioDefault1" value="<?=html_entity_decode($categorie["id_category"]) ?>"  >
                <label class="form-check-label" for="<?=html_entity_decode($categorie["name"])?>"><?=ucfirst(html_entity_decode($categorie["name"]))?></label>
            </div>

            <?php
            }
            ?>


    </div>
    <div class="row">
        <div class="col-md-6 mb-5">
            <label for="duration">Durée du film</label>
            <input type="time" class="form-control" id="duration" name="duration" value="" >
        </div>

        <div class="col-md-6 mb-5">

            <label for="date">Date de sortie</label>
            <input type="date" name="date" id="date" class="form-control" value="" >
        </div>
    </div>
        <div class="row">
            <div class="col-md-6 mb-5">
                <label for="price">Prix</label>
                <div class=" input-group">
                    <input type="text" class="form-control" id="price" name="price"  aria-label="Euros amount (with dot and two decimal places)" value="">
                    <span class="input-group-text">€</span>
                </div>
            </div>

            <div class="col-md-6">
                <label for="stock">Stock</label>
                <input type="number" name="stock" id="stock" class="form-control" min ="0"  value=""> <!--pas de stock négativ donc je rajoute min="0"-->
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <label for="synopsis">Synopsis</label>
                <textarea type="text" class="form-control" id="synopsis" name="synopsis" rows="10"></textarea>
            </div>
        </div>

        <div class="row justify-content-center">
            <button type="submit" class="btn btn-danger p-3 w-25">Ajouter un film</button>
        </div>

</form>

</main>
<?php

     require_once "../inc/footer.inc.php";
?>