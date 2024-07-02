<!-- fichier qui contient les fonctions php à utuliser dans notre site -->
<?php

// Déclaration du lancement de la session

session_start();

############################constante pour definir le chemin du site #############################

 // constante qui définit les dossiers dans lesquels se situe le site pour pouvoir déterminer des chemins absolus à partir de localhost (on ne prends localhost). Ainsi nous écrivons tous les chemins (exp : src, href ) en absolu avec cette constante

//  define('RACINE_SITE',"http://localhost/10mentions_web_back/02_PHP/site_cinema/admin/gestion_film.php");
 define('RACINE_SITE',"http://10mentions_web_back.local/02_PHP/site_cinema/");


##################################### Fonction pour debuger #############################

function debug($var){
        echo '<pre class="border border-dark bg-light text-danger fw-bold w-50 p-5 mt-5">';
            var_dump($var);
        echo '</pre>';
}

##################################### Fonction d'alert #############################

function alert(string $contenu, string $class){
    return
        "<div class=\"alert alert-$class alert-dismissible fade show text-center w-50 m-auto mb-5\" role=\"alert\">
                $contenu
            <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
        </div>";
}

##################################### Fonction pour dla deconnexion #############################

function logOut() {

    if (isset($_GET['action']) && $_GET['action'] == 'deconnexion'){
       
        unset($_SESSION['user']);
        header('location:index.php');
       
    }


}
logOut();


##################################### Fonction pour la connexion à la BDD #############################

