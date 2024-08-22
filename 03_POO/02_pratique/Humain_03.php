<?php
require_once "../inc/function.inc.php";

//GETTER et SETTER
/**
 * Une classe représentant un humain avec des propriétés privées pour le prénom et le nom
 * Les propriétés privées sonr accédées et modifiées via des méthodes publiques appellées getter et setter
 */

 class Humain {
    /**
     * Le prénom de l'humain
     * @var string
     */
    private string $prenom;


        /**
         * Le nom de l'humain
         *
         * @var string
         */
        private string $nom;

        /*
    Les propriétés étant 'private', il est nécessaire de passer par des méthodes 'publiques' pour pouvoir lire et écrire ces propriétés. ($this désigne l'objet courant à l'intérieur de la classe).
    On parle de Getter (lire / récupérer) et de Setter (écrire / définir) : ce sont des méthodes qui vont faire la médiation (l'intermédiaire) entre l'extérieur de la classe et ses attributs.
    
    */

    /**
     * définit le prénom de l'humain
     *
     * @param string $p
     * @return void
     */
    public function setPrenom(string $p) :void{// par convention, on appelle la fonction avec le mot-clé 'set'

        if (is_string($p)) { // si c'est une chaine de caractére je rentre dans la condition
            
            // mot clef $this est une "pseudo-variable" , elle va être remplacée par l'objet courrament utilisé. 
            // $this  est créer automatiquement et qui représente l'insctance courante

            $this->prenom = $p; // on assigne la valeur de $p à la propriété $prenom
        }

    }

    /**
     * récupére le prénom de l'humain
     *
     * @return string
     */
    public function getPrenom() : string { // par convention, on appelle la fonction avec le mot-clé 'get'

        return $this->prenom;
    }
 
 /**
     * définit le nom de l'humain
     *
     * @param string $n
     * @return void
     */
    public function setNom(string $n) :void {// par convention, on appelle la fonction avec le mot-clé 'set'

        if (is_string($n)) { // si c'est une chaine de caractére je rentre dans la condition
            
            // mot clef $this est une "pseudo-variable" , elle va être remplacée par l'objet courrament utilisé. 
            // $this  est créer automatiquement et qui représente l'insctance courante

            $this->nom = $n; // on assigne la valeur de $p à la propriété $prenom
        }

    }

    /**
     * récupére le prénom de l'humain
     *
     * @return string
     */
    public function getNom() : string { // par convention, on appelle la fonction avec le mot-clé 'get'

        return $this->nom;
    }
 
}

$personne_1 = new Humain();
//  $personne_1->prenom = "Imane";
//  echo $personne_1->prenom; // accés directe aux propriétées privées non autorisé

// utilisation de la méthode setPrenom() pour définir le prénom de l'humain
$personne_1->setPrenom("Imane") ."<br>";

// utilisation de la méthode getPrenom() pour récupérer et afficher le prénom de l'humain
echo $personne_1->getPrenom() ."<br>";


// utilisation de la méthode setPrenom() pour définir le prénom de l'humain
$personne_1->setNom("NAJJAHI") ."<br>"; 

// utilisation de la méthode getPrenom() pour récupérer et afficher le prénom de l'humain
echo $personne_1->getNom() ."<br>";

$personne_2 = new Humain();
//  $personne_1->prenom = "Imane";
//  echo $personne_1->prenom; // accés directe aux propriétées privées non autorisé

// utilisation de la méthode setPrenom() pour définir le prénom de l'humain
$personne_2->setPrenom("Sahar") ."<br>";

// utilisation de la méthode getPrenom() pour récupérer et afficher le prénom de l'humain
echo $personne_2->getPrenom() ."<br>";


// utilisation de la méthode setPrenom() pour définir le prénom de l'humain
$personne_2->setNom("FERCHICHI") ."<br>";

// utilisation de la méthode getPrenom() pour récupérer et afficher le prénom de l'humain
echo $personne_2->getNom() ."<br>";

echo "Bonjour je m'appelle {$personne_1->getPrenom()} {$personne_2->getNom()}";



