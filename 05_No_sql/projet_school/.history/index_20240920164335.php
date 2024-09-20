<?php
require_once 'vendor/autoload.php';

//-----------C

//connection à la bdd
$client = new MongoDB\client("mongodb://localhost:27017"); // mongodb peut etre remplacé par use c'est le namespace 

//selectionner la base de donnée et la collection

$database = $client->selectDatabase("school");

$collection1 = $database->selectCollection('student');
$collection2 = $database->selectCollection('teachers');

//requête pour récuperer les données
$result = $collection1->find();
var_dump($result);
//grâce à des boucles foreach on pourra récupérer les informations et les afficher




