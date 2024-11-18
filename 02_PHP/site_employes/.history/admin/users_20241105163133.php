<?php

require_once "../inc/functions.inc.php";

$users = allUsers();

if (isset($_GET) && isset($_GET['action']) && isset($_GET['id_user'])) {

    if ($_GET['action'] == 'delete' && !empty($_GET['id_user'])) {

        $idUser = htmlentities($_GET['id_user']);
        // deleteUser($idUser);        
    }
    if ($_GET['action'] == 'update' && !empty($_GET['id_user'])) {

        $idUser = htmlentities($_GET['id_user']);
        $user = showUser($idUser);

        if ($user['role'] == 'ROLE_ADMIN') {
            UpdateRole('ROLE_USER', $idUser);
        } else {
            UpdateRole('ROLE_ADMIN', $idUser);
        }
    }
    header('location:users.php');
}

// gestion de l'accessibilité des pages admin 
if (empty($_SESSION['user'])) {
    header('location:' . RACINE_SITE . 'authentification.php');
} else {
    if ($_SESSION['user']['role'] == 'ROLE_USER') {
        header('location:' . RACINE_SITE . 'index.php');
    }
}
require_once "../inc/header.inc.php";
?>
<main>
    
  <div class="container m-auto">
        <div class="d-flex flex-column m-auto mt-5 table-responsive">
        
            <!-- J'affiche la liste de tous les utilisateurs -->
             
            <h2 id="text3d" class="text-center fw-bolder mb-5 text-danger">LISTE DES UTILISATEURS</h2>
            <table class="table table-dark table-bordered mt-5">
                <thead>
                    <tr> <!-- tableau pour afficher toutles articles avec des boutons de suppression et de modification -->
                        <th>Id utilisateur </th>
                        <th>Nom </th>
                        <th>Prenom </th>
                        <th>Matricule </th>
                        <th>Date de Naissance </th>
                        <th>Email utilisateur</th>
                        <th>Téléphone </th>
                        <th>situation famililale de l'employe</th>
                        <th>Nombre d'enfants de l'employe</th>
                        <th>Ville de l'employe</th>
                        <th>Rôle actuel</th>
                        <th>Supprimer</th>
                        <th>Modifier Le rôle</th>
                    </tr>
                </thead>
                <tbody>
        
                    <?php
        
                    foreach ($users as $key => $user) {
        
                    ?>
                        <tr>
                        
                            <td><?= $user['id_user'] ?></td>
                            <td><?= $user['nom'] ?></td>
                            <td><?= $user['prenom'] ?></td>
                            <td><?= $user['matricule'] ?></td>  
                            <td><?= $user['dateNaissance'] ?></td>
                            <td><?= $user['email'] ?></td>  
                            <td><?= $user['phone'] ?></td> 
                            <td><?= $user['situation'] ?></td>  
                            <td><?= $user['nbreEnfants'] ?></td> 
                            <td><?= $user['ville'] ?></td>                        
                            <td><?= $user['role'] ?></td>
                            
                            <!--On crée un lien cliquable pour supprimer l'utilisateur.-->
                            <td class="text-center"> <a href="?action=delete&id_user=<?= $user['id_user'] ?>"><i class="bi bi-trash3-fill"></i></a> </td>
        
                            <td class="text-center">
                                <a href="?action=update&id_user=<?= $user['id_user'] ?>" class="btn btn-danger">

                                    <!--On crée une condition de changer le role en admin si le role est user et le contraire-->
                                    <?= $user['role'] == 'ROLE_ADMIN' ? 'rôle_user' : 'rôle_adm' ?></a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
  </div>
</main>
<?php

require_once "../inc/footer.inc.php";

?>