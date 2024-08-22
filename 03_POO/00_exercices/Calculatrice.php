<?php
require_once "../inc/function.inc.php";

class Calculatrice {

    /**
     * Additionnner deux nombres
     *
     * @param integer $nb1
     * @param integer $nb2
     * @return integer la somme des deux nombres
     */
    public function additionner(int $nb1, int $nb2) :int {

        return $nb1 + $nb2;
    }
   
    public function diviser(float $nb1, float $nb2) :mixed{

        if ($nb2 == 0) {
            
            return "false";
        }

        return  $nb1 / $nb2;
    }
}

$calcul = new Calculatrice();
$addition = $calcul->additionner(10,2);
echo $addition ."<br>";

$division = $calcul->diviser(10,2);
echo $division ."<br>";

$division = $calcul->diviser(10,0);
echo $division ."<br>";
