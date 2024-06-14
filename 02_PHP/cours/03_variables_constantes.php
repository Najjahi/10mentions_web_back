<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- lien css -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- googlefont -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@400;700&display=swap" rel="stylesheet">
    <title> Achronyme </title>
</head>

<body>
    
        <nav class="navbar navbar-expand-sm navbar-light bg-light  border-bottom border-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><img src="assets/img/logo.png" alt="logo"></a>
                <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="index.html">Acronyme</a>
                        </li>
                        <li class="nav- item">
                            <a class="nav-link" href="cours.html">cours</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="clause_sql.html">Les clauses SQL</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pratique_sql.html">Pratique SQL</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    
    <header class="cotainer-fluid px-5">
 <?php
            echo "<h1 class=\"display-5 fw-hold\">Les variables et les constantes en PHP</h1>";
            print "<h1 class=\"display-5 fw-hold\">Les variables et les constantes en PHP</h1>";
            ?>
    </header>

    <div class="container">
        <main>
           
            <?php
            echo "<h2> Les variables utilisateurs/ affectation / concaténation </h2>";
            $number = 127;// on déclare une variable $number et ol lui affecte la valeur 127
            echo 'Ma variable $number vaut : ' . $number . '<br>'; // je concaténe avec le point (.)
            //je peux voir le type d'une variable avec la fonction prédéfinie gettype()
            echo 'Le type de ma variable $number est : ' . gettype($number) . '<br>';// ici c'est integer
            ####################"
            $double =1.5;
            
            echo 'Ma variable $double vaut : ' . $double . '<br>'; 
           
            echo 'Le type de ma variable $double est : ' . gettype($double) . '<br>';// ici il s'agit d'un double (nombre à virgule)
            ?>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>


</html>