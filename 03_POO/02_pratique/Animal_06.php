<?php

/**
* La visibilité protected est un niveau d'accès intermédiaire qui permet à une propriété ou une méthode d'être accessible uniquement :

    *À l'intérieur de la classe où elle est définie.
    *Dans les classes filles (sous-classes) qui héritent de cette classe.
*/
/**
 * Classe Animal
 *
 * Représente un animal générique avec un nom.
 */

 class Animal {
   
    /**
     * Le nom de l'animal (prppriété protégée)
     *
     * @var string
     */
    protected string $nom;
   
    /**
     * Constructeur de la classe Animal
     *
     * @param string $n
     */
    public function __construct($n) {

        $this->nom = $n;
    }
        
    /**
      * Méthode protégée pour obtenir une description génétique 
      *
      * @return string
      */
    protected function description() :string{

        return "ceci est un animal nommé {$this->nom}";
    }

    /**
     * Méthode protégée pour obtenir le nom de l'animal 
     *
     * @return void
     */
    public function getNom() {

        return $this->nom;
    }

}

/**
 * Classe Dog qui hérite de la classe Animal
 */
class Dog extends Animal { // Elle étend la classe Animal et hérute de ses propriétés et méthodes protégées


/**
 * Methode publique pour obtenir le son spécifique d'un chien
 *
 * @return void
 */    
public function affichage() :string {

    //accés à la propriété protégée $nom et à la méthode protégée description de la classe parente
    return $this->nom. "\ndit wouf!\n" .$this->description();
}

}

$chien = new Dog(" Djaba\n ");

echo $chien->getNom();

echo $chien->affichage();