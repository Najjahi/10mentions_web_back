

    <?php 
    $title =  " cours PHP -les boucles en php"; 
    $titre = "Introduction au PHP";
    $mpnparagraphe = null;
    include_once ("inc/header.inc.php"); ?>
    <header class="p-5 m-4 bg-light rounded-3 border ">
        <section class="container py-5">
            <h1>Les boucles en PHP</h1>
            <p class="col-md-12 fs-4"> Les boucles (qu'on appelle aussi des structures itératives) sont un moyen de faire répéter plusieurs fois un même morceau de code. Une boucle est donc une répétition, comme on a pu le voir en JavaScript</p>
        </section>
    </header><!-- fin header -->
    <main class="container-fluid px-5">
        <div class="row">
            <div>
                <h2>La boucle while</h2>
                <p>La boucle est, comme en JS, une boucle qui permet d'exécuter un code TANT QUE la condition d'entrée est toujours remplie.</p>

                <?php
                    $a = 0; // Initialisation de la variable à 0 => valeur de départ de la boucle
                    while ($a < 5) { // on boucle tant que $a est strictement inférieur à 5

                        echo "<p>Tour n° $a</p>"; // Initialisation de la variable à 0 => valeur de départ de la boucle

                        $a++; // On incrément la valeur de la variable pour que la condition d'entrée devienne false à un moment donné
                    }

                    // Exercice :
                    // à l'aide d'une boucle while, vous affichez les années de 1920 à 2023 dans un menu déroulant.

                    // Kaïss
                    $annee = 1920;
                    echo "<form>
                            <select>";
                                while ($annee <= 2023) {
                                    echo "<option value='$annee'>$annee</option>";
                                    $annee++;
                                }
                    echo "  </select>
                        </form>";


                    // Exercice bonus: faire la même chose dnas l'autre sens, de 2023 à 1920
                    // Paul

                    $annee1 = 2023;
                    echo "<form>
                            <select>";
                                while ($annee1 >= 1920) {
                                    echo "<option value='$annee1'>$annee1</option>";
                                    $annee1--;
                                }
                    echo "  </select>
                        </form>";

                ?>

                <h2>La boucle do while</h2>
                            <p>cete boucle fonctionne avec la même instruction que la boucle <span>while</span>. Ce pendant ppour cette boucle, la condition est testée à la fin et pas au début</p>
                            <p>La boucle do while a la particularité de s'exécuter au mois une fois puis tant que la condition de fin est vraie</p>

                            <?php

                            $i = 0; // déclaration et initialisation de la variable : valeur de départ
                                do { // ici on exécute d'abord cette première partie avant même de regarder la condition
                                    $i++; // j'incrémente // 1
                                    echo "<p>$i</P>"; // j'affiche la valeur de $i
                                
                                }while($i > 100); // je donne la condition, si elle a déjà été rempli, mon scipt à cet endroit, sinon la boucle recommence jusqu'à ce que la condition soit remplie.
            ?>
            </div>
            <div class="col-sm-12 col-md-6">
            <h2>La boucle for</h2>
            <p>La boucle for , comme toutes les boucles, sert à répéter un morceau de code tant que la condition n'est pas respectée. Sa structure est cepenfdant différente :</p>
            <ol>
                <li><span>Initialisation de la variable</span></li>
                <li><span>Condition de sortie</span></li>
                <li><span>Incrémentation de la variable</span></li>
            </ol>
            <?php
                for ($i=0; $i <15 ; $i++) { // je lance ma boucle for avec les options citées au dessus 
                    echo "<p>Tour n° $i</p>"; // Dans les accolades, je précise le code à répéter
                }
                
            //Exercice : Créer en PHP un formaulaire de sélection de date de naissance (jour - mois - année)
            echo "Année :";
            $anneeForm = 2024;
                    echo "<form>
                            <select>";
                                while ($anneeForm >= 1920) {
                                    echo "<option value='$anneeForm'>$anneeForm</option>";
                                    $anneeForm--;// Décrémentation de la variable anneeForm afin que la condition d'entrée devienne "false" à un moment donné 
                                }
                    echo "  </select>
                        </form>";
            echo "Mois :";
            $mois = 1;
                    echo "<form>
                            <select>";
                                while ($mois <= 12) {
                                    echo "<option value='$mois'>$mois</option>";
                                    $mois++;
                                }
                    echo "  </select>
                        </form>";
            echo "Jour :";
            $jour = 1;
                    echo "<form>
                            <select>";
                                while ($jour <= 31) {
                                    echo "<option value='$jour'>$jour</option>";
                                    $jour++;
                                }
                    echo "  </select>
                        </form>";

            echo "<form><button>Submit</button></form>";
            
            // Cleid

            echo "<form>
                    <label for='jour'> Jour de naissance </label>
                    <select class='for-select' name='jour' id='jour'>";
                    for($i = 0; $i <= 31; $i++){
                        echo "<option value='$i'>$i</option>";
                    }
            echo "</select>";

            echo "<label for='mois'> mois de naissance </label>
                    <select class='for-select' name='mois' id='mois'>";
                    for($m = 0; $j < 12; $j++){
                        echo "<option value='$j'>$j</option>";
                    }
            echo "</select>";
           
            echo "<label for='mois'> Année de naissance </label>
                    <select class='for-select' name='annee' id='annee'>";
                    for($k = 1920; $k <= 2024; $k++){
                        echo "<option value='$k'>$k</option>";
                    }

              echo " </form>";
            
            // exercice : créer un tableau qui affiche 0 à 9 comme titre de colonne "colonne numéro"
            echo "<table class=\"table table-bordered mt-5\">
                <tr>";
                for ($i = 1; $i <= 10; $i++) {
                    echo "<td>Colonne numéro $i </td>";
                }
                echo      "</tr>
                <tr>";
                for ($i = 0; $i < 10; $i++) {
                    echo "<td> $i </td>";
                }
                echo     "</tr>
                </table>";
            ?>
            </div>
            
            <div class="col-sm-12 col-md-6 mt-5">
                <h2>La boucle foreach</h2>
                <p>La boucle foreach sert à parcourir un tableau (array() ou []). On verra cette boucle plus en détails dans la page dédiée aux array(). </p>

                <p class="alert alert-danger">Attention. Lorsque que vous faites une boucle, vérifiez votre condition de sortie ainsi que l'incrémentation de votre variable. Sans incrémentation, vous aurez une boucle infinie.</p>

                <p class="alert alert-secondary">A force d'utilier les boucles, il sera de plus en plus logique de choisir telle ou telle boucle pour tel ou tel usage. </p>
            </div>">A force d'utilier les boucles, il sera de plus en plus logique de choisir telle ou telle boucle pour tel ou tel usage. </p>

            
          </div>
        </div>
        <?php include_once ("inc/footer.inc.php"); ?>