<?php

/**
 * Classe représentant un membre avec un pseudo et un mot de passe.
 */
class Membre {

    /**
     * Le pseudo du membre.
     * @var string
     */
    private string $pseudo;

    /**
     * Le mot de passe du membre.
     * @var string
     */
    private string $mdp;

    /**
     * Constructeur de la classe Membre.
     *
     * Initialise les propriétés pseudo et mdp en respectant les contraintes définies pour le pseudo.
     *
     * @param string $pseudo Le pseudo du membre, doit être une chaîne de caractères entre 1 et 15 caractères.
     * @param string $mdp Le mot de passe du membre.
     * @throws Exception Si le pseudo ne respecte pas les contraintes de longueur ou de type.
     */

     // L'annotation @throws Exception dans un commentaire de méthode PHP est utilisée pour indiquer que la méthode peut lancer une exception de type Exception
    public function __construct(string $pseudo, string $mdp) {
        $this->setPseudo($pseudo); // Initialise la propriété pseudo en utilisant le setter pour vérifier les contraintes.
        $this->mdp = $mdp; // Initialise la propriété mdp directement.
    }

    /**
     * Définit la propriété pseudo après validation.
     *
     * @param string $pseudo Le pseudo à définir.
     * @throws Exception Si le pseudo ne respecte pas les contraintes de longueur ou de type.
     */
    public function setPseudo(string $pseudo): void {
        if (is_string($pseudo) && strlen($pseudo) > 0 && strlen($pseudo) <= 15) {
            $this->pseudo = $pseudo; // Assigne le pseudo si toutes les contraintes sont respectées.
        } else {
            throw new Exception("Le pseudo doit être une chaîne de caractères entre 1 et 15 caractères."); // Lance une exception en cas de non-respect des contraintes.
        }
    }

    /**
     * Récupère la valeur du pseudo.
     *
     * @return string Le pseudo du membre.
     */
    public function getPseudo(): string {
        return $this->pseudo;
    }

    /**
     * Récupère la valeur du mot de passe.
     *
     * @return string Le mot de passe du membre.
     */
    public function getMdp(): string {
        return $this->mdp;
    }
}

// Création d'une instance de la classe Membre avec un pseudo et un mot de passe valides.
try {
    $membre = new Membre("JohnDoe", "password123");

    // Affichage des valeurs du pseudo et du mot de passe.
    echo "Pseudo : " . $membre->getPseudo() . "<br>";
    echo "Mot de passe : " . $membre->getMdp();
} catch (Exception $e) {
    // Gestion des erreurs en cas de non-respect des contraintes du pseudo.
    echo "Erreur : " . $e->getMessage();
}

?>