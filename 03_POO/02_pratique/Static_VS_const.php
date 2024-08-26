<?php
class Statique {
    public static $count = 0; // Les propriétés statiques peuvent être modifiées après leur déclaration. Vous pouvez lire et écrire la valeur d'une propriété statique à tout moment

    public static function increment() {
        self::$count++;
    }
}

Statique::$count = 5; // Changement direct de la valeur de la propriété statique
Statique::increment(); // Incrémente la propriété statique
echo Statique::$count; // Affiche 6


class Constante {

    const PI = 3.14159; // Une fois définies, les constantes ne peuvent pas être modifiées
}

echo Constante::PI; // Affiche 3.14159
// Constante::PI = 3.14; // Erreur : impossible de modifier une constante