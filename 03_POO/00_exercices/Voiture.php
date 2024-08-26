<?php
class Voiture {


    /**
     * La taille du réservoire de la voiture en litres
     *
     * @var integer
     */
    private int $tailleReservoireVoiture;

    /**
     *Quantité d'essence actuellement dans le réservoire de la voiture
     *
     * @var float
     */
    private float $nbLitresEssenceVoiture;


    /**
     * Constructeur de la classe Voiture
     *
     * @param integer $t
     * @param float $l
     */
    public function __construct(int $t, float $l) {

        $this->setTailleReservoireVoiture($t);
        $this->setNbLitreEssenceVoiture($l) ;

    }


    /**
     *Définir la quantité d'essence dans le réservoire de la voiture
     *
     * @param float $quantite
     * @return void
     */
    public function setNbLitreEssenceVoiture(float $quantite) :void{

        $this->nbLitresEssenceVoiture = $quantite;

    }

    /**
     * Définir la taille du réservoire de la voiture
     *
     * @param int $quantite
     * @return void
     */
    public function setTailleReservoireVoiture(int $taille) :void{

        $this->tailleReservoireVoiture = $taille;

    }




    /**
     * Méthode pour récupérer la taille du réservoire de la voiture
     *
     * @return integer
     */
    public function getTailleReservoireVoiture() :int{

        return $this->tailleReservoireVoiture;


    }


    /**
     * Méthode pour récupérer la quantité d'essence dans le réservoire de la voiture
     *
     * @return float
     */
    public function getNbLitreEssenceVoiture() :float{

        return $this->nbLitresEssenceVoiture;

    }






}