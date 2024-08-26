<?php

require_once "../inc/function.inc.php";

//--------------------------Méthodes et propriétés STATIQUE ------------------//

/*
     
    -- Le mot static pour définir et préciser que la propriété ou la méthode appartient  seulement à la classe dans laquelle elle a été définie ( => ne vont pas appartenir à une instance de classe et par la suite à un objet qui stocke cette instance).
    -- Les méthodes et les propriétés STATIQUES vont avoir la même définition et la même valeur pour toutes les instances d'une classe .
    -- On peut  accéder  à ces éléments sans avoir besoin d'instancier la classe .
    -- Depuis un objet Il est impossible d'accéder à une propriété statique.
     On utilise les propriété et méthode statique quand on a pas besoin d'instnacier la classe plusieurs fois et stocker cette instanciation dans des objets différents
     cela nous permettre de partager de données communes entre toutes les instances d'une classe, optimiser des ressources et économiser de la mémoire quand les données changent pas et qui  doivent être partagées entre toutes les instances
     Exemple l'utilisation de la connexion à la BDD     
     
 */

class Maison
{

    /**
     * La surface du terrain
     *
     * @var [type]
     */
    public static string $espaceTerrain = '500m²';


    /**
     * La couleur de la maison
     *
     * @var string
     */
    public $couleur = 'blanc';

    /**
     * hauteur de la maison
     * 
     * @var string
     */
    const HAUTEUR = "10m";

    /**
     * Nombre de piece dans la maison
     *
     * @var integer
     */
    private static $nbPiece = 7;

    /**
     * Nombre de porte dans la maison
     *
     * @var integer
     */
    private int $nbPorte = 10;

    public static function getNbPiece()
    {

        // Utilisation de self:: pour accéder à une propriété statique, il fait référence à la classe, contrairement à $this, qui fait référence à l'instance de l'objet. Pour accéder au propriétés statique on utilise l'opérateur
        //Les méthodes statiques peuvent accéder aux propriétés statiques via le mot-clé self.

        return self::$nbPiece; //lors d'un self:: il faut mettre le $ devant la propriété appelé 'opérateur de resolution de portée' (::)

    }

    public function getNbPorte()
    {

        return $this->nbPorte;
    }
}


// Appele a la propriété  $espace terrain de la class maison

// $maison1 = new Maison();// ce n'est pas obligatoire

echo "espace du terrain :" . Maison::$espaceTerrain . "<hr>"; // Appel d'une propriété static par classe


$maison2 = new Maison();

echo "nbPiece :" . Maison::getNbPiece() . "<hr>";

// appel à la propriété Couleur 

echo "couleur : " . $maison2->couleur . "<hr>";

echo "le nombre de portes : " . $maison2->getNbPorte() . "<hr>";

// appelle de la constante hauteur de la classe maison

echo " Hauteur de la maison : " . Maison::HAUTEUR . "<hr>";

// Les erreurs a ne pas faire

// echo "couleur :". Maison::$couleur . "<hr>"; non static
// echo "couleur :". Maison::getNbPorte() . "<hr>"; non static
// echo "nbPiece :". $maison2->getNbPiece() . "<hr>";// c'ette methode fonctione mais il ne faut pas la faire pour de bonne pratiques.

class Compteur
{

    /**
     * Total
     *
     * @var integer
     */
    public static $totalCount = 0;

    public function __construct() {

        self::$totalCount++;

    }
}

echo  Compteur::$totalCount . "<br>";
$objet1 = new Compteur();

echo  Compteur::$totalCount . "<br>";
$objet2 = new Compteur();

echo  Compteur::$totalCount . "<br>";
$objet3 = new Compteur();

// exemple de configuration de BDD

class ConfigurationBDD {

    public static $dbName = "nomBDD";
    public static $dbUser = "user";
    public static $dbPassword = "mdp";

}

echo ConfigurationBDD::$dbName . " ";
echo ConfigurationBDD::$dbUser. " ";
echo ConfigurationBDD::$dbPassword;

