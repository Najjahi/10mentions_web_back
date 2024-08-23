<?php
require_once "../inc/function.inc.php";


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
        if ((!ctype_alpha($p)) || (strlen($p) < 1 || strlen($p) > 15)) {

            $this->pseudo = "le pseudo n'est pas valide";
            
        } else {

            $this->pseudo = $p;

        }
       
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


}

// Exemple d'utilisation de la classe Membre
$membre_1 = new Membre("", "monMotDePasse"); // on instancie la classe 
echo $membre_1->getPseudo();
//echo $membre_1->getMdp();


?>