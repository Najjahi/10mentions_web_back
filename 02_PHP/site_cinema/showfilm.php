<?php
require_once "inc/functions.inc.php";

if(empty($_SESSION['user'])) {

     header("location:".RACINE_SITE."authentification.php");
 }
 
if (isset($_GET) && isset($_GET['id_film']) && !empty($_GET['id_film'] )) {

        
    $idfilm = htmlentities($_GET['id_film']);

    if(is_numeric($idfilm)) { 

        $film  = showFilmViaId($idfilm);
                
        
        if(!$film) {
            
            header('location:index.php');
        }
        
    } else{
        header('location:index.php');
    }
    
}
//debug($actors);
    
$date_time1 = new DateTime($film['duration']);
$duration1 = $date_time1->format('H:i'); // $duration est un objet
$actors= stringToArray($film['actors']);
//debug($film);

require_once "inc/header.inc.php";


?>

<div class="film bg-dark">
               
               <div class="back">
                   <a href="<?=RACINE_SITE."index.php"?>"><i class="bi bi-arrow-left-circle-fill"></i></a>
               </div>
               <div class="cardDetails row mt-5">
               <h2 class="text-center mb-5"><?php $film['title'] ?></h2>
                    <div class="col-12 col-xl-5 row p-5">
                        <img src="<?=RACINE_SITE?>assets/img/<?=$film['image']?>" alt="Affiche du film">
                        <div class="col-12 mt-5">
                              <form action="boutique/panier.php" method="post"  enctype="multipart/form-data"  class="w-50 m-auto row justify-content-center p-5"> 
                         <!-- Dans le formulaire d'ajout au panier, ajoutez des champs cachés pour chaque information que vous souhaitez conserver du film (action est pour le traitement du formulaire) -->
                                   <input type="hidden" name="id_film" value="<?= $film['id_film'] ?>">
                                   
                                        
                                   <select name="quantity" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example"> 
                                   
                                   <!-- Je créé dynamiquement la quantité sélectionnable dans la limite du stock -->
                                        <?php 
                                        for ($i = 1; $i <= $film['stock'] ; $i++) { 
                                        ?>
                                        <option value="<?=$i?>"><?=$i?></option>

                                        <?php 
                                        };
                                        debug($film['stock']);
                                        ?>
                                
                                     
                                   </select>

                                   <button class="m-auto btn btn-danger btn-lg fs-5" type="submit">Ajouter au panier</button>
                                 
                                    
                                  
                                <!-- au moment du click j'initalise une session de panier qui sera récupérer dans le fichier panier.php -->
                              </form>    
                         </div>
                    </div>
                    <div class="detailsContent  col-md-7 p-5">
                         <div class="container mt-5">     
                              <div class="row">
                                   <h3 class="col-4"><span>Realisateur : </span></h3>
                                   <ul class="col-8">
                                        <li><?= html_entity_decode($film['director'])?></li>
                                   </ul>
                                   <hr>
                              </div>
                              <div class="row">
                                   <h3 class="col-4"><span>Acteur :</span></h3>
                                   <ul class="col-8"> 
                                        <?php
                                        $actors = stringToArray(html_entity_decode($film['actors']));
                                        //debug($actors);
                                        foreach ($actors as $key => $actor) {
                                        ?>
                                             <li><?= $actor?></li>

                                        <?php
                                        }
                                        ?>
                                       
                                   </ul> 
                                   <hr>
                              </div>
                              
                              <!-- // si j'ai un age limite renseigné je l'affiche si non pas de div avec Àge limite : -->
                             
                                   <div class="row">
                                        <h3 class="col-4"><span>Àge limite :</span></h3>
                                        <ul class="col-8">
                                             <li><?= $film['age_Limit']?></li>
                                            
                                        </ul> 
                                        <hr>
                                   </div>
                              
                              <div class="row">
                                   <h3  class="col-4"><span>Genre : </span></h3>
                                   <ul  class="col-8">

                                   <?php
                                   $category = showCategoryViaId($film['category_id']);
                                   $categoryName =$category['name'];
                                        //debug($category);
                                    ?>
                                        <li><?= $film['category_id']?></li>
                                   </ul>
                                   <hr>
                              </div>
                              <div class="row"> 
                                   <h3 class="col-4"><span>Durée : </span></h3>
                                   <ul class="col-8">

                                        <li><?= $duration1?></li>
                                        <!-- methode 2
                                        <li><//?=//(new DateTime($film['$duration'])) ->format('H:i'?></li> -->
                                   </ul>
                                   <hr>
                              </div>
                              <div class="row"> 
                                   <h3 class="col-4"><span>Date de sortie:</span></h3>
                                   <ul class="col-8">

                                   <?php
                                   $dateView = new DateTime($film['date']);
                                   $dateSortie = $dateView->format('d/M/y');
                                   ?>

                                        <li><?= $dateSortie?></li>
                                   </ul>
                                   <hr>
                              </div>
                              <div class="row"> 
                                   <h3 class="col-4"><span>Prix : </span></h3>
                                   <ul class="col-8">
                                        <li> <?= $film['price'] ?>€</li>
                                   </ul>
                                   <hr>
                              </div>
                              <div class="row"> 
                                   <h3 class="col-4"><span>Stock :</span> </h3>
                                   <ul class="col-8">
                                        <li> <?= $film['stock'] ?></li>
                                   </ul>
                                   <hr>
                              </div>
                              <div class="row">
                                        
                                   <h5 class="col-4" ><span>Synopsis :</span></h5>
                                   <ul class="col-8">
                                        <li><?=html_entity_decode($film['synopsis']) ?></li>
                                   </ul>
                              </div>
                         </div>
                    </div>
               </div>          
                     
          
          </div>
     




<?php

require_once "inc/footer.inc.php";

?>

