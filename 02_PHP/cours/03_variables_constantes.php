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
            echo 'Le type de ma variable $double est : ' . gettype($double) . '<br>'; // ici il s'agit d'un double (nombre à virgule)            
            ####################"
            
            $chaine = 'une chaine de caractére entre simple quote';
            echo 'Ma variable $chaine $chaine vaut : ' . $chaine .'<br>';
            echo 'Le type de ma variable $chaine est : ' . gettype($chaine) . '<br>';// ici il s'agit d'un string
            
            ####################"
            $chaine1 = "Une chaine de caractére entre double quotes";
            echo 'Ma variable $chaine1 vaut :' .$chaine . '<br>';
            echo 'Le type de ma variable $chaine1 est : ' . gettype($chaine1) . '<br>';// ici il s'agit d'un string
            
            ####################"
            $chaine2 = "127";
            echo 'Ma variable $chaine2 vaut :' .$chaine2 . '<br>';
            echo 'Le type de ma variable $chaine2 est : ' . gettype($chaine2) . '<br>';// ici il s'agit d'un string
            
            ####################"
            $chaine3 = `Une chaine de caractére entre deux backquotes`;
            echo 'Ma variable $chaine3 vaut :' .$chaine3 . '<br>';
            echo 'Le type de ma variable $chaine3 est : ' . gettype($chaine3) . '<br>';// les backquotes en PHP (https://www.php.net/manual/fr/language.operators.execution.php)

            ####################"
            $chaine4 = `ls`;
            echo $chaine4 . '<br>';
            
            ####################"
            $boolean = true;  // ror false // le navigateur associe true à 1 et false à vide qui correspond à 0
            echo `Ma variable $boolean vaut :` . $boolean . '<br>';
            echo 'Le type de ma variable $boolean est : ' . gettype($boolean) . '<br>';// ici il s'agit d'un boolean : permet de savoir si quelque chose est vrai ou faux
            ####################"
            
            // La concaténation, affectation et affectation combinées avec l'opérateur ".=" pour les chaines de caractéres
            $prenom = 'Nicolat';
            $prenom .= ' Thomas';// on ajoute la valeur de 'Thomas' à la valeur de "Nicolas" sans le remplacer grâce à l'opérateur ".="
            //echo $prenom;
            echo '<p> Bonjour ' .$prenom .'</p>';
            echo "<p> Bonjour $prenom </p>" ; // affiche "Bonjour Nicolas Thomas" ici j'utilise les doubles quotes, je n'ai pas besoin de concaténer avec le point (.), dans les guillemets lavariable est évaluée : c'est qui est affiché , c'est ce qu on appelle la substitution de variable.
            ####################"
            // déclarer une chaine de caractére avec qui contient des apostrophes ex : aujourd'hui

            $message = 'aujourd\'hui'; // ici on échape les apostrophes quand on écrit dans les simples "\"
            $message = "aujourd'hui" ;

            //exercice : vous afficher bleu-blan-rouge en mettant le texte de chaque couleur dans les variables
            //correction
            $bleu ="bleu - " ;
            $vert ="vert - " ;
            $rouge ="rouge" ;
            
            echo "<p> La couleur de la police drapeau est : <span class ='text-primary'> $bleu </span><span class ='text-success'> $vert </span><span class ='text-danger'> $rouge </span> </p>" ; 
           
            //exercice : 
            // Créer un drapeau français Bleu Blanc Rouge avec le mot "bleu blanc rouge" à l'interieur de chaque couleur

        // Marc
            echo '<div class="container bg-black p-5 col-6 mx-auto">
             <div class="row">
                <div class="col bg-primary">Bleu</div>
                <div class="col bg-info">Blanc</div>
                 <div class="col bg-danger">Rouge</div>
             </div>
            </div>';

            // Axel
            $bleu1 = "Bleu - ";
            $vert1 = "Vert - ";
            $rouge1 = "Rouge";
            echo "<p class='bg-dark fw-bold col-3 p-4 mt-3'><span class='bg-primary py-3'>$bleu1</span><span class='bg-white py-3'>$vert1</span><span class='bg-danger py-3'>$rouge1</span></p>";

            // Correction
            $bleu2 = "blue";
            $blanc2 = "white";
            $rouge2 = "red";

            echo "<div class='d-flex justify-content-center bg-dark p-5 m-auto m-5 rounded' style='width: 40%;'>
                <div class='bg-primary text-center fw-bold' style='width: 50px; height: 80px; line-height: 80px'>
          $bleu2   </div>
                <div class='bg-$blanc2 text-center fw-bold' style='width: 50px; height: 80px; line-height: 80px'>
          $blanc2   </div>
                <div class='bg-danger text-center fw-bold' style='width: 50px; height: 80px; line-height: 80px'>
          $rouge2  </div>
         </div>";

            echo '<h2 class="mt-5">Opérateurs numériques</h2>';
            $a = 10;
            $b = 2;

            echo '$a + $b = ' . $a + $b . '<br>'; // affiche 12
            echo '$a - $b = ' . $a - $b . '<br>'; // affiche 8
            echo '$a * $b = ' . $a * $b . '<br>'; // affiche 20
            echo '$a / $b = ' . $a / $b . '<br>'; // affiche 5
            echo '$a % $b = ' . $a % $b . '<br>'; // affiche 0

            // Les opérateurs d'afféctation combiné pour les valeurs numériques
            $a -= $b; 
            echo $a;
            echo '<br>';

            $a += $b;
            echo $a;

            // il existe aussi les autres opérateurs "= ou /= ou %=
            ###########################

            // Incrémentation et décrémentation

            $i = 0;

            $i++;
            echo '<br>';
            echo $i;
            echo '<br>';
            $i --;
            echo $i;
            echo '<br>';
           
            $age = 18; 

            if ($age < 18) {
                echo "Vous êtes mineure.";
            } else {
                echo "Vous êtes majeure.";
            }

             // Substitution de variable

            /**
             * Si je veux afficher les contenu d'une variable et qu'elle soit collé à une chaine de caractère; ex: je veux afficher :
             * Aujourd'hui il fait 32°c !!
             *  ici le 32 et °c sont collés pour le faire en utilisant le mécanisme de substitution des variables il faut mettre  la variable entre accolades
             */
            $degre = 32;
            $phrase = '<p> Aujourd\'hui il fait ' . $degre . '°C !! </p>';
            echo $phrase;
            $phrase2 = "<p> Aujourd'hui il fait {$degre}°C !! </p>";
            echo $phrase2; 
            echo '<br>';

            echo '<h2 class="mt-5"> Transtypage des variables </h2>';
            $string1 = (int)'100';
            var_dump($string1); // affiche 100 avec type integer
            $string2 = (float)'12.5';
            var_dump($string2); // affiche 12.5 avec le type float
            $string3 = (int)'12.5';
            var_dump($string3); // affiche 12 avec le type integer

            echo "<br>";
            echo '<h2 class="mt-5" > Constante utilisateurs </h2>';

            # Avec la fonction prédéfinie define
            define('CHAINE', 'la valeur de la constante CHAINE');
            echo CHAINE .'<br>';

            define('ENTIER', 30);
            echo ENTIER . '<br>';
            echo "j'ai " . ENTIER . ' ans';
            echo "<br>";
            echo gettype(ENTIER);

            # constante Avec le mot résérvé cont
            const NB_SEMAINE = 52;
            const HEURE_HEBDOMADAIRE = 35;
            const NB_MOIS = 12;
            echo "<br>";

            //Le nombre d'heure mensuel sous la constante HEURE

            const HEURE_MENSUELLE = HEURE_HEBDOMADAIRE * NB_SEMAINE / NB_MOIS;
            echo HEURE_MENSUELLE;
            echo "<br>";

            echo '<h2 class="mt-5"> Les variables prédéfinies : super-globale </h2>';

            echo $_SERVER["HTTP_HOST"];
            echo '<pre>';
            var_dump($_SERVER);
            echo '</pre>';
            echo "<br>";
            //echo $_SERVER;

            var_dump($_SERVER);

            function dump($tableau) {
                echo '<pre>';
                var_dump($tableau);
                echo '</pre>';
            }
            echo "<br>";
            dump($_SERVER);




           

           





            

                      






            



            ?>
        </main>
        <footer>
    <div class="d-flex justify-content-evenly align-items-center bg-dark text-white p-3">
      <a class="nav-link" target="_blank" href="https://www.php.net/manual/fr/langref.php">Doc PHP</a>
      <a class="nav-link" href="01_index.php"><img src="assets/img/logo.png" alt="logo php"></a>
      <a class="nav-link" target="_blank" href="https://devdocs.io/php/">DevDocs</a>
    </div>
  </footer>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>


</html>