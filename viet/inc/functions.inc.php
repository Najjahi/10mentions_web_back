<!-- fichier qui contient les fonctions php à utuliser dans notre site -->
<?php

//  Déclaration du lancement de la session.
session_start();


////////////////////////////////////////// Constante pour définir le chemin du site /////////////////////////////////////////////////////

// constante qui définit les dossiers dans lesquels se situe le site pour pouvoir déterminer des chemins absolus à partir de localhost (on ne prends localhost). Ainsi nous écrivons tous les chemins (exp : src, href ) en absolu avec cette constante

// define("RACINE_SITE","/10MentionWeb/Evry_2024/02_php/site_cinema/" );
define("RACINE_SITE", "http://localhost/10mentions_web_back/viet/");




##################################### Fonction pour debuger #############################

function debug($var)
{
    echo '<pre class="border border-dark bg-light text-danger fw-bold w-50 p-5 mt-5">';
    var_dump($var);
    echo '</pre>';
}

##################################### Fonction d'alert #############################

function alert(string $contenu, string $class)
{
    return
        "<div class=\"alert alert-$class alert-dismissible fade show text-center w-50 m-auto mb-5\" role=\"alert\">
                $contenu
            <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
        </div>";
}

############## Fonction pour transformer une chaine de caractére en tableau #############################

function stringToArray(string $string ) :array{
    
    $array = explode('/', trim($string, '/')); // Je transforme ma châine de caractére en tableau et je supprime les / autour de la chaîne de caractére 
    return $array; // ma fonction retourne un tableau

}

##################################### Fonction pour la deconnexion ###################################

function logOut()
{

    if (isset($_GET['action']) && $_GET['action'] == "deconnexion") {

        unset($_SESSION['user']);
        header('location:'.RACINE_SITE.'index.php');
    }
}

logOut();



##################################### Fonction pour la connexion à la BDD #############################

// On vas utiliser l'extension PHP Data Objects (pdo), elle définit une excellente interface pour accéder à une base de données depuis PHP et d'exécuter des requêtes SQL .
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

define("DBNAME", "viet");



function connexionBdd()
{

    //DSN (Data Source Name)
    // $dsn = mysql:host=localhost;dbname=cinema;charset=utf8;
    $dsn = "mysql:host=" . DBHOST . ";dbname=" . DBNAME . ";charset=utf8";

    //Grâce à PDO on peut lever une exception (une erreur) si la connexion à la BDD ne se réalise pas(exp: suite à une faute au niveau du nom de la BDD) et par la suite si  cette erreur est capté on lui demande d'afficher une erreur

    try { // dans le try on vas instancier PDO, c'est créer un objet de la classe PDO (un élment de PDO)
        // avec la variable dsn et les constantes d'environnement

        $pdo = new PDO($dsn, DBUSER, DBPASS);
        // echo "je suis connectée";

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

function createTableCategories()
{

    $cnx = connexionBdd();

    $sql = "CREATE TABLE IF NOT EXISTS categories (
                id_category INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                beltColor VARCHAR(50) NOT NULL,
                capNumber int(2) NULL
                )";

    $request = $cnx->exec($sql);
}

// createTableCategories();

// Table films
function createTableAdherants()
{

    $cnx = connexionBdd();

    $sql = " CREATE TABLE IF NOT EXISTS Adherants (
                    id_adherant INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                    category_id INT(11) NOT NULL,
                    firstName VARCHAR(50),
                    lastName VARCHAR(50) NOT NULL, 
                    tutor VARCHAR(50) NOT NULL,                   
                    civility ENUM('fille', 'garçon') NOT NULL,
                    birthday date NOT NULL, 
                    rank VARCHAR(50) NOT NULL, 
                    phone VARCHAR(30) NOT NULL,                  
                    email VARCHAR(100) NOT NULL,
                    mdp VARCHAR(255) NOT NULL,                                       
                    adress VARCHAR(50) NOT NULL,
                    zip VARCHAR(50) NOT NULL,
                    city VARCHAR(50) NOT NULL,
                    country VARCHAR(50),
                    )";
    $request = $cnx->exec($sql);
}
//    createTableAdherants();

