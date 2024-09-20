<?php
require_once 'vendor/autoload.php';

//connection à la 
$db = new MongoDB\client("mongodb://localhost:27017"); // mongodb : use c'est le namespace 
