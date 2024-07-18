<?php
require_once "inc/functions.inc.php";


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
$duration1 = $date_time1->format('H:i');
$actors= stringToArray($film['actors']);
//debug($film);

require_once "inc/header.inc.php";


?>

<div class="film bg-dark">
               
               <div class="back">
                   <a href="<?=RACINE_SITE."index.php"?>"><i class="bi bi-arrow-left-circle-fill"></i></a>
               </div>
               <div class="cardDetails row mt-5">
               <h2 class="text-center mb-5"></h2>
                    <div class="col-12 col-xl-5 row p-5">
                        <img src="<?="assets/img/". $film['image']?>" alt="Affiche du film">
                        <div class="col-12 mt-5">
                              <form action="boutique/panier.php" method="post"  enctype="multipart/form-data"  class="w-50 m-auto row justify-content-center p-5">
                                <!-- Dans le formulaire d'ajout au panier, ajoutez des champs cachés pour chaque information que vous souhaitez conserver du film -->
                                   <input type="hidden" name="id_film" value="<?= $film['id_film'] ?>">
                                   <input type="hidden" name="title" value="<?= $film['title'] ?>">
                                   <input type="hidden" name="price" value="<?= $film['price'] ?>">
                                   <input type="hidden" name="stock" value="quantity">

                                   <input type="hidden" name="image" value="<?= $film['image'] ?>">
                                   <select name="quantity" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example"> 
                                        <?php 
                                        for ($i = 1; $i <= $film['stock'] ; $i++) { 
                                        ?>
                                        <option value="<?=$i?>"><?=$i?></option>
                                        <?php 
                                        };
                                        ?>
                                 <!-- Je créé dynamiquement la quantité sélectionnable dans la limite du stock -->
                                     
                                   </select>
                                  <a href="boutique/panier.php?id_film=<?=$film["id_film"] ?>" class="btn w-100 m-auto">Ajouter au Panier</a>
                                    
                                   <input class="btn btn-outline-danger mt-3 w-100" type="submit" value="Ajouter au panier" name="ajout_panier" id="addCart">
                                <!-- au moment du click j'initalise une session de panier qui sera récupérer dans le fichier panier.php -->
                              </form>    
                         </div>
                    </div>
                    <div class="detailsContent  col-md-7 p-5">
                         <div class="container mt-5">     
                              <div class="row">
                                   <h3 class="col-4"><span>Realisateur : </span></h3>
                                   <ul class="col-8">
                                        <li><?= $film['director'] ?? '' ?></li>
                                   </ul>
                                   <hr>
                              </div>
                              <div class="row">
                                   <h3 class="col-4"><span>Acteur :</span></h3>
                                   <ul class="col-8"> 
                                        <?php
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
                                        <li><?= $film['category_id']?></li>
                                   </ul>
                                   <hr>
                              </div>
                              <div class="row"> 
                                   <h3 class="col-4"><span>Durée : </span></h3>
                                   <ul class="col-8">
                                        <li><?= $duration1?></li>
                                   </ul>
                                   <hr>
                              </div>
                              <div class="row"> 
                                   <h3 class="col-4"><span>Date de sortie:</span></h3>
                                   <ul class="col-8">
                                        <li><?= $film['date'] ?></li>
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
                                        <li><?=substr($film['synopsis'],0, 50) ?>...</li>
                                   </ul>
                              </div>
                         </div>
                    </div>
               </div>          
                     
          
          </div>
     




<?php

require_once "inc/footer.inc.php";

?>

