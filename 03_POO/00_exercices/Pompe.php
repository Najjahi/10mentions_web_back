<?php
class Pompe {

    /**
     * La taille du reservoire de la voiture en litre
     *
     * @var integer
     */
    private int $tailleReservoirePompe;

   
   
    /**
     * Quantité d'essence actuellement dans le réservoire de la voiture
     *
     * @var float
     */
    private float $nbLitreEssencePompe;

    
    
    /**
     * Constructeur de la classe voiture
     *
     * @param integer $t
     * @param float $l
     */
    public function __construct(int $t, float $l) {
        
        $this->setTailleResrvoirePompe($t);
        $this->setNbLitreEssencePompe($l);
    }

    /**
     * Définir la quantité d'essence dans le réservoire de la voiture
     *
     * @param float $quantite
     * @return void
     */
    public function setNbLitreEssencePompe(float $quantite) :void {

        $this->nbLitreEssencePompe = $quantite;

    }

    /**
     * Définir la taille du réservoire de la voiture
     *
     * @param float $taille
     * @return void
     */
    public function setTailleResrvoirePompe(float $taille) :void {

        $this->tailleReservoirePompe = $taille;

    }
    
    /**
     * Méthode pour récupérer la taille du résérvoire de la voiture
     *
     * @return void
     */
    public function getTailleReservoirePompe() {
        return $this->nbLitreEssencePompe;
    }
    
    
    /**
     * Méthode pour récupérer la quantité d'essence dans le résérvoire de la voiture
     *
     * @return float
     */
    public function getNbLitreEssencePompe() :float{

        return $this->nbLitreEssencePompe;
    }

    /**
     * délivrer de l'ssence à une voiture
     *
     * @param Voiture $v
     * @return void
     */
    public function delivrerEssence(Voiture $v){

        $quantite_a_delivrer = $v->getTailleReservoireVoiture() - $v->getNbLitreEssenceVoiture();

        //Si la quantité à délivrer est supérieure à ce que la pompe a, ajuste la quantité à ce qui reste

        if($quantite_a_delivrer > $this->getNbLitreEssencePompe()){

            $quantite_a_delivrer > $this->getNbLitreEssencePompe();

        }


        // 1- Mettre à jour la quantité d'essence dans la voiture

        $v->setNbLitreEssenceVoiture($v->getNbLitreEssenceVoiture() + $quantite_a_delivrer);

        // 2- Mettre à jour la quantité d'essence restante dans la pompe

        $this->setNbLitreEssencePompe($this->getNbLitreEssencePompe() - $quantite_a_delivrer);

        // Retourne un message indiquant la quantité d'essence délivrée

        return "<p> Je viens de délivrer $quantite_a_delivrer litre(s) d'essence </p>";





    }
}