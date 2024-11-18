<?php
require_once "inc/functions.inc.php";
$info = '';

if (isset($_GET)  && !empty($_GET)) {

    if (isset($_GET['id_filiale'])) {

        $idFiliale = htmlentities($_GET['id_filiale']); // Sécurise l'ID en échappant les caractères spéciaux
        if (is_numeric($idFiliale)) {  // Vérifie si l'ID est numérique

            $filiale = showFilialeViaId($idFiliale); // Récupère les détails de la catégorie via son ID

            if (($filiale['id_filiale'] != $idFiliale)  || empty($idFiliale)) {

                header('location:index.php');
            } else {

                $employes = employesByFiliale($idFiliale); // Récupère les aemployes par catégorie

                $message = "Cette catégorie contient: ";

                if (!$employes) { //si lacatégorie n'existe pas

                    $info = alert("Désolé ! cette catégorie ne contient aucun employe", "danger");
                }
            }
        } else {

            header('location:index.php'); // Redirige vers la page d'accueil si l'ID n'est pas numérique
        }
    } elseif (isset($_GET['action']) && $_GET['action'] == 'voirPlus') { // Vérifie si l'action est 'voirPlus'

        $employes = allEmployes(); // Récupère tous les employes
        $message = "Le nombre total de employes : ";
    }
} else {

    $employes = employeByDate(); // Récupère les employes par date
    $message = "Le nombre de employes sortie en dernier : ";
}

