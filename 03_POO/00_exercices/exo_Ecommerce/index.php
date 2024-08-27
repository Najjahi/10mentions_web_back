<?php

require_once "Product.php";
require_once "Order.php";

// Importation de namespace
use ExoEcommerce\Product;
use ExoEcommerce\Order;

// Création des produits : instanciation de la classe Product

$produit1 = new ExoEcommerce\Product('Laptop', 1200); // Je peux utiliser cette syntaxe si je ne veux pas mettre des use dans mon fichier

$produit2 = new Product('Smartphone', 800); // Avec l'utilisation du mot clé use

$produit3 = new Product('Tablette', 1000);


// Création de la commande : instanciation de la classe Order

$order = new Order(45);


// ajout des produits à la commande
$order->addProduct($produit1);
$order->addProduct($produit2);
$order->addProduct($produit3);


// Affichage des informations de la commande
    // Id:

    echo "Id de la commande : {$order->getOrderId()} <br>";

    // Les produits dans la commande :

    // var_dump($order->getProduitListe());

    $toutLesProduit = $order->getProduitList();

    foreach ($toutLesProduit as $product) {
        echo "Le produit : {$product->getName()}, coûte : {$product->getPrice()} € <br>";
    }

