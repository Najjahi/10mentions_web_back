<?php


// Classe Média
class Media {

    protected string $titre;
    protected string $auteur;

    public function __construct(string $t, string $a)
    {

        $this->titre = $t;
        $this->auteur = $a;
    }

    protected function afficheDetails() :string{
         return "Letitre de la média : {$this->titre}, l'auteur de la média {$this->auteur}";
    }


}


class Livre extends Media {


    private int $nbPages;


    public function __construct(string $t, string $a, int $nb)
    {
        parent::__construct($t, $a);
        $this->nbPages = $nb;
    }


    public function  afficherInfos(){

        return parent::affichedetails(). " , Nombre de page : {$this->nbPages} pages";
    }
}

class Dvd extends Media {


    private int $duree;


    public function __construct(string $t, string $a, int $d)
    {
        parent::__construct($t, $a);
        $this->duree = $d;
    }


    public function  afficherInfos(){

        return parent::affichedetails(). " , Nombre de page : {$this->duree} pages";
    }
}


$livre1 = new Livre("Le petit Prince","Antoine de Saint-Exupéry", 96);
echo $livre1->afficherInfos() . "<br>";

$dvd = new Dvd("Inception", "Christopher Nolan", 148);
echo $dvd->afficherInfos();