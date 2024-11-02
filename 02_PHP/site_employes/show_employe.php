<?php
require_once "inc/functions.inc.php";

if(empty($_SESSION['user'])) {

     header("location:".RACINE_SITE."authentification.php");
 }
 
if (isset($_GET) && isset($_GET['id_employe']) && !empty($_GET['id_employe'] )) {

        
    $idemploye = htmlentities($_GET['id_employe']);

    if(is_numeric($idemploye)) { 

        $employe  = showEmployeViaId($idemploye);
                
        
        if(!$employe) {
            
            header('location:index.php');
        }
        
    } else{
        header('location:index.php');
    }
    
}


require_once "inc/header.inc.php";


?>

<div class="employe bg-dark">
               
               <div class="back">
                   <a href="<?=RACINE_SITE."index.php"?>"><i class="bi bi-arrow-left-circle-fill"></i></a>
               </div>
               <div class="cardDetails row mt-5">
                    <div class="col-12 col-xl-5 row p-5">
                         <img src="<?=RACINE_SITE?>assets/img/<?=$employe['image']?>" alt="Photo de l'employe">                         
                    </div>
                    <h2 class="text-center mb-5"><?= $employe['nom'] ?><br><?= $employe['prenom'] ?></h2>
                    <div class="detailsContent  col-md-7 p-5">
                         <div class="container mt-5">     
                              <div class="row">
                                   <h3 class="col-4"><span> Matricule : </span></h3>
                                   <ul class="col-8">
                                        <li><?= $employe['matricule']?></li>
                                   </ul>
                                   <hr>
                              </div>
                              <div class="row">
                                   <h3 class="col-4"><span> Email de l'employé :</span></h3>
                                   <ul class="col-8">                                         
                                        <li><?=$employe['email']?></li>
                                   </ul> 
                                   <hr>
                              </div>
                              
                              <div class="row">
                                        <h3 class="col-4"><span>Téléphone de l'employé :</span></h3>
                                        <ul class="col-8">
                                             <li><?= $employe['phone']?></li>                                            
                                        </ul> 
                                        <hr>
                                   </div>
                              
                              <div class="row">
                                   <h3  class="col-4"><span>Filiale de l'employé : </span></h3>
                                   <ul  class="col-8">

                                   <?php
                                   $filiale = showFilialeViaId($employe['filiale_id']);
                                   $filialeName =$filiale['name'];                                        
                                    ?>
                                        <li><?= $employe['filiale_id']?></li>
                                   </ul>
                                   <hr>
                              </div>
                              <div class="row"> ville de l'employe : </span></h3>
                                   <ul class="col-8">

                                        <li><?= $employe['ville']?></li>                                       
                                   </ul>
                                   <hr>
                              </div>
                              <div class="row"> 
                                   <h3 class="col-4"><span>Date d'embauche :</span></h3>
                                   <ul class="col-8">

                                         <li><?= $dateEmbauche?></li>
                                   </ul>
                                   <hr>
                              </div>                            
                              
                              </div>
                    </div>
               </div>          
                     
          
          </div>
     




<?php

require_once "inc/footer.inc.php";

?>

