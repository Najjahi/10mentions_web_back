<?php 

require_once "inc/functions.inc.php";
 require_once "inc/header.inc.php";
 
 if(empty($_SESSION['user'])) {

    header("location:".RACINE_SITE.":authetification.php");
}
 //debug($_SESSION);
 ?>
<div class="mx-auto p-2 row flex-column align-items-center"> 
    <h2 class="text-center mb-5">Bonjour <?= $_SESSION['user']['firstName'] ?></h2>
 	<div class="cardfilm">
        <div class="image">
         <img src="assets/img/<?= $_SESSION['user']['civility'] == 'h' ? 'avatar_h.png' : 'avatar_f.png'?>" alt="Image avatar de l'utilisateur" >

    <!-- 2 éme façon de faire -->
         <!-- <?php

            // if ($_SESSION['user']['civility'] == 'f') {
            ?>
                <img src="assets/img/avatar_f.png" alt="Image avatar femme">
            <?//php
            // } else {
            ?>
                <img src="assets/img/avatar_h.png" alt="Image avatar homme">

            <?php
            // }

            ?> -->
            <div class="details">
            <div class="center ">
                
                <table class="table">
                          <tr>
                                <th scope="row" class="fw-bold">Nom </th>
                                <td><?= $_SESSION['user']['firstName'] ?></td>
                               
                            </tr>
                            <tr>
                                <th scope="row" class="fw-bold">Prenom</th>
                                <td> <?= $_SESSION['user']['lastName'] ?></td>
                                
                            </tr>
                            <tr>
                                <th scope="row" class="fw-bold">Pseudo <?= $_SESSION['user']['pseudo'] ?></th>
                                <td colspan="2"></td>
                                
                            </tr>
                            <tr>
                                <th scope="row" class="fw-bold">email</th>
                                <td colspan="2"><?= $_SESSION['user']['email'] ?></td>
                                
                            </tr>
                            <tr>
                                <th scope="row" class="fw-bold">Tel</th>
                                <td colspan="2"><?= $_SESSION['user']['phone'] ?></td>
                                
                            </tr>
                            <tr>
                                <th scope="row" class="fw-bold">Adresse</th>
                                <td colspan="2"><?= $_SESSION['user']['address'] ?> <?= $_SESSION['user']['zip'] ?><?= $_SESSION['user']['city'] ?><?= $_SESSION['user']['country'] ?></td>
                                
                            </tr>

                </table>



                <a href="" class="btn mt-5">Modifier vos informations</a>
                



            </div>
        </div>







    </div>
    
    

    <?php

    require_once "inc/footer.inc.php";
    ?>

