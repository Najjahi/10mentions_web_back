<!doctype html>
<html lang="en">
    <head>        
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <!-- Bootstrap CSS v5.2.1 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"/>
        <link rel="stylesheet" href="assets/css/style.css">
        <title>Title</title>
    </head>
    <body>
        <header>
        $statut = 'connecté';
  ?>
  <nav class="navbar navbar-dark bg-dark navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php"><img class="w-25 img-fluid" src="../cours_Sahar/assets/img/logo.png" alt="logo php"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link " aria-current="page" href="index.php">Accueil</a>
          </li>
          <?php 
          if($statut == 'connecté'){
            ?>
            <li class="nav-item">
            <a class="nav-link" href="profil.php">Profil</a>
          </li>
          <?php 
        }else{ 
          ?>
          <li class="nav-item">
            <a class="nav-link" href="inscription.php">Inscription</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="connexion.php">Connexion</a>
          </li>
          <?php 
        }
         ?>
          
        </ul>
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="index.php">index</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"       aria-controls="navbarSupportedContent"        aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                    </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="inscription.php">Inscription</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="connexion.php">Connexion</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="profil.php">profil</a>
                    </li>
                </ul>
      
                </div>
              </div>
            </nav>
        </header>
        <main> <main class="container-fluid px-5">
        <div class="row">
            <div>

      <div>
            <h1 class="text-center text-danger">Bienvenue</h1>
        </div> 
        <main class="container-fluid px-5">
        <div class="row">
            <div>
        
        <?php
            $items = [
                [
                    "titre" => "piano",
                    "description" => "Ceci est un piano",
                    "photo" => "logo.png"
                ],
                [
                    "titre" => "pomme",
                    "description" => "Ceci est une pomme",
                    "photo" => "logo.png"
                ],
                [
                    "titre" => "stylo",
                    "description" => "Ceci est un stylo",
                    "photo" => "<img src=\"assets/img/logo.png\">"
                ]
            ];
            foreach ($items as $item) {
                echo '<div class="card">';
                echo '<h3>' .$item['titre']. '</h3>';
                echo '<p class="text-black">' .$item['description'].'</p>';
                echo '<img src="assets/img/' . $item["photo"] .'">';
                echo '</div>';
            }
            
            ?>

<div>
<div>
        </main>
        <footer>
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
