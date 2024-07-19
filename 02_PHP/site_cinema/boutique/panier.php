<?php

require_once "../inc/functions.inc.php";
if(empty($_SESSION['user'])) {

     header("location:".RACINE_SITE.":authetification.php");
 }

 if(isset($_POST) && !empty($_POST)) {

     $idFilm = htmlentities($_POST['id_film']);
     $quantite = htmlentities($_POST['quantity']);
 }

require_once "../inc/header.inc.php";

debug($_POST);
?>


<div class="panier d-flex justify-content-center" style="padding-top:8rem;">

         
          <div class="d-flex flex-column  mt-5 p-5">
               <h2 class="text-center fw-bolder mb-5 text-danger">Mon panier</h2>
               
               <!-- le paramètre vider=1 pour indiquer qu'il faut vider le panier. -->
                    <?php 
                      
                    
                    ?>
               <a href="?vider" class="btn align-self-end mb-5">Vider le panier</a>
     
                         <table class="fs-4">
                              <tr>
                                   <th class="text-center text-danger fw-bolder">Affiche</th>
                                   <th class="text-center text-danger fw-bolder">Nom</th>
                                   <th class="text-center text-danger fw-bolder">Prix</th>
                                   <th class="text-center text-danger fw-bolder">Quantité</th>
                                   <th class="text-center text-danger fw-bolder">Sous-total</th>
                                   <th class="text-center text-danger fw-bolder">Supprimer</th>
                              </tr>     
                  
                              <tr>
                                   <td class="text-center border-top border-dark-subtle"><a href="<?=RACINE_SITE?>showFilm.php?id_film="><img src="<?=RACINE_SITE?>assets/img/<?=$film['image']?>" style="width: 100px;"></a></td>
                                   <td class="text-center border-top border-dark-subtle"><?= $_POST['price']?></td>
                                   <td class="text-center border-top border-dark-subtle">€</td>
                                   <td class="text-center border-top border-dark-subtle d-flex align-items-center justify-content-center" style="padding: 7rem;">
                                     
                                         <!-- Afficher la quantité actuelle -->
                                      
                                   </td>
                                   <td  class="text-center border-top border-dark-subtle">€</td>
                                   <td  class="text-center border-top border-dark-subtle"><a href="?id_film="><i class="bi bi-trash3"></i></a></td>
                              </tr>
                   
                              <tr class="border-top border-dark-subtle">
                                   <th class="text-danger p-4 fs-3">Total : €</th>
                              </tr>                 

                         </table>
                         <form action="checkout.php" method="post">
                              <input type="hidden" name="total" value="">
                              <button type="submit" class="btn btn-danger mt-5 p-3" id="checkout-button">Payer</button>
                              
                         </form>                        
                   
          </div>
     </div>
<?php

require_once "../inc/footer.inc.php";
?>
