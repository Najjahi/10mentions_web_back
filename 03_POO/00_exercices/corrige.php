<?php

/**
 * Classe Calculatrice.
 *
 * Cette classe permet d'effectuer des opérations mathématiques de l'addition et la division.
 */
class Calculatrice {
    /**
     * Additionne deux nombres.     
     * @param float $a Le premier nombre à additionner.
     * @param float $b Le second nombre à additionner.
     * @return float Le résultat de l'addition de $a et $b.
     */
    public function additionner(float $a, float $b): float {
        return $a + $b;
    }

    /**
     * Divise un nombre par un autre.     
     * @param float $a Le nombre à diviser.
     * @param float $b Le nombre par lequel diviser.
     * @return float|bool Le résultat de la division de $a par $b, ou false si $b est égal à 0.
     */
    public function diviser(float $a, float $b) {
        if ($b == 0) {   // On ne peut pas diviser par zéro
            return false;
        }
        return $a / $b;
    }
}

// Exemple d'utilisation de la classe Calculatrice

$calc = new Calculatrice();
echo "<p> Le resutat de l'opération d'addition est : {$calc->additionner(10, 5)} </P>"   ; // Affiche 15
echo "\n";
echo "<p> Le resutat de l'opération de division est : {$calc->diviser(10, 5)} </P>" ;     // Affiche 2
echo "\n";
echo "<p> Le resutat de l'opération de division par zéro est : {$calc->diviser(10, 0)} </P>" ;     // Affiche false



?>
<?php