// On vas utiliser l'extension PHP Data Objects (PDO), elle définit une excellente interface pour accéder à une base de données depuis PHP et d'exécuter des requêtes SQL .
// Pour se connecter à la BDD avec PDO il faut créer une instance de cet Objet (PDO) qui représente une connexion à la base,  pour cela il faut se servir du constructeur de la classe
// Ce constructeur demande certains paramètres:
// On déclare des constantes d'environnement qui vont contenir les information à la connexion à la BDD

        // constante du serveur => localhost
        define("DBHOST", "localhost");

        // constante de l'utlisateur de la BDD du serveur en local => root

        define("DBUSER", "root");

        // contante pour le mot de pase de serveur en local => pas de mot de passe
        define("DBPASS", "");

        // constante pour le nom de la BDD

        define("DBNAME", "cinema");

    function connexionBdd() {

            //DSN (Data Source Name)
            // $dsn = mysql:host=localhost;dbname=cinema;charset=utf8;
            $dsn = "mysql:host=".DBHOST.";dbname=".DBNAME.";charset=utf8";

            //Grâce à PDO on peut lever une exception (une erreur) si la connexion à la BDD ne se réalise pas(exp: suite à une faute au niveau du nom de la BDD) et par la suite si  cette erreur est capté on lui demande d'afficher une erreur

            try {// dans le try on vas instancier PDO, c'est créer un objet de la classe PDO (un élment de PDO)
                // avec la variable dsn et les constantes d'environnement

                $pdo = new PDO($dsn, DBUSER, DBPASS);
                echo "je suis connectée";

                //On définit le mode d'erreur de PDO sur Exception
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);


            } catch (PDOException $e) {  // PDOException est une classe qui représente une erreur émise par PDO et $e c'est l'objetde la clase en question qui vas stocker cette erreur

                die("Erreur : " . $e->getMessage()); // die permet d'arrêter le PHP et d'afficher une erreur en utilisant la méthode getMessage de l'objet $e
            }

            //le catch sera exécuter dès lors on aura un problème da le try

            return $pdo;  //ici on utilise un return car on récupère l'objet de la fonction que l'on vas appelé  dans plusieurs autre fonctions
        }
        ################################# Création des tables  ###########################

    //Table catégories

        function createTableCategories(){

            $cnx = connexionBdd();

            $sql = "CREATE TABLE IF NOT EXISTS categories (
                id_category INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                name VARCHAR(50) NOT NULL,
                description TEXT NULL
                )";

                $request = $cnx->exec($sql);
        }

        // createTableCategories();

    // Table films
        function createTableFilms(){

            $cnx = connexionBdd();

            $sql = " CREATE TABLE IF NOT EXISTS films (
                    id_film INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                    category_id INT(11) NOT NULL,
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

    // Table users

     function createTableUsers(){

        $cnx = connexionBdd();

        $sql = " CREATE TABLE IF NOT EXISTS users (
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
        $request = $cnx->exec($sql);

    }
        //  createTableUsers();

        ################################# Création des clés étrangères  ###########################

        // ALTER TABLE ORDERS ADD FOREIGN KEY (Customer_SID) REFERENCES CUSTOMER (SID);

        // $tableF : table où on va créer la clé étrangère
        // $tableP : table à partir de laquelle on récupère la clé primaire
        // $keyF : la clé étrangère
        // $keyP :  la clé primaire

        function foreignKey( string $tableF, string $keyF, string $tableP, string $keyP) {

            $cnx = connexionBdd();
            $sql ="ALTER TABLE $tableF ADD FOREIGN KEY ($keyF) REFERENCES $tableP ($keyP)";
            // $sql ="ALTER TABLE films ADD FOREIGN KEY (category_id) REFERENCES categories (id_category)";
            $request = $cnx->exec($sql);
        }

        // Création de la clé étrangère dans la table films
        // foreignKey('films', 'category_id', 'categories', 'id_category');

        ################################# Fonctons du CRUD pour les utilisateurs ###########################

        // Inscription

function inscriptionUsers(string $lastName, string $firstName, string $pseudo, string $email,  string $phone, string $mdp, string $civility, string $birthday, string $address, string $zip, string $city, string $country) : void{

            /* Les requêtes préparer sont préconisées si vous exécutez plusieurs fois la même requête. Ainsi vous évitez au SGBD de répéter toutes les phases analyse/ interpretation / exécution de la requête (gain de performance). Les requêtes préparées sont aussi utilisées pour nettoyer les données et se prémunir des injections de type SQL.

                    1- On prépare la requête
                    2- On lie le marqueur à la requête
                    3- On exécute la requête
            */

            $cnx = connexionBdd();

            // on prépare la requête
            $sql = "INSERT INTO users
            (lastName, firstName, pseudo, email, phone, mdp, civility, birthday, address, zip, city, country) VALUES (:lastName, :firstName, :pseudo, :email, :phone, :mdp, :civility, :birthday, :address, :zip, :city, :country)";

            $request = $cnx->prepare($sql); //prepare() est une méthode qui permet de préparer la requête sans l'exécuter. Elle contient un marqueur :firstName qui est vide et attend une valeur.
            // $requet est à cette ligne  encore un objet PDOstatement .
            $request->execute(array(
                ":lastName" => $lastName,
                ":firstName" => $firstName,
                ":pseudo" => $pseudo,
                ":email" => $email,
                ":phone" => $phone,
                ":mdp" => $mdp,
                ":civility" => $civility,
                ":birthday" => $birthday,
                ":address" => $address,
                ":zip" => $zip,
                ":city" => $city,
                ":country" => $country
            )); // execute() permet d'exécuter toute la requête préparée avec prepare().

        }

////////////////////// Une fonction pour vérifier si un email existe dans la BDD  ////////////

function checkEmailUser(string $email) :mixed{

    $cnx = connexionBdd();
    $sql = "SELECT * FROM users WHERE email = :email"  ;
    $request= $cnx->prepare($sql);
    $request->execute(array(

        ':email' => $email
    ));
    $result = $request->fetch(PDO::FETCH_ASSOC);//Le paramètre  PDO::FETCH_ASSOC permet de transformer l'objet en un array ASSOCIATIF.On y trouve en indices le nom des champs de la requête SQL.
    /**
     * Pour information, on peut mettre dans les parenthéses de fecth()
     * PDO::FETCH_NUM pour obtenir un tableau aux indices numèrique
     * PDO::FETCH_OBJ pour obtenir un dernier objet
     * ou encore des () vides pour obtenir un mélange de tableau associatif et indéxé
     */

    return $result;
}

/////////////////////// Une fonction pour vérifier si le pseudo existe dans la BDD  ///////////

function checkPseudoUser(string $pseudo) :mixed{

    $cnx = connexionBdd();
    $sql = "SELECT * FROM users WHERE pseudo = :pseudo"  ;
    $request= $cnx->prepare($sql);
    $request->execute(array(

        ':pseudo' => $pseudo
    ));
    $result = $request->fetch(PDO::FETCH_ASSOC);// On peut éviter de mettre cette constanyte comme paramètre de la mèthode fetch() à chaque fois en la définissant dans la connexion de la BDD par défaut (dans le try de la connexion à la BDD -> voir fonction connexionBdd())
    return $result;
}

///////////////////////// Une fonction pour vérifier un utilisateur dans la BDD  /////////////////////

function checkUser(string $pseudo, string $email) : mixed{
    $cnx = connexionBdd();
    $sql = "SELECT * FROM users WHERE pseudo = :pseudo AND email =:email" ;
    $request= $cnx->prepare($sql);
    $request->execute(array(
        ':pseudo' => $pseudo,
        ':email' => $email

    ));
    $result = $request->fetch();
    return $result;
}
########## fonctions pour vérifier les utilisateurs #################################

function allUsers() :mixed{

    $cnx = connexionBdd();
    $sql = "SELECT * FROM users" ; 
    $request= $cnx->query($sql);     
    $result = $request->fetchAll(); // fetchAll() récupère tout les résultats dans la reqûête et les sort sous forme d'un tableau à 2 dismensions
    return $result;
    }

    ########## fonctions pour supprimer un utilisateur #################################
    function deleteUser(int $id_user):void {

        $cnx = connexionBdd();
        $sql = "DELETE FROM users WHERE id_user = :id_user"; 
        $request= $cnx->prepare($sql);     
        $result = $request->execute(array(
            "id_uses" => $id_user
        )); 
        
        }
    
    ?>

    