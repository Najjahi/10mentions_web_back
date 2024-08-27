<?php
namespace ExoEcommerce {

    use ExoEcommerce\Product;

    class Order {

        /**
         * L'identifiant de la commande
         *
         * @var string
         */
        private string $orderId;

        /**
         * Liste de produits dans la commande
         *
         * @var array
         */
        private array $produitList = [];

        /**
         * Constructeur de la classe Order
         *
         * @param integer $o
         */
        public function __construct(int $o)     {
           
            $this->orderId = $o;
        }

        /**
         * Get l'identifiant de la commande
         *
         * @return int
         */
        public function getOrderId() {
            return $this->orderId;
        }

        /**
         * get liste des produis dans la commande
         *
         * @return void
         */
        public function getProduitList() {

            return $this->produitList;
        }

        /**
         * Undocumented function
         *
         * @param $produit
         * @return
         */ 
        public function addProduct($produit)  {

            $this->produitList[] = $produit;
        }
    }
}