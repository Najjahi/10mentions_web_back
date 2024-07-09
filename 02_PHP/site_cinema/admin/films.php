<?php
require_once "../inc/functions.inc.php";

// fichier qui affiche tout les films
// gestion de l'accessibilité des pages admin 
if (empty($_SESSION['user'])) {
    header('location:'.RACINE_SITE.'authentification.php');
} else {
    if ($_SESSION['user']['role'] =='ROLE_USER') {
        header('location:'.RACINE_SITE.'index.php');
    }
}
require_once "../inc/header.inc.php";
?>

   

    <div class="col-sm-12 col-md-12 d-flex flex-column mt-5 pe-3">
        <!-- tableau pour afficher toute les catégories avec des boutons de suppression et de modification -->
        <h2 class="text-center fw-bolder mb-5 text-danger">Liste des films</h2>
        <?php
        $films = allfilms();
        //debug($categories);

        ?>


        <table class="table table-dark table-bordered mt-5 ">
            <thead>
                <tr>
                    <!-- th*7 -->
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Réalisateur</th>
                    <th>Supprimer</th>
                    <th>Modifier</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($films as $key => $film) {

                ?>

                    <tr>
                        <td><?= $film['id_film'] ?></td>
                        <td><?= html_entity_decode(ucfirst($film['title'])) ?></td> <!-- une majuscule sur la première lettre avec ucfirst()-->
                        <td><?= substr(html_entity_decode($film['director']), 0, 100) . '...' ?></td> <!-- html_entity_decode convertit les netités HTML à leurs caractéres correspendants-->
                        <td class="text-center"><a href="?action=delete&id_film=<?= $film['id_film'] ?>"><i class="bi bi-trash3-fill"></i></a></td>
                        <td class="text-center"><a href="?action=update&id_film=<?= $film['id_film'] ?>"><i class="bi bi-pen-fill"></i></a></td>

                    </tr>
                    <?php

                }

                ?>
                </table>
                </div>
               
            
          
            
               

<?php

require_once "../inc/footer.inc.php";

?>
