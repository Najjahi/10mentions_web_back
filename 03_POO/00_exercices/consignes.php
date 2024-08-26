<?php

//////////////////////////// Exercice 1 //////////////////////////////////////

/* 
    Créez une classe Calculatrice avec deux méthodes : additionner et diviser. 
    Vous devrez ajouter des commentaires de documentation 
    Méthode additionner :   La méthode doit retourner un int, qui est la somme des deux nombres.
    Méthode diviser : La méthode doit retourner un float si la division est possible. Si le diviseur est zéro, la méthode doit retourner false.
*/

//////////////////////////// Exercice 2  //////////////////////////////////////

/*
    Créez un objet $fruit_1 à partir de la classe Fruit avec les propriétés suivantes : "Fraise" pour le nom et "rouge" pour la couleur.
    Vous devrez ajouter des commentaires de documentation 
    La classe Fruit doit contenir les propriétés privées $nom et $couleur.
    La classe doit également inclure un constructeur pour initialiser ces propriétés.
    Affichez les valeurs des propriétés "Fraise" et "rouge" de l'objet $fruit_1 en utilisant un echo.
*/

//////////////////////////// Exercice 3  //////////////////////////////////////
/*
    Créez une classe Membre avec les propriétés privées pseudo et mdp.
    La propriété pseudo doit être une chaîne de caractères et doit respecter les conditions suivantes :
        - Contenir entre 1 et 15 caractères inclus.
    La propriété mdp représente le mot de passe associé au membre.
    afficher dans un echo les valeurs du pseudo et du mdp en respectant les contraintes définies.
*/

//////////////////////////// Exercice 4  //////////////////////////////////////

/*

 Vous allez créer une classe de base "Media" qui représente un média général dans la bibliothèque (par exemple, un livre, un CD, un DVD). Ensuite, vous allez créer des classes dérivées pour des types spécifiques de médias : Livre et DVD.


La classe Media doit avoir les propriétés protected suivantes :
$titre : le titre du média.
$auteur : l'auteur ou le créateur du média.
Ajoutez un constructeur qui initialise ces propriétés.
Ajoutez une méthode protected nommée afficherDetails() qui retourne une chaîne de caractères avec le titre et l'auteur.


Créez une classe Livre qui hérite de Media.
Ajoutez une propriété private pour le nombre de pages, $nbPages.
Ajoutez un constructeur pour initialiser le titre, l'auteur et le nombre de pages.
Ajoutez une méthode public nommée afficherInfos() qui utilise la méthode afficherDetails() de la classe Media et ajoute le nombre de pages.

Créez une classe DVD qui hérite également de Media.
Ajoutez une propriété private pour la durée du DVD en minutes, $duree.
Ajoutez un constructeur pour initialiser le titre, l'auteur et la durée.
Ajoutez une méthode public nommée afficherInfos() qui utilise la méthode afficherDetails() de la classe Media et ajoute la durée du DVD.

Instanciez des objets Livre et DVD et affichez leurs informations en utilisant les méthodes afficherInfos().


*/
