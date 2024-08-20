<?php
require_once "inc/functions.inc.php";
// if(empty($_SESSION['user'])) {

//     header("location:".RACINE_SITE.":authetification.php");
// }
$info = '';
if (isset($_GET)  && !empty($_GET) ) {

    if (isset($_GET['id_category']) ) {

        $idCategory = htmlentities($_GET['id_category']);

        if(is_numeric($idCategory)){

            $cat = showCategoryViaId($idCategory);

            if (($cat['id_category'] != $idCategory )  || empty($idCategory) ) {

                header('location:index.php');

            }else {

                $films = filmsByCategory($idCategory);

                $message = "Cette catégorie contient : ";

                if (!$films) {

                    $info = alert("Désolé ! cette catégorie ne contient aucun film", "danger");
                }
            }

        }else {

            header('location:index.php');
        }

    }elseif(isset($_GET['action']) && $_GET['action'] == 'voirPlus'){

        $films = allFilms();
        $message = "Le nombre total de films : ";
    }

}else{

    $films = filmByDate();
    $message = "Le nombre de films sortie en dernier ";

}

require_once "inc/header.inc.php";
?>

<div class="films">
    <h2 class="fw-bolder fs-1 mx-5 text-center"> <?= $message . count($films) ?></h2>

    <div class="row">
        <?php
        echo $info ;
        foreach ($films as  $film) {

        ?>
            <div class="col-sm-12 col-md-6 col-lg-4 col-xxl-3" >
                <div class="card">
                    <img src="<?= RACINE_SITE?>assets/img/<?=$film['image']?>" alt="image du film" >
                    <div class="card-body">
                        <h3><?= $film['title']?></h3>
                        <h4><?= $film['director']?></h4>
                        <p><span class="fw-bolder">Résumé:</span> <?= substr($film['synopsis'], 0 , 90). '...'?></p>
                        <a href="<?=RACINE_SITE?>showFilm.php?id_film=<?=$film['id_film']?>" class="btn">Voir plus</a>
                    </div>
                </div>
            </div>
            <!-- <div class="col-12 text-center">
                <?//= count($films) == 0 || (isset($_GET['action']) && $_GET['action'] == 'voirPlus') ? '<a href="'.  RACINE_SITE.'index.php" class="btn p-4 fs-3"> Retourner à l\'accueil </a>' : '<a href="'.RACINE_SITE.'?action=voirPlus" class="btn p-4 fs-3"> Accéder à tout les films </a>' ?>
            </div> -->
            <?php
        }

        ?>
    </div>
    <?php
    if (empty($_GET)) {
    
    ?>
    
    <div class="col-12 text-center">
        <a href="<?=RACINE_SITE?>?action=voirPlus" class="btn p-4 fs-3">Voir plus de films</a>
    </div>
    <?php
    }
    
    ?>
</div>

<?php

require_once "inc/footer.inc.php";

?>