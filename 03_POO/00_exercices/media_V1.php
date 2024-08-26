<?php

class Media
{

    /**
     * le titre du média.
     *
     * @var string
     */
    protected string $titre;

    /**
     * l'auteur ou le créateur du média.
     *
     * @var string
     */
    protected string $auteur;

    protected function __construct(string $t, string $a)
    {

        $this->titre = $t;
        $this->auteur = $a;

    }

    protected function afficheDetails() : string {
        return "le titre : {$this->titre}, l'auteur de la média {$this->auteur}";
    }
}

class Livre extends Media {

    /**
     * nombre de pages
     *
     * @var int
     */
    private int $nbPages;

    public function __construct(string $t, string $a, int $nb)
    {
        parent::__construct($t, $a); // :: operateur de resolution de portée
        $this->nbPages = $nb;

    }

    // public function getNbPage(){
    //     return $this->nbPages;
    // }

    public function afficherInfos(){

        return $this->afficheDetails(). ", nombre de pages: {$this->nbPages}";
    }

}
$livres1 = new Livre("le petit prince", "antoine de saint-exupery", 96);
echo $livres1->afficherInfos()."<br>";


class Dvd extends Media {

    /**
     *  duréé
     *
     * @var int
     */
    private int $duree;

    /**
     * le construct
     *
     * @param string $t
     * @param string $a
     * @param integer $d
     */
    public function __construct(string $t, string $a, int $d)
    {
        parent::__construct($t, $a);
        $this->duree = $d;

    }

    // public function getNbPage(){
    //     return $this->nbPages;
    // }

    public function afficherInfos(){

        return $this->afficheDetails(). " il dure: {$this->duree} minutes";
    }

}
$dvd1 = new Dvd("Inseption", "Christopher Nolan", 148);
echo $dvd1->afficherInfos()."<br>";