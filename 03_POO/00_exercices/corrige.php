

<?php

/**
 * Classe Membre.
 *
 * Cette classe représente un membre avec un pseudo et un mot de passe.
 * Le pseudo doit contenir entre 1 et 15 caractères.
 */
class Membre
{
    /**
     * @var string $pseudo Le pseudo du membre.
     */
    private string $pseudo;

    /**
     * @var string $mdp Le mot de passe du membre.
     */
    private string $mdp;

    /**
     * Constructeur de la classe Membre.
     *
     * @param string $pseudo Le pseudo du membre.
     * @param string $mdp Le mot de passe du membre.
     * @throws Exception Si le pseudo ne respecte pas les conditions définies.
     */
    public function __construct(string $p, string $m)
    {
        $this->setPseudo($p);
        $this->mdp = $m;
    }

    /**
     * Définit le pseudo du membre.
     *
     * @param string $pseudo Le nouveau pseudo du membre.
     * @throws Exception Si le pseudo ne respecte pas les conditions définies.
     */
    public function setPseudo(string $p): void
    {
        if ((is_string($p)) &&(strlen($p) < 1 || strlen($p) > 15)) {
            throw new Exception("Le pseudo doit contenir entre 1 et 15 caractères.");
        }
        $this->pseudo = $p;
    }

    /**
     * Retourne le pseudo du membre.
     *
     * @return string Le pseudo du membre.
     */
    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    /**
     * Retourne le mot de passe du membre.
     *
     * @return string Le mot de passe du membre.
     */
    public function getMdp(): string
    {
        return $this->mdp;
    }

    /**
     * afficher les details
     *
     * @return void
     */
    public function afficherInfos() {
        echo "Pseudo : " . $this->getPseudo() . "<br>";
        echo "Mot de passe : " . $this->getMdp() . "<br>";
    }

}

// Exemple d'utilisation de la classe Membre

// Utilisation de la classe
try {
    $membre1 = new Membre("NAJAHE2024", "monMotDePasse");
    $membre1->afficherInfos();

    // Exemple avec un pseudo trop long
    $membre2 = new Membre("NAJAHE2024NAJAHE2024NAJAHE2024", "mdp");
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
<?php
class Media {
   
   /**
    * Le nom de la personne (prppriété protégée)
    *
    * @var string
    */
   protected string $titre;
  
   /**
    * Constructeur de la classe Personne
    *
    * @param string $t
    */
   public function __construct($t) {

       $this->titre = $t;
   }
       
   /**
     * Méthode protégée pour obtenir une description génétique 
     *
     * @return string
     */
   protected function affichetitre() :string{

       return " titre du livre est : {$this->titre}";
   
   }
}

class livre extends Media {

    /**
     * L'auteur du livre
     *
     * @var string
     */
    private string $auteur;


    public function __construct(string $titre, string $auteur) {
        parent::__construct($titre); // Appel du constructeur de la classe de base parente (personne) depuis la classe enfant
        $this->auteur= $auteur;
    }
    
    /**
     * Affiche les informations de l'etudiant, y compris le nomet l'âge
     *
     * @return string
     */
    public function afficheInfos() {

        return $this->affichetitre() . "\n auteur :\n" . $this->auteur;
    }
}

$livre1 = new livre("les misérables","VICTOR HUGO");

echo $livre1->afficheInfos();

