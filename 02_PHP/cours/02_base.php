<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/img/logo.png" type="favicon.ico">
    <title>Cours PHP - Introduction</title>
</head>
<body>
<nav class="navbar navbar-dark bg-dark navbar-expand-lg" >
    <div class="container-fluid">
      <a class="navbar-brand" href="01_index.php"><img src="assets/img/logo.png" alt="logo php"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link " aria-current="page" href="01_index.php">Introduction</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="02_bases.php">Les bases</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="03_variables_constantes.php">Les variables et les constantes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="04_conditions.php">Les conditions en PHP</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="05_boucles.php">Les boucles en PHP</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="06_inclusions.php">Les importations des fichier</a>
          </li>
        </ul>
       
      </div>
    </div>
  </nav>
 <header class="p-5 m-4 bg-light rounded-3 border">
    <section class =" container py-5 ">
    <h1 class =" display-5 fw-bold"> les bases de PHP    </h1>
    
    </section>
 </header>
 

 <main class="container-fluid px-5">
    <div class="row border p-5 mt-5">
        <div class="col-sm-12 col-md-6">
            <h2>1-les balises PHP</h2>
            <p>pour ouvrir un passage en PHP, on utilise la balise <span class="fw-bold"> <code>&lt;?php</code></span></p>
            <p>pour fermer un passage en PHP, on utilise la balise <span class="fw-bold"> <code>?></code></span></p>
        </div>
        <div class="col-sm-12 col-md-6"> 
            <h2>2 - les commentaires en php</h2>
            <p>pour faire un commentaire sur une ligne on utilise:</p>
            <ul>
                <li><em> // mon commentaire</em> </li>
                <li><em> # mon commentaire</em> </li>
                <?php

                // un premier commentaire
                # un deuxiéme commentaire

                ?>

                <p>pour faire des commentaires sur plusieurs lignes on utilise :</p>
                </ul>
                <ul>
                    <li>
                        <em>
                            /* <br>
                            mon commentaire <br>
                            sur  <br>
                            plusieurs <br>
                            lignes <br>
                            */
                        </em>
                    </li>
                </ul>
                <?php
    /*
    j'ecris un
     commentaire 
     sur plusieurs lignes 
     */

            ?>
            
        </div>
    </div>
   
  </main>

  <footer>
    <div class="d-flex justify-content-evenly align-items-center bg-dark text-white p-3">
      <a class="nav-link" target="_blank" href="https://www.php.net/manual/fr/langref.php">Doc PHP</a>
      <a class="nav-link" href="01_index.php"><img src="assets/img/logo.png" alt="logo php"></a>
      <a class="nav-link" target="_blank" href="https://devdocs.io/php/">DevDocs</a>
    </div>
  </footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


    
</body>
</html>