// Table users

function createTableUsers()
{

    $cnx = connexionBdd();

    $sql = " CREATE TABLE IF NOT EXISTS users (
                id_user INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                firstName VARCHAR(50),
                lastName VARCHAR(50) NOT NULL,
                civility ENUM('f', 'h') NOT NULL,
                birthday date NOT NULL,
                rank VARCHAR(50) NOT NULL,  
                phone VARCHAR(30) NOT NULL,              
                email VARCHAR(100) NOT NULL,
                mdp VARCHAR(255) NOT NULL,                                
                adress VARCHAR(50) NOT NULL,
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


function foreignKey(string $tableF, string $keyF, string $tableP, string $keyP)
{

    $cnx = connexionBdd();
    $sql = "ALTER TABLE $tableF ADD FOREIGN KEY ($keyF) REFERENCES $tableP ($keyP)";
    // $sql ="ALTER TABLE films ADD FOREIGN KEY (category_id) REFERENCES categories (id_category)";
    $request = $cnx->exec($sql);
}


// Création de la clé étrangère dans la table films
// foreignKey('adherants', 'category_id', 'categories', 'id_category');

################################# Fonctons du CRUD pour les utilisateurs ###########################


// Inscription

function inscriptionUsers(string $firstName, string $lastName, string $civility, string $birthday, string $rank, string $phone, string $email,  string $mdp,  string $addres, string $zip, string $city, string $country): void
{

    /* Les requêtes préparer sont préconisées si vous exécutez plusieurs fois la même requête. Ainsi vous évitez au SGBD de répéter toutes les phases analyse/ interpretation / exécution de la requête (gain de performance). Les requêtes préparées sont aussi utilisées pour nettoyer les données et se prémunir des injections de type SQL.

                    1- On prépare la requête
                    2- On lie le marqueur à la requête
                    3- On exécute la requête

            */

    // Créer un tableau associatif avec les noms des colonnes comme clés
    // Les noms des clés du tableau $data correspondent aux noms des colonnes dans la base de données.

    $data = [
        'firstName' => $firstName,
        'lastName' => $lastName,        
        'civility' => $civility,
        'birthday' => $birthday,
        'rank' => $rank,
        'phone' => $phone,        
        'email' => $email,
        'mdp' => $mdp,
        'addres' => $addres,
        'zip' => $zip,
        'city' => $city,
        'country' => $country
    ];

    // echapper les données et les traiter contre les failles JS (XSS)
    foreach ($data as $key => $value) {

        $data[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        // 1  -> $data['firstName'] = htmlspecialchars($fisrstName, ENT_QUOTES, 'UTF-8')
         /*
            htmlspecialchars est une fonction qui convertit les caractères spéciaux en entités HTML, cela est utilisé afin d'empêcher l'exécution de code HTML ou JavaScript : les attaques XSS (Cross-Site Scripting) injecté par un utilisateur malveillant en échappant les caractères HTML potentiellement dangereux . Par défaut, htmlspecialchars échappe les caractères suivants :

            & (ampersand) devient &amp;
            < (inférieur) devient &lt;
            > (supérieur) devient &gt;
            " (guillemet double) devient &quot;*/

        /*
            ENT_QUOTES : est une constante en PHP  qui convertit les guillemets simples et doubles.
                => ' (guillemet simple) devient &#039;
                'UTF-8' : Spécifie que l'encodage utilisé est UTF-8.
        */

    }


    $cnx = connexionBdd();

    // on prépare la requête
    $sql = "INSERT INTO users
            (firstName, lastName, civility, birthday, rank, phone, email,  mdp, addres, zip, city, country) VALUES (:firstName, :lastName, :civility, :birthday, :rank, :phone, :email,  :mdp, :addres, :zip, :city, :country)";

    $request = $cnx->prepare($sql); //prepare() est une méthode qui permet de préparer la requête sans l'exécuter. Elle contient un marqueur :firstName qui est vide et attend une valeur.
    // $requet est à cette ligne  encore un objet PDOstatement .
    $request->execute(array(
        // Le tableau associatif contient les valeurs échappées à insérer dans la base de données, associées aux paramètres nommés de la requête préparée.
        ':firstName' => $data['firstName'],
        ':lastName' => $data['lastName'],
        ':civility' => $data['civility'],
        ':birthday' => $data['birthday'],
        ':rank' => $data['rank'],
        ':phone' => $data['phone'],        
        ':email' => $data['email'],
        ':mdp' => $data['mdp'],            
        ':addres' => $data['addres'],
        ':zip' => $data['zip'],
        ':city' => $data['city'],
        ':country' => $data['country'],
    ));

    // execute() permet d'exécuter toute la requête préparée avec prepare().

}

/////////// Une fonction pour vérifier si un email existe dans la BDD  ///////////////////////


function checkEmailUser(string $email): mixed
{

    $cnx = connexionBdd();
    $sql = "SELECT * FROM users WHERE email = :email";
    $request = $cnx->prepare($sql);
    $request->execute(array(

        ':email' => $email
    ));
    $result = $request->fetch(PDO::FETCH_ASSOC); //Le paramètre  PDO::FETCH_ASSOC permet de transformer l'objet en un array ASSOCIATIF.On y trouve en indices le nom des champs de la requête SQL.
    /**
     * Pour information, on peut mettre dans les parenthéses de fecth()
     * PDO::FETCH_NUM pour obtenir un tableau aux indices numèrique
     * PDO::FETCH_OBJ pour obtenir un dernier objet
     * ou encore des () vides pour obtenir un mélange de tableau associatif et indéxé
     */

    return $result;
}

////////// fonction pour vérifier si le grade existe dans la BDD  ///////////////////////


function checkrankAdherant(string $rank): mixed
{

    $cnx = connexionBdd();
    $sql = "SELECT * FROM adherants WHERE rank = :rank";
    $request = $cnx->prepare($sql);
    $request->execute(array(

        ':rank' => $rank
    ));
    $result = $request->fetch(PDO::FETCH_ASSOC); // On peut éviter de mettre cette constante comme paramètre de la mèthode fetch() à chaque fois en la définissant dans la connexion de la BDD par défaut (dans le try de la connexion à la BDD -> voir fonction connexionBdd())

    return $result;
}



///////////////////////////////// Une fonction pour vérifier un utilisateur dans la BDD  ////////

function checkUser(string $lastName, string $email): mixed
{
    $cnx = connexionBdd();
    $sql = "SELECT * FROM users WHERE lastName = :lastName AND email = :email";
    $request = $cnx->prepare($sql);
    $request->execute(array(
        ":lastName" => $lastName,
        ":email" => $email
    ));
    $result = $request->fetch();

    return $result;
}
//////////////////////  fonctions pour récupérer tout les utilisateurs ////////////////////////////////////

function allUsers(): mixed
{

    $cnx = connexionBdd();
    $sql = "SELECT * FROM users";
    $request = $cnx->query($sql);
    $result = $request->fetchAll(); // fetchAll() récupère touS les résultats dans la reqûête et les sort sous forme d'un tableau à 2 dismensions

    return $result;
}

///////////////////////////////////////////  fonction pour supprimer un utilisateur ///////

function deleteUser(int $id_user): void
{

    $cnx = connexionBdd();
    $sql = "DELETE FROM users WHERE id_user = :id_user";
    $request = $cnx->prepare($sql);
    $request->execute(array(

        ":id_user" => $id_user
    ));
}

/////////////////  fonction pour modifier le rôle //////////////////////////////////////////


function updateRole(string $role, int $id_user): void {

    $cnx = connexionBdd();
    $sql = "UPDATE users SET role = :role  WHERE id_user = :id_user";
    $request = $cnx->prepare($sql);
    $request->execute(array(
        ":role" => $role,
        ":id_user" => $id_user
    ));
}

/////////////////  fonction pour récupérer un seul utilisateur //////////////////////////////////////////


function showUser(int $id_user) :mixed {

    $cnx = connexionBdd();
    $sql = "SELECT * FROM users WHERE id_user = :id_user";
    $request = $cnx->prepare($sql);
    $request->execute(array(
        ":id_user" => $id_user
    ));
    $result = $request->fetch();
    return $result;
}

################################# Fonctions du CRUD pour les catégories ###########################

///////////  fonction pour récupérer une seul catégorie //////////////////////////////


function showCategory(string $beltColor) :mixed{

    $cnx = connexionBdd();
    $sql = "SELECT * FROM categories WHERE beltColor = :beltColor";
    $request = $cnx->prepare($sql);
    $request->execute(array(
        ":beltColor" => $beltColor
    ));
    $result = $request->fetch();
    return $result;

}


function showCategoryViaId(int $id) :mixed{

    $cnx = connexionBdd();
    $sql = "SELECT * FROM categories WHERE id_category = :id";
    $request = $cnx->prepare($sql);
    $request->execute(array(
        ":id" => $id
    ));
    $result = $request->fetch();
    return $result;

}

///////////////////////  fonction pour insérer une catégorie /////////////////////
function addCategory(string $beltColor, int $capNumber) : void {

    $pdo = connexionBdd();
    $sql= "INSERT INTO categories (beltColor, capNumber) VALUES (:beltColor, :capNumber)"; // requête d'insertion que je stock dans une variable
    $request = $pdo->prepare($sql); // je prépare ma fonction et je l'exécute
    $request->execute(array(

            ':beltColor' => $beltColor,
            ':cap' => $capNumber
    ));

}

///////////////////////////// Une fonction pour récupérer toutes les catégories //////////////

function allCategories() : mixed{

    $pdo = connexionBdd();
    $sql= "SELECT * FROM categories"; // requête d'insertion que je stock dans une variable
    $request = $pdo->query($sql);
    $result = $request->fetchAll();// j'utilise fetchAll() pour récupérer toute les ligne à la fois
    return $result; // ma fonction retourne un tableau ave les données récupérer de la BDD
}

//////////////////////////////////////// Une fonction pour supprimer une catégorie//////////////////////////////////////////////

function deleteCategory(int $id) :void {

    $cnx= connexionBdd();
    $sql = "DELETE FROM categories WHERE id_category = :id";
    $request = $cnx->prepare($sql);
    $request->execute(array(
        ':id' => $id
    ));


}

//////////////////////////////// Une fonction pour modifier une catégorie////////////

function updateCategory(int $id, string $beltColor, string $capNumber) :void {

    $cnx = connexionBdd();
    $sql = "UPDATE categories  SET name = :name, capNumber = :capNumber WHERE id_category = :id";
    $request = $cnx->prepare($sql);
    $request->execute(array(

        ':id' => $id,
        ':beltColor' => $beltColor,
        ':capNumber' => $capNumber
    ));


}

################################# Fonctions du CRUD pour les films ###########################

///////////////  fonction pour insérer un film //////////////////////////////////////////

function addAdherant(int $category_id, string $firstName, string $lastName, string $tutor, string $civility, string $birthday, string $rank, string $phone, string $email,  string $mdp,  string $addres, string $zip, string $city, string $country ) {

    $cnx = connexionBdd();

    $data = [
                    'category_id' => $category_id,
                    'firstName' => $firstName,
                    'lastName' => $lastName,
                    'tutor' => $tutor,          
                    'civility'  =>$civility ,
                    'birthday' => $birthday,
                    'rank' => $rank,
                    'phone'  => $phone,                 
                    'email'  => $email,
                    'mdp'   => $mdp,                                  
                    'adress'  => $addres,
                    'zip'  => $zip,
                    'city'  => $city,
                    'country'  => $country
            ];

    // echapper les données et les traiter contre les failles JS (XSS)
    foreach ($data as $key => $value) {

        $data[$key] = htmlentities($value);

    }

    $sql= "INSERT INTO adherants (title,  director,  actors,  ageLimit,  duration,  synopsis,  date,  price, stock, image, category_id) VALUES (:title,  :director,  :actors,  :ageLimit,  :duration,  :synopsis,  :date,  :price, :stock,  :image, :category_id)"; // requête d'insertion que je stock dans une variable
    $request = $cnx->prepare($sql); // je prépare ma fonction et je l'exécute
    $request->execute(array(
       ':title' => $data['title'],
       ':director' => $data['director'],
       ':actors' => $data['actors'],
       ':ageLimit' => $data['ageLimit'],
       ':duration' => $data['duration'],
       ':synopsis' => $data['synopsis'],
       ':date' => $data['date'],
       ':price' => $data['price'],
       ':stock' => $data['stock'],
       ':image' => $data['image'],
       ':category_id'=>$data['category_id']

    ));

}

///////////////////////// Une fonction pour verifier l'existance d'un  film///////////////////

function verifAdherant (string $titleFilm, string $dateSortie) : mixed {

    $cnx = connexionBdd();
    $sql= "SELECT * FROM films WHERE title = :title AND date = :date"; // requête d'insertion que je stock dans une variable
    $request = $cnx->prepare($sql);
    $request ->execute(array(
        ':title' => $titleFilm,
        ':date' => $dateSortie
    ));
    $result = $request->fetch();
    return $result; 
    

}

///////////////////////// Une fonction pour récuperer tous les films///////////////////
function allAdherants () : mixed {

    $cnx = connexionBdd();
    $sql= "SELECT * FROM films"; // requête d'insertion que je stock dans une variable
    $request = $cnx->query($sql);   
    $result = $request->fetchAll();
    return $result;     
}

///////////////////////// Une fonction pour récuperer un film //////////////////////////////////////////////

function showAdherantViaId(int $id){

    $cnx = connexionBdd();
    $sql= "SELECT * FROM films WHERE id_film = :id "; // requête d'insertion que je stock dans une variable
    $request = $cnx->prepare($sql);
    $request ->execute(array(
        ':id' => $id       
    ));
    $result = $request->fetch();
    return $result; 
}



////////////////////////// Une fonction pour modifier un film //////////////////////////////////////////////

   
function updateAdherant(string $title, string $director, string $actors, string $ageLimit, string $duration, string $synopsis, string $date, float $price, int $stock, string $image, int $id_category, int $idfilm ) : void {

    $cnx = connexionBdd();

    $data = [
        'title' => $title,
        'director' => $director,
        'actors' => $actors,
        'ageLimit' => $ageLimit,
        'duration' => $duration,
        'synopsis' => $synopsis,
        'date' => $date,
        'price' => $price,
        'stock' => $stock,
        'image'=> $image,
        'category_id' => $id_category,
        ':id' => $idfilm

    ];

    // echapper les données et les traiter contre les failles JS (XSS)
    foreach ($data as $key => $value) {

        $data[$key] = htmlentities($value);

    }

    $sql= "UPDATE adherants SET (title = :title,  director= :director,  actors = : actors,  ageLimit = : ageLimit,  duration = :duration,  synopsis =: synopsis,  date=:date,  price=:price, stock= : stock,  image =:image, category_id =:category_id ) WHERE id_film = :id_film)"; // requête d'insertion que je stock dans une variable
    $request = $cnx->prepare($sql); // je prépare ma fonction et je l'exécute
    $request->execute(array(
       ':title' => $data['title'],
       ':director' => $data['director'],
       ':actors' => $data['actors'],
       ':ageLimit' => $data['ageLimit'],
       ':duration' => $data['duration'],
       ':synopsis' => $data['synopsis'],
       ':date' => $data['date'],
       ':price' => $data['price'],
       ':stock' => $data['stock'],
       ':image' => $data['image'],
       ':category_id'=>$data['category_id'],
       ':id' => $data['id']

    ));

}

///////////////////////// Une fonction pour supprimer un film //////////////////////////////////////////////

function deleteAdherant(int $id) :void {

    $cnx= connexionBdd();
    $sql = "DELETE * FROM adherantss WHERE id_adherant = :id ";
    $request = $cnx->prepare($sql);
    $request->execute(array(
        ':id' => $id
    ));
    
}



?>