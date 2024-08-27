<?php

namespace ExoEcommerce {

    class Product {

        /**
         * Le nom du produit
         *
         * @var string
         */
        private string $name;

        /**
         * Le prix du produit
         *
         * @var float
         */
        private float $price;

        /**
         * Méthode pour du constructeur 
         *
         * @param string $n
         * @param float $p
         */
        public function __construct(string $n, float $p)
        {
            $this->name = $n;
            $this->price = $p;
        }

        /**
         * Get le nom du produit
         *
         * @return  string
         */ 
        public function getName()
        {
                return $this->name;
        }

        /**
         * Get le prix du produit
         *
         * @return  float
         */ 
        public function getPrice()
        {
                return $this->price;
        }

    }












        

        
}