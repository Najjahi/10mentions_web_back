

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