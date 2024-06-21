
    <?php 
    $title = "Cours PHP - Les conditions en PHP"; 
    $titre = "Introduction au PHP";
    $mpnparagraphe = null;
    include_once ("inc/header.inc.php"); 
    ?>
    <header class="p-5 m-4 bg-light rounded-3 border">
        <section class =" container py-5 "></section>
          <h1 class =" display-5 fw-bold"> Introduction au PHP</h1>
          <p class ="col-md-12 fs-4"> PHP: ce sigle est un achronyme récursif <span> Préprocesseur Hypertexte PHP</span> (PHP hypertext Processeur).Il s'agit d'un langage de script côté serveur open source utilisé pour le developpement web dynamique et peut être intégré dans des codes HTML, noter bien qu'un navigateur ne comprend pas le PHP </p>
 </header>
 
 <main class="container-fluid px-5">
    <div class="row">
        <div class="col-sm-12">
            <h2>La condition simple if else </h2>
            <?php
            $a = 10;
            $b = 5;
            $c = 2;
            
            if($a > $b){
              echo "<p class='alert alert-success'> a qui contient $a est strictement supérieur à b qui vaut $b</p>";
            }else{
              echo "<p class='alert alert-danger'< Non, c'est b($b) qui est supérieur à a ($a) </p>";
            }

             
            ?>
             <h2>La condition simple avec AND ou && </h2>
             <?php

            if($a > $b && $b > $c ){ //true
              echo "<p class='alert alert-success'> a qui contient $a est strictement supérieur à b qui vaut $b et b est strictement sppérieur à c qui vaut $c</p>";
            }else{
              echo "<p class='alert alert-danger'> l'une ou les deux conditions ne sont pas remplies</p>";
            }
            ?>
            <p>Comme en JS, la condition avec && attend forcément que chaque côté soit évalué à true et donc que les deux conditions renvoient vrai. Si l'une des deux est fausse, alors on ira au else s'il y en a un ou on affichera rien </p>

            <h2>La condition simple avec OR ou || </h2>
             <?php

            if($a == 9 || $b > $c ){ //true
              echo "<p class='alert alert-success'>une des deux conditions est vraie le code envoie true et le if s'execute</p>";
            }else{
              echo "<p class='alert alert-danger'> aucune conditions n'est vrai, c'est le else qui s'execute</p>";
            }
            ?>
              <p> au contraire lorsqu'on utilise OR ? || on attend qu'une seule des deux conditions soit vraie </P>
              <h2>Condition simple avec XOR </h2>
                <p>Alors que le OR s'exécute si une des conditons ou les deux conditions sont bonnes, XOR quant à lui ne s'exécute pas si les deux conditions sont bonnes ou si elles sont fausses. Seule l'une des deux conditions soit être bonne.</p>
            <?php

            if ($a == 10 XOR $b == 6 ){ //true
              echo "<p class='alert alert-success'>une des deux conditions est vraie le code envoie true et le if s'execute</p>";
            }else{
              echo "<p class='alert alert-danger'> aucune des conditions n'est vrai ou les deux conditions sont vrais, c'est le else qui s'execute</p>";
            }
           
            ?>

            <h2>Conditions multiples avec if, else if et else</h2>

            <p>Gràce a une conditon multiple, vérifiez dans un premierr temps si a est strictement égal à 8, dans un second temps si a est différent de 10 et enfin si aucune de ces condition n'est vrai</p>
            <?php

            if ($a === 8 ){ 
              echo "<p class='alert alert-success'> a est strictement égale à 8 </p>";
            }else if($a != 10){
              echo "<p class='alert alert-warning'> a est différent de 10 </p>";
            }else{
              echo "<p class='alert alert-danger'> a n'est pas égale à 8 et n'est pas différent de 10</p>";
            }
             
            ?>
            <?php
            // // Imaginons que votre code est de ce type :
            // $var = 1;
            // $var2 = 0;
            // if ( $var === 0 ) {
            //     echo $truc = true;
            // } elseif ( $var2 === 0 ) {
            //     echo  $truc = true;
            // } else {
            //     echo $truc = false;
            // }
            // // 6 lignes à écrire pour si peu ? Voici la version compactée :

            // $var = 1;
            // $var2 = 0;
            // $truc = (($var === 0)  ? true : ( $var2 === 0 )) ? true : false;
            
            // ?>

            // Et oui, en une ligne, j'utilise 2 fois l'opérateur ternaire pour faire comme un if-elseif-else.
            ?>
          <h2> Les Conditions ternaire</h2>
         <?php
            // la ternaire est une autre syntaxe pour écrire un if .. else
            $a = 11;
            echo ($a === 10) ? "\$a est égale à 10" : "\$a est différent de 10<br>"; // Dans le ternaire le "?" remplace le if et ":" remplace le else. Ainsi on dit : si $a est égale à 10, on affiche la premiére expression sinon la seconde.
            ?>
            <p>L'opérateur <span>==</span> permet de comparer une égalité de valeur, alors que l'opérateur  <span>===</span> permet de comparer de façon stricte et donc une comparaison en valeur et en type</p>

            <?php
                    $varA = 1; // integer
                    $varB = '1'; // string

                    // ==
                    if ($varA == $varB) { // la condition est vrai car en valeur 1 et '1' sont équivalents
                        echo "<p class=\"alert alert-success\"> \$varA  et \$varB sont égales en valeur</p>";
                    }else {
                        echo "<p class=\"alert alert-danger\"> \$varA  et \$varB ne sont pas égales en valeur</p>";
                    }

                    // ===
                    if ($varA === $varB) { // la condition est fausse car 1 et '1 sont différents en type
                        echo "<p class=\"alert alert-success\"> \$varA et \$varB sont égales en valeur et en type</p>";
                    }else {
                        echo "<p class=\"alert alert-danger\"> \$varA et \$varB sont égales en valeur mais pas en type  </p>";
                    }
                ?>
                
                <h2>Conditions avec l'opérateur combiné <=> </h2>
                <?php
                //$a = 11 
                //$b = 5
                echo ($a <=> $b); // afiche 1
                // je change  $b = 11
                echo '<br>';
                $b = 11 ;
                echo ($a <=> $b); // affiche  0
                echo '<br>';
                // je change $b =   
                $b = 12;
                echo ($a <=> $b);  // affiche -1
                echo '<br>';
                    /**
                     * Ici l'opérateur combiné compare à la fois le : inférieur, le égale et le supèrieur en retournant respectivement la valeur -1, 0 et 1 
                     *  <  ----> -1  si a < b (valeur de gauche est inférieure à la valeur de droite)
                     *  =  ---->  0  si a = b (valeur de gauche est égal à la valeur de droite)
                     *  >  ---->  1  si a > b (valeur de gauche est supérieure à la valeur de droite)
                     */

                    $a = 50;
                    $b = 29; 
                    echo gettype( $b);
                    
                    if(($a <=> $b) == -1){

                    echo "\$a est inférieur à \$b";

                    }else if(($a <=> $b) == 0) {

                    echo "\$a est égal à \$b";

                    } else if (($a <=> $b) == 1){

                    echo "\$a est supérieur à \$b";

                    }

                ?>
                <h2>Conditions avec switch </h2>
                <?php

                    
                    $langue = 'Chinois';

                    switch($langue){
                        case 'Français':
                            echo 'Bonjour !';
                        break ;
                        case 'Italien':
                            echo 'Ciao !';
                        break ;
                        case 'Espagnol':
                            echo 'Hola !';
                        break ;
                        default:
                            echo 'Hello !<br>';
                        break;
                    }
                
                // switch avec l'opérateur de combinaison

                switch ($a <=> $b) {
                    case -1 :  
                        echo 'a est plus petit que b';
                    break; // "break" est obligatoire pour quitter le witch une fois un "case " est exécuté
                    case 0 :
                        echo 'a est égal à b' ;
                    break;
                    case 1 :
                        echo 'a est plus grand que b';
                    break;
                    
                }
                ?>

            



            
          </div>
   </div>
     
   <?php include_once ("inc/footer.inc.php"); ?>