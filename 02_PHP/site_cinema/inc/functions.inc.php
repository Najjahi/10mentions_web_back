<!-- Fichier qui contient les fonctions php à utiliser dans notre site -->

<?php

################# fonction pour debeuger #######################

function debug($var) {

    echo '<pre class ="border border-dark bg-light text-primary w-50 p-3>',
    var_dump($var);    
    echo '<pre>';
}

################# fonctions de la connection à la BDD #######################

    // On vas utiliser l'extension PHP Data Objects (PDO), elle définit une excellente interface pour accéder à une base de données depuis PHP et d'exécuter des requêtes SQL .
    // Pour se connecter à la BDD avec PDO il faut créer une instance de cet Objet (PDO) qui représente une connexion à la base,  pour cela il faut se servir du constructeur de la classe
    // Ce constructeur demande certains paramètres:
    // On déclare des constantes d'environnement qui vont contenir les information à la connexion à la BDD

     // constante du serveur => localhost

     define("DBHOST","localhost");

    // constante de l'utilisateur de la BDD DU SERVEUR EN LOCAL => root

     define("DBUSER","root");
     
     // constante pour le mot de passe du serveur en local => pas de mot de passe

     define("DBPASS","");

     // constante pour le nom de la base de données

     define("DBNAME","cinema");

     function connexionBdd() {
        // $dsn =mysql:host=localhost;dbname=cinema;charset=utf8; (dsn= data source name)

        // $dsn = "mysql:host=". DBHOST . ";dbname=" . DBNAME . ";charset=utf8";
        
        $dsn ="mysql:host=".DBHOST.";dbname=".DBNAME.";charset=utf8";

        //Grâce à PDP on peut lever une exception (une erreur) si la connexion à la BDD ne se réalise pas(exp: suite à une faute au niveau du nom de la BDD) et par la suite si cette erreur est capté on lui demande d'afficher une erreur

        try { // dans le try on va instancier PDO, c'est créer un objet de la classe PDO (un élment de PDO)
            // Sans la variable dsn les constantes d'environnement

            $pdo = new PDO($dsn, DBUSER, DBPASS);
            echo "je suis connectée";


        } catch(PDOException $e) { // PDOException est une classe qui représente une erreur émise par PDO et $e c'est l'objet de la clase en question qui vas stocker cette erreur

            die("Erreur : ". $e->getMessage());   // die permet d'arrêter le PHP et d'afficher une erreur en utilisant la méthode getmessage de l'objet $e
        }
                   
        //le catch sera exécuter dès lors on aura un problème da le try

        return $pdo; //ici on utilise un retern car on récupère l'objet de la fonction que l'on va appelé dans plusieurs autre fonctions
    
        }

    //    connexionBdd();

        ######################## création des tables ################################

        // table categories

        function createTableCategories() {

            $cnx = connexionBdd();

            $sql = "CREATE TABLE IF NOT EXISTS categories 
            
                (id_category INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT, 
                name VARCHAR(50) NOT NULL,
                description TEXT NULL 
                )";

                $request = $cnx->exec($sql);

        }
            // createTableCategories();


        // table film

            function createTableFilms(){

                $cnx = connexionBdd();
      
                $sql = " CREATE TABLE IF NOT EXISTS films (
                     id_film INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                     category_id INT NOT NULL,
                     title VARCHAR(100) NOT NULL,
                     director VARCHAR(100) NOT NULL,
                     actors VARCHAR(100) NOT NULL,
                     ageLimit VARCHAR(5) NULL,
                     duration TIME NOT NULL,
                     synopsis TEXT NOT NULL,
                     date DATE NOT NULL,
                     image VARCHAR(250) NOT NULL,
                     price Float NOT NULL,
                     stock BIGINT NOT NULL
                     )";
                $request = $cnx ->exec($sql);
      
           }
        //    createTableFilms();

            // table Utilisateur

           function createTableUsers(){

            $pdo = connexionBdd();
  
            $sql = " CREATE TABLE users (
                 id_user INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                 firstName VARCHAR(50),
                 lastName VARCHAR(50) NOT NULL,
                 pseudo VARCHAR(50) NOT NULL,
                 mdp VARCHAR(255) NOT NULL,
                 email VARCHAR(100) NOT NULL,
                 phone VARCHAR(30) NOT NULL,
                 civility ENUM('f', 'h') NOT NULL,
                 birthday date NOT NULL,
                 address VARCHAR(50) NOT NULL,
                 zip VARCHAR(50) NOT NULL,
                 city VARCHAR(50) NOT NULL,
                 country VARCHAR(50),
                 role ENUM('ROLE_USER','ROLE_ADMIN') DEFAULT 'ROLE_USER' 
                 )";
            $request = $pdo ->exec($sql);
  
       }
  
        // createTableUsers();

        ######################## création des clés étrangéres ################################
        
        //ALTER TABLE ORDERS ADD FOREIGN KEY (Customer_SID) REFERENCES CUSTOMER (SID);

        // $tableF : table où on va creer la clé étrangére
        // $tablep : table a partir de laquelle on recupérer la clé primaire
        // $keyF : le clé etrangére
        // $keyP : le clé primaire

        function foreignkey(string $tableF, string $keyF, string $tableP, string $keyP) {

            $cnx = connexionBdd();
            $sql ="ALTER TABLE $tableF ADD FOREIGN KEY ($keyF) REFERENCES $tableP ($keyP)";            
            $request = $cnx->exec($sql);

        }

        // création de la clé étrangére (dans la table catégories) dans la table films
        //foreignkey('films', 'category_id', 'categories', 'id_category');

        ######################## fonctions du CRUD pour les utilisateurs #######################

        // inscription

        function inscriptionUsers(string $lastName, string $firstName, string $pseudo, string $email, string $phone, string $mdp, string $civility, string $birthday, string $address, string $zip, string $city, string $contry) {
            /* 
            Les requêtes préparer sont préconisées si vous exécutez plusieurs fois la même requête. Ainsi vous évitez au SGBD de répéter toutes les phases analyse/ interpretation / exécution de la requête (gain de performance). Les requêtes préparées sont aussi utilisées pour nettoyer les données et se prémunir des injections de type SQL.

                1- On prépare la requte
                2- on lie le marqueur à la requete
                3- on execute la requete
                */

            $cnx = connexionBdd();
            $sql = "INSERT INTO users
             (lastName, firstName, pseudo, email, phone, mdp, civility, birthday, address, zip, city, country) VALUES (:lastName, :firstName, :pseudo, :email, :phone, :mdp, :civility, :birthday, :address, :zip :city, :country) ";
             
             $request = $cnx->prepare ($sql); //prepare() est une méthode qui permet de préparer la requête sans l'exécuter. Elle contient un marqueur :nom qui est vide et attend une valeur.
            //$requet est à cette ligne  encore un objet PDOstatement.
            $request->execute(array(

                ":lastName"=> $lastName, 
                ":firstName"=> $firstName , 
                ":pseudo"=> $pseudo,
                ":email"=> $email, 
                ":phone"=> $phone , 
                ":mdp"=> $mdp , 
                ":civility"=> $civility, 
                ":birthday"=> $birthday , 
                ":address"=> $address, 
                ":zip "=> $zip,
                ":city"=> $city, 
                ":country"=> $contry
            ));
        }

              
   

?>
