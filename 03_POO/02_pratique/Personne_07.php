<?php
class Personne {
   
   /**
    * Le nom de la personne (prppriété protégée)
    *
    * @var string
    */
   protected string $nom;
  
   /**
    * Constructeur de la classe Personne
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
   protected function afficheNom() :string{

       return "nom : {$this->nom}";
   
   }
}

class Etudiant extends Personne {

    /**
     * L'âge de l'étudiant
     *
     * @var integer
     */
    private int $age;

    /**
     * Undocumented function
     *
     * @param string $nom
     * @param integer $age
     */
    public function __construct(string $nom, int $age) {
        parent::__construct($nom); // Appel du constructeur de la classe de base parente (personne) depuis la classe enfant
        $this->age= $age;
    }
    
    /**
     * Affiche les informations de l'etudiant, y compris le nomet l'âge
     *
     * @return string
     */
    public function afficheInfos() {

        return $this->afficheNom() . "\n âge :\n" . $this->age;
    }
}

$etudiant1 = new Etudiant("Spartak",29);

echo $etudiant1->afficheInfos();

