<?php

/*

    Les namespaces (ou espaces de noms) en PHP 
    Un namespace permet de regrouper un ensemble de classes, interfaces, fonctions et constantes sous un même "espace de noms", réduisant ainsi le risque de conflit de noms.
    On utilise les namespace afin :
        *  d'éviter les conflits de noms car  il est possible que deux classes ou fonctions aient le même nom. Les namespaces permettent de distinguer ces classes ou fonctions en les regroupant dans des espaces de noms différents.
        * Organiser le code :et lestructurer de manière logique, facilitant la maintenance et la compréhension.
    La déclaration d'un namespace se fait en utilisant le mot-clé namespace au début d'un fichier PHP
*/

// Exemple

namespace MonEspace {

    class MaClass {

        public function __construct() {

            echo "MaClasse dans le namespace MonEspace";
            
        }
    }
}