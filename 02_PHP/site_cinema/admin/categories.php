<?php
require_once "../inc/functions.inc.php";
require_once "../inc/header.inc.php";


?>


<div class="d-flex col-sm-12">
   
  <div class="col-sm-6">
    <h2>GESTION DES CATEGORIES</h2>
        <form action="" method="post" class="p-5  categorie  ">
                <div class="col mb-6">
                    <div class="col-md-6 mb-5">
                        <label for="lastName" class="form-label mb-3 text-black">Nom de la catégorie</label>
                        <input type="text" class="form-control fs-5" id="lastName" name="lastName">
                    </div>
                    <div class="col-md-8 mb-5">
                        <label for="" class="form-label mb-3 text-black">Description</label>
                        <textarea class="form-control fs-1 " placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                    </div>
                </div>
               
                
                <div class="row col-sm-12 ">
                    <button class=" m-auto btn btn-danger btn-lg fs-3" type="submit">AJOUTER UNE CATEGORIE </button>
                </div>
       
            </form>
            </div>
            
        
   


    <div class="col-sm-6 mx-5 table-responsive">   
        <!-- tableau pour afficher toutles films avec des boutons de suppression et de modification -->
            <h2 class="text-center fw-bolder mb-5 text-danger">Liste des utilisateurs</h2>
            <table class="table  table-dark table-bordered mt-5">
                <thead>
                <tr>
                <!-- th*7 -->
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Supprimer</th>
                    <th>Modifier</th>
                                    
                </tr>
                </thead>
        <tbody>

       
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td class="text-center"> <a href="?action=delete&id_users=<?=$user['id_user']?>"><i class="bi bi-trash3-fill"></i></a>  </td>
               
                
                               
            </tr>
       
        <?php 
         
        ?>        
            </tbody>
        </table>
    </div>
</div>


   
     
       
<?php

require_once "../inc/footer.inc.php";

?>