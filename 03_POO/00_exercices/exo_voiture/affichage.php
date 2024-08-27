<?php
require_once "../inc/function.inc.php";

require_once "voiture.php";
require_once "pompe.php";

$voiture = new Voiture(50 , 5);
$pompe = new Pompe(800 , 800);

//////////////////////Départ

// Voiture


echo "<p> Le réservoire de la voiture : {$voiture->getTailleReservoireVoiture()} litres, il y'a {$voiture->getNbLitreEssenceVoiture()} litres</p>";


//Pompe

echo "<p> La pompe contient {$pompe->getNbLitreEssencePompe()} litres, et sa contenance est de {$pompe->getTailleReservoirePompe()} litres  </p>";

// on passe à la pompe

echo $pompe->delivrerEssence($voiture);

// Aprés passage 

// Voiture


echo "<p> Le réservoire de la voiture : {$voiture->getTailleReservoireVoiture()} litres, il y'a {$voiture->getNbLitreEssenceVoiture()} litres</p>";


//Pompe

echo "<p> La pompe contient {$pompe->getNbLitreEssencePompe()} litres, et sa contenance est de {$pompe->getTailleReservoirePompe()} litres  </p>";

// on passe à la pompe

echo $pompe->delivrerEssence($voiture);




