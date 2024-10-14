<?php
require_once "inc/functions.inc.php";


$commentaires = [];
if (isset($_GET) && isset($_GET['id_article']) && !empty($_GET['id_article'])) {
     $idarticle = htmlentities($_GET['id_article']);

     if (is_numeric($idarticle)) {
          $article  = showArticleViaId($idarticle);
          $commentaires = getArticleCommentaires($idarticle);

          if (!$article) {
               header('location:index.php');
          }
     } else {
          header('location:index.php');
     }
}

// Saisie de commentaire
$info = "";
if (!empty($_POST)) { // si le formulaire est envoyé

     $article_id = $_GET['id_article'];

     $commentaire = trim($_POST['commentaire']);
     $idUser = $_SESSION['user']['id_user'];

     if (!isset($commentaire) || strlen($commentaire) < 20) {

          $info = alert("Veuillez saisir un paragraphe", "danger");
     } elseif (empty($info)) {

          addCommentaire($article_id, $commentaire, $idUser);
     }
}
commentaire, article_id, user_id




// récupération d'une catégorie 

$category = showCategoryViaId($article['category_id']);
$categoryName = $category['name'];


// Date de création 
$dateView = new DateTime($article['dateCreation']);
$dateCreation = $dateView->format('d-M-y');

// Date de modification
$dateModification = '';
if (isset($article['dateModification'])) {

     $dateView = new DateTime($article['dateModification']);
     $dateModification = $dateView->format('d-M-y');
}

require_once "inc/header.inc.php";
?>
<main>
<div class="article ">
     <div class="back">
          <a href="<?= RACINE_SITE . "index.php" ?>"><i class="bi bi-arrow-left-circle-fill"></i></a>
     </div>
     <div class="cardDetails row ">
          <h2 id="text3d" class="text-center mb-5"><?= $article['title'] ?></h2>
          <div class="container">
               <div class="square">
                    <img src="<?= RACINE_SITE ?>assets/img/<?= $article['image'] ?>" class="mask img-fluid">
                    <div class="cat"> Catégorie : <?= html_entity_decode($category['name']) ?></div>
                    <p><?= html_entity_decode($article['description']) ?></p>

                    <div>
                         <ul>
                              <li>Date de création : <span><?= $dateCreation ?></span></li>
                              <li>Date de modification :<span> <?= $dateModification ?></span></li>
                         </ul>

                    </div>
               </div>
          </div>
     </div>

     <div class="text-light">
          <h2 id="text3d" class="text-center fw-bolder ">COMMENTAIRES</h2>

          <div class="my-5">
               <!-- La boucle affiche les commentaires du tableau $commentaires un par un -->

               <?php
               if ($commentaires) {
                    foreach ($commentaires as $commentaire) :
               ?>

                         <p class="text-light border border-warning" ><?= $commentaire['commentaire'] ?></p>

                    <?php
                    endforeach;
               } else {

                    ?>

                    <p class="alert alert-dark text-center" role="alert">Pas de commentaire sur cette article</p>

               <?php

               }

               ?>



          </div>

     </div>
     <?php
     if (!isset($_SESSION['user'])) {
     ?>
          <p class="alert alert-dark text-center" role="alert">Connectez-vous <a href="authentification.php">ici</a> pour commenter</p>


     <?php
     } else {
     ?>
          <div class="row">
               <!-- Section pour pouvoir ajouter un commentaire -->
               <div>
                    <h2 id="text3d" class="text-center fw-bolder text-red mb-5">Ajouter un commentaire</h2>

                    <?= $info; ?>

                    <form action="" method="post" class="back">
                         <div class="row">
                              <div class="col-md-12 ">
                                   <label for="commentaire">Veuillez saisir votre commentaire</label>
                                   <textarea id="commentaire" name="commentaire" class="form-control p-5" rows="20"></textarea>
                              </div>
                         </div>
                         <div class="row justify-content-center">
                              <button type="submit" class="btn btn-danger p-3">Envoyer </button>
                              <button type="reset" class="btn btn-warning p-3 my-3">Effacer</button>
                         </div>
                    </form>
               </div>
          </div>
     <?php

     }
     ?>
</div>
</div>


</div>



</main>

<?php

require_once "inc/footer.inc.php";

?>