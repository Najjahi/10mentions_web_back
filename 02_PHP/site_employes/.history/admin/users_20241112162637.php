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
        $idemploye = htmlentities($_GET['id_employe']);

    
        $employes = allEmployes();
        
        // gestion de l'accessibilité des pages admin 
        if (empty($_SESSION['user'])) {
            header('location:' . RACINE_SITE . 'authentification.php');
        } else {
            if ($_SESSION['user']['role'] == 'ROLE_USER') {
                header('location:' . RACINE_SITE . 'index.php');
            }
        if (is_numeric($idemploye)) { //On vérifie si la valeur soumise pour le champ "id_employe" est bien un nombre.

            $employe  = showEmployeViaId($idemploye);
    
            if ($employe) {
    
                deleteEmploye($idemploye); //J'appalle la fonction pour supprimer un employe via son ID
    
                header('location:users.php');
            } else {
    
                header('location:users.php');
            }
        } else {
    
            header('location:users.php');
        }
    }

        if ($user['role'] == 'ROLE_ADMIN') {
            UpdateRole('ROLE_USER', $idUser);
        } else {
            UpdateRole('ROLE_ADMIN', $idUser);
        }
    }
    header('location:users.php');




   
}
require_once "../inc/header.inc.php";
?>
<main>
    
  <div class="container m-auto">
        <div class="d-flex flex-column m-auto mt-5 table-responsive">
        
            <!-- J'affiche la liste de tous les utilisateurs -->
             
            <h2 id="text3d" class="text-center fw-bolder mb-5 ">LISTE DES EMPLOYES</h2>
            <table class="table table-dark table-bordered mt-5">
                <thead>
                    <tr> <!-- tableau pour afficher toutles articles avec des boutons de suppression et de modification -->
                        <th>Id  </th>
                        <th>Photo employe</th>
                        <th>Nom employe </th>
                        <th>Prenom employe </th>
                        <th>Matricule employe </th>
                        <th>Date de Naissance </th>
                        <th>Email employe</th>
                        <th>Tél employe </th>
                        <th>situation famililale </th>
                        <th>Nombre Enfants </th>
                        <th>Ville employe </th>
                        <th>Date embauche</th>
                        <th>Rôle actuel</th>
                        <th>Supprimer employe</th>
                        <th>Modifier employe</th>
                        <th>Modifier Le rôle</th>                     
                                              
                    </tr>
                </thead>
                <tbody>
        
                <?php
                    // On parcouri le tableau employe par employe et À chaque boucle, la clé actuelle est stockée dans la variable $key, et l'élément lui-même est stocké dans la variable $employe. 
                    foreach ($employes as $key => $employe) {

                        $filiale = showFilialeViaId($employe['filiale_id']); // on appelle la fonction
                        $filialeName = $filiale['name']; // on stocke le nom de la catégorie dans $categoryName
                    ?>

                        <tr>
                        
                            <td><?= $user['id_user'] ?></td>
                            <td> <img src="<?= RACINE_SITE . "assets/img/" . $employe['image'] ?>" alt="affiche de l' employe" class="img-fluid"></td> <!-- l'URL de l'image -->
                            <td><?= $user['nom'] ?></td>
                            <td><?= $user['prenom'] ?></td>
                            <td><?= $user['matricule'] ?></td>  
                            <td><?= $user['dateNaissance'] ?></td>
                            <td><?= $user['email'] ?></td>  
                            <td><?= $user['phone'] ?></td> 
                            <td><?= $user['situation'] ?></td>  
                            <td><?= $user['nbreEnfants'] ?></td> 
                            <td><?= $user['ville'] ?></td>  
                            <td> <?= $employe['dateEmbauche'] ?></td>                      
                            <td><?= $user['role'] ?></td>

                            <!--On crée un lien cliquable pour supprimer l'utilisateur.-->
                            <td class="text-center"> <a href="?action=delete&id_user=<?= $user['id_user'] ?>"><i class="bi bi-trash3-fill"></i></a> </td>
        
                            <td class="text-center">
                                <a href="?action=update&id_user=<?= $user['id_user'] ?>" class="btn btn-success">

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