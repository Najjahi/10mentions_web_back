<?php
require_once 'vendor/autoload.php';

//connection à la bdd
$client = new MongoDB\client("mongodb://localhost:27017"); // mongodb : use c'est le namespace 

//selectionner la base de donnée et la collection

$database = $client->selectDatabase("school");

$collection = $database->se