require_once "inc/header.inc.php"; // Inclut le fichier d'en-tête
?>
<main class="accueil">
    <div class="container-fluid d-flex flex-column align-items-center ">
        <!-- Section 1  pour afficher une video de démonstration du viet vo dao   -->
        <h2 id="text3d" class=" mx-5 text-center p-4"> VIDEO DE DEMONSTRATION  </h2>
        <div class="row mb-1 justify-content-center">
            <div col-sm-12 col-md-6>
                

                <div class="bloc-btn d-flex justify-content-between align-items-center ">
                    <i class="bi bi-emoji-neutral"></i>
                    <button class="btn-abonner">Abonnez-vous</button>
                </div>
            </div>
        </div>

        <div class="slider d-flex flex-column align-items-center ">

            <!-- Section 2 pour afficher un carousel avec des images du viet vo dao   -->

            <h2 id="text3d" class=" mx-5 text-center p-4"> IMAGES ET ILLUSTRATIONS </h2>
            <div class="outils d-flex  ">
                <div class="left p-3" title="Image précédente">
                    <i class="bi bi-skip-backward-fill"></i>
                </div>
                <div class="automatic p-3" title="Démarrer le carrousel">
                    <i class="bi bi-caret-right-fill"></i>
                </div>
                <div class="right p-3" title="Image suivante">
                    <i class="bi bi-skip-forward-fill"></i>
                </div>
            </div>
            <div>
                <img src="assets/img/1.jpg" alt="Image 1">
            </div>
        </div>
    </div>
    <div class="employesAccueil ">

        <!-- Section 3 pour afficher les valeurs du viet vo dao   -->

        <h2 id="text3d" class=" mx-5 text-center p-4"> NOS VALEURS </h2> <!-- Affiche le message et le nombre de employes -->
        <div class="row mb-1 justify-content-center">
            <div class="card col-lg-3 col-6 text-center fw-bold bg-dark m-4">
                <i class="fa-solid fa-brain "></i>
                <h3  class=" text-green my-4 fw-bold  ">Innovation</h3>
                <p>Nous sommes à la pointe de la technologie, offrant des solutions logicielles modernes qui répondent aux besoins évolutifs de nos clients.</p>
            </div>
            <div class="card col-lg-3 col-6 text-center fw-bold bg-dark m-4">
                <i class="fa-solid fa-dumbbell "></i>
                <h3 class="text-green my-4 fw-bold ">Qualité</h3>
                <p>Nos produits sont rigoureusement testés et développés selon les normes les plus élevées, garantissant une performance fiable et une expérience utilisateur optimale.
                </p>
            </div>
            <div class=" card col-lg-3 col-6 text-center fw-bold bg-dark m-4">
                <i class="fa-solid fa-child-combatant"></i>
                <h3 class=" my-4 fw-bold  ">Accessibilité</h3>
                <p c>Nous croyons que la technologie doit être accessible à tous. Nos prix sont compétitifs et nous offrons des solutions pour toutes les tailles d'entreprises.
                </p>
            </div>
            <div class="card col-lg-3 col-6 text-center fw-bold bg-dark m-4">
                <i class="fa-solid fa-people-group"></i>
                <h3  class=" my-4 fw-bold  ">Satisfaction Client</h3>
                <p>La satisfaction de nos clients est notre priorité. Nous offrons un support client réactif et des solutions personnalisées pour répondre aux besoins spécifiques de chaque utilisateur.
                </p>
            </div>
            <div class="card col-lg-3 col-6 text-center fw-bold bg-dark m-4">


            
                <i class="fa-solid fa-face-grin-squint"></i>
                <h3  class=" my-4 fw-bold  ">Sécurité </h3>
                <p>Nous prenons la sécurité de vos données très au sérieux. Nos logiciels intègrent des mesures de sécurité avancées pour protéger vos informations sensibles.
                </p>
            </div>
            <div class="card col-lg-3 col-6 text-center fw-bold bg-dark m-4">
                <i class="fa-solid fa-calendar-days"></i>
                <h3 class=" my-4 fw-bold  "> Transparence </h3>
                <p>Nous croyons en la transparence avec nos clients. Les informations sur les prix, les fonctionnalités et les conditions de service sont claires et accessibles.
                </p>
            </div>
            <div class="card col-lg-3 col-6 text-center fw-bold bg-dark m-4">
                <i class="fa-solid fa-calendar-days"></i>
                <h3 class=" my-4 fw-bold  "> Personnalisation </h3>
                <p> Chaque entreprise est unique. Nous offrons des solutions personnalisables pour s'adapter parfaitement aux besoins spécifiques de nos clients.
                </p>
            </div>
            <div class="card col-lg-3 col-6 text-center fw-bold bg-dark m-4">
                <i class="fa-solid fa-calendar-days"></i>
                <h3 class=" my-4 fw-bold  "> Engagement Écologique </h3>
                <p> Nous nous engageons à réduire notre empreinte écologique en adoptant des pratiques durables dans notre processus de développement.
                </p>
            </div>            
            <div class="card col-lg-3 col-6 text-center fw-bold bg-dark m-4">
                <i class="fa-solid fa-calendar-days"></i>
                <h3 class=" my-4 fw-bold  "> Formation et Support </h3>
                <p> Nous offrons des ressources de formation et un support technique continu pour garantir que nos clients tirent le meilleur parti de nos produits.
                </p>
            </div>
        </div>
        <div class="row mb-1 justify-content-center">

            <!-- Section 4 pour afficher une video de démonstration du viet vo dao   -->

        <h2 id="text3d" class=" mx-5 my-3 text-center ">NOS EMPLOYES</h2>
            <?php echo $info; // Affiche les informations (alertes)
            foreach ($employes as $employe) { // Boucle à travers les employes
            ?>
                <div class="col-sm-12 col-md-6 col-lg-4 col-xxl-3">

                    <div class="card"> <!-- Affiche l'image du employe -->
                        <img src="<?= RACINE_SITE ?>assets/img/<?= $employe['image'] ?>" alt="image du employe">
                        <div class="card-body">
                        <img src="<?= RACINE_SITE ?>assets/img/<?= $employe['image'] ?>" alt="image de l' article" height="400"> <!-- Affiche l'image du article -->
                    <div class="card-body">
                        <h3><?= $employe['nom'] ?> <br> <?= $employe['prenom'] ?></h3> <!-- Affiche np  -->
                        
                         <!-- Affiche le matricule d l'employe -->
                        <p><span class="fw-bolder"> Fiche employé :</span><?= $employe['matricule']?></p>
                        <p> <?= $employe['email'] ?></p>
                        <p> <?= $employe['telephone'] ?></p>
                        <p> <?= $employe['ville'] ?></p>
                        <p> <?= $employe['situation'] ?></p>
                        <p> <?= $employe['nbreEnfants'] ?></p>
                        <p> <?= $employe['dateEmbauche'] ?></p> <!-- Lien pour voir plus de détails -->
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
        <?php
        if (empty($_GET)) { // Si aucun paramètre n'est passé dans l'URL  : on affiche le bouton que sur le rendu avec les 6 employes     
        ?>
            <div class="col-12 text-center mb-5 ">
                <a href="<?= RACINE_SITE ?>?action=voirPlus" class="btn btn-abonner fs-3">Voir plus d'employes</a>
            </div>

            <div class="row d-flex justify-content-evenly flex-wrap ">

                <!-- Section pour afficher les images qui illustrent le viet vo dao   -->

        <h2 id="text3d" class=" mx-5 text-center"> IMAGES DIVERSES </h2>
                <div class="col-lg-3 col-6">
                    <a href="">
                        <img src="assets/img/souplesse.jpg" alt="image qui represente la souplesse" class="img-fluid imgb" />
                    </a>
                </div>
                <div class="col-lg-3 col-6">
                    <a href=""> <img src="assets/img/viet23.jpg" alt="image qui represente l'eventail'" lass="img-fluid imgb" />
                    </a>
                </div>
                <div class="col-lg-3 c2ol-6">
                    <a href="">
                        <img src="assets/img/tai.jpg" alt="image qui represente la Tai Chi" class="img-fluid imgb" />
                    </a>
                </div>
                <div class="col-lg-3 col-6">
                    <a href="">
                        <img src="assets/img/photobaton.jpg" alt="image qui represente le baton" class="img-fluid imgb" />
                    </a>
                </div>
                <div class="col-lg-3 col-6">
                    <a href="">
                        <img src="assets/img/viet26.jpg" alt="image qui represente les batons" class="img-fluid imgb" />
                    </a>
                </div>
                
               
                
            </div>
        <?php
        }

        ?>
</main>
<?php

require_once "inc/footer.inc.php";
?>