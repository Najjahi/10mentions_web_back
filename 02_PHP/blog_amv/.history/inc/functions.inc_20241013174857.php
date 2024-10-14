<?php

session_start();

//////////// Constante pour définir le chemin du site /////////////////////////////////////////////////////

//define("RACINE_SITE","/10MentionWeb/Evry_2024/02_php/blog_amv/" );
define("RACINE_SITE", "http://10mentions_web_back.local/02_PHP/blog_amv/");

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
#### Fonction pour transformer une chaine de caractére en tableau #############################

function stringToArray(string $string): array
{

    $array = explode('/', trim($string, '/'));
    return $array;
}
######################### Fonction pour la deconnexion ###################################

function logOut()
{

    if (isset($_GET['action']) && $_GET['action'] == "deconnexion") {

        unset($_SESSION['user']);
        header('location:' . RACINE_SITE . 'index.php');
    }
}
logOut();
##################################### Fonction pour la connexion à la BDD #############################

define("DBHOST", "localhost"); // constante de l'utlisateur de la BDD du serveur en local => root
define("DBUSER", "root"); // contante pour le mot de pase de serveur en local => pas de mot de passe
define("DBPASS", ""); // constante pour le nom de la BDD
define("DBNAME", "amv");

function connexionBdd()
{
    // $dsn = mysql:host=localhost;dbname=amv;charset=utf8;
    $dsn = "mysql:host=" . DBHOST . ";dbname=" . DBNAME . ";charset=utf8";

    try {
        $pdo = new PDO($dsn, DBUSER, DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  //le mode d'erreur de PDO sur Exception
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch (PDOException $e) {

        die("Erreur : " . $e->getMessage()); //le catch sera exécuté dès lors on aura un problème da le try
    }

    return $pdo;  //on récupère l'objet de la fonction 
}
################################# Création des tables  ###########################
function createTableCategories()
{ //Table catégories
    $cnx = connexionBdd();
    $sql = "CREATE TABLE IF NOT EXISTS categories (
                id_category INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                name VARCHAR(50) NOT NULL,
                description TEXT NULL
                )";
    $request = $cnx->exec($sql);
}
//createTableCategories();

function createTableArticles()
{ // Table farticles
    $cnx = connexionBdd();
    $sql = " CREATE TABLE IF NOT EXISTS articles (
                    id_article INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                    category_id INT(11) NOT NULL,
                    image VARCHAR(250) NOT NULL,
                    title VARCHAR(100) NOT NULL,
                    description TEXT NOT NULL,                    
                    dateCreation DATE NOT NULL,
                    dateModification DATE NOT NULL
                    )";

    $request = $cnx->exec($sql);
}
//createTableArticles();

function createTableUsers()
{
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
                city VARCHAR(50) NOT NULL,               
                role ENUM('ROLE_USER','ROLE_ADMIN') DEFAULT 'ROLE_USER'
             )";
    $request = $cnx->exec($sql);
}
//createTableUsers();

################################# Création des clés étrangères  ###########################

function foreignKey(string $tableF, string $keyF, string $tableP, string $keyP)
{

    $cnx = connexionBdd();
    $sql = "ALTER TABLE $tableF ADD FOREIGN KEY ($keyF) REFERENCES $tableP ($keyP)";
    //$sql ="ALTER TABLE articles ADD FOREIGN KEY (category_id) REFERENCES categories (id_category)";
    $request = $cnx->exec($sql);
}

//foreignKey('articles', 'category_id', 'categories', 'id_category');




// foreignKey('commentaires', 'user_id', 'users', 'id_user');

################################# Fonctons du CRUD pour les utilisateurs ###########################

function inscriptionUsers(string $lastName, string $firstName, string $pseudo, string $email,  string $phone, string $mdp, string $civility, string $birthday, string $city): void
{

    $data = [
        'firstName' => $firstName,
        'lastName' => $lastName,
        'pseudo' => $pseudo,
        'mdp' => $mdp,
        'email' => $email,
        'phone' => $phone,
        'civility' => $civility,
        'birthday' => $birthday,
        'city' => $city,
    ];

    foreach ($data as $key => $value) {  // echapper les données et les traiter contre les failles JS (XSS)

        $data[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        //$data['firstName'] = htmlspecialchars($fisrstName, ENT_QUOTES, 'UTF-8')
    }

    $cnx = connexionBdd();

    $sql = "INSERT INTO users (firstName, lastName, pseudo, mdp, email, phone, civility, birthday, city) VALUES ( :firstName, :lastName, :pseudo, :mdp, :email, :phone, :civility, :birthday, :city)";

    $request = $cnx->prepare($sql);
    $request->execute(array(

        ':firstName' => $data['firstName'],
        ':lastName' => $data['lastName'],
        ':pseudo' => $data['pseudo'],
        ':mdp' => $data['mdp'],
        ':email' => $data['email'],
        ':phone' => $data['phone'],
        ':civility' => $data['civility'],
        ':birthday' => $data['birthday'],
        ':city' => $data['city']
    ));
}

//////// Une fonction pour vérifier si un email existe dans la BDD  /////////////

function checkEmailUser(string $email): mixed
{

    $cnx = connexionBdd();
    $sql = "SELECT * FROM users WHERE email = :email";
    $request = $cnx->prepare($sql);
    $request->execute(array(

        ':email' => $email
    ));
    $result = $request->fetch(PDO::FETCH_ASSOC);

    return $result;
}
////////// Une fonction pour vérifier si le pseudo existe dans la BDD  /////////

function checkPseudoUser(string $pseudo): mixed
{

    $cnx = connexionBdd();
    $sql = "SELECT * FROM users WHERE pseudo = :pseudo";
    $request = $cnx->prepare($sql);
    $request->execute(array(

        ':pseudo' => $pseudo
    ));
    $result = $request->fetch(PDO::FETCH_ASSOC);

    return $result;
}

//// Une fonction pour vérifier un utilisateur dans la BDD  ///////////////

function checkUser(string $pseudo, string $email): mixed
{
    $cnx = connexionBdd();
    $sql = "SELECT * FROM users WHERE pseudo = :pseudo AND email = :email";
    $request = $cnx->prepare($sql);
    $request->execute(array(
        ":pseudo" => $pseudo,
        ":email" => $email
    ));
    $result = $request->fetch();

    return $result;
}
//////////  fonctions pour récupérer tout les utilisateurs //////////

function allUsers(): mixed
{
    $cnx = connexionBdd();
    $sql = "SELECT * FROM users";
    $request = $cnx->query($sql);
    $result = $request->fetchAll();

    return $result;
}

////////////////////////  fonction pour supprimer un utilisateur //////////

function deleteUser(int $id_user): void
{
    $cnx = connexionBdd();
    $sql = "DELETE FROM users WHERE id_user = :id_user";
    $request = $cnx->prepare($sql);
    $request->execute(array(

        ":id_user" => $id_user
    ));
}
////////////////  fonction pour modifier le rôle /////////////////////////////

function updateRole(string $role, int $id_user): void
{
    $cnx = connexionBdd();
    $sql = "UPDATE users SET role = :role  WHERE id_user = :id_user";
    $request = $cnx->prepare($sql);
    $request->execute(array(
        ":role" => $role,
        ":id_user" => $id_user
    ));
}

/////////////////  fonction pour récupérer un seul utilisateur /////////////////////

function showUser(int $id_user): mixed
{
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
///  fonction pour récupérer une seul catégorie /////////////////////

function showCategory(string $name): mixed
{

    $cnx = connexionBdd();
    $sql = "SELECT * FROM categories WHERE name = :name";
    $request = $cnx->prepare($sql);
    $request->execute(array(
        ":name" => $name
    ));
    $result = $request->fetch();
    return $result;
}

///  fonction pour afficher une catégorie via son id /////////////////////

function showCategoryViaId(int $id): mixed
{
    $cnx = connexionBdd();
    $sql = "SELECT * FROM categories WHERE id_category = :id";
    $request = $cnx->prepare($sql);
    $request->execute(array(
        ":id" => $id
    ));
    $result = $request->fetch();
    return $result;
}
///////////  fonction pour insérer une catégorie ///////////////////////////

function addCategory(string $nameCategory, string $description): void
{
    $pdo = connexionBdd();
    $sql = "INSERT INTO categories (name, description) VALUES (:name, :description)";
    $request = $pdo->prepare($sql);
    $request->execute(array(

        ':name' => $nameCategory,
        ':description' => $description
    ));
}
///////////////////// Une fonction pour récupérer toutes les catégories ////////////////////

function allCategories(): mixed
{
    $pdo = connexionBdd();
    $sql = "SELECT * FROM categories";
    $request = $pdo->query($sql);
    $result = $request->fetchAll();
    return $result;
}
//////////////// Une fonction pour supprimer une catégorie//////////////////

function deleteCategory(int $id): void
{
    $cnx = connexionBdd();
    $sql = "DELETE FROM categories WHERE id_category = :id";
    $request = $cnx->prepare($sql);
    $request->execute(array(
        ':id' => $id
    ));
}
//////////// Une fonction pour modifier une catégorie//////////////////////

function updateCategory(int $id, string $name, string $description): void
{

    $cnx = connexionBdd();
    $sql = "UPDATE categories  SET name = :name, description = :description WHERE id_category = :id";
    $request = $cnx->prepare($sql);
    $request->execute(array(

        ':id' => $id,
        ':name' => $name,
        ':description' => $description
    ));
}
################################# Fonctions du CRUD pour les articless ###########################

function addArticles(string $title, string $description, string $dateCreation, string $image, int $id_category)
{
    $cnx = connexionBdd();
    $data = [
        'title' => $title,
        'description' => $description,
        'dateCreation' => $dateCreation,
        'image' => $image,
        'category_id' => $id_category
    ];

    foreach ($data as $key => $value) {

        $data[$key] = htmlentities($value);
    }

    $sql = "INSERT INTO articles (title, image,  description,  dateCreation,   category_id) VALUES (:title,  :image,  :description,  :dateCreation, :category_id)";
    $request = $cnx->prepare($sql);
    $request->execute(array(
        ':title' => $data['title'],
        ':image' => $data['image'],
        ':description' => $data['description'],
        ':dateCreation' => $data['dateCreation'],
        ':category_id' => $data['category_id']

    ));
}

///////////////////////// Une fonction pour verifier l'existance d'un  article///////////////////

function verifArticle(string $titleArticle, string $dateCreation): mixed
{
    $cnx = connexionBdd();
    $sql = "SELECT * FROM articles WHERE title = :title AND dateCreation = :dateCreation";
    $request = $cnx->prepare($sql);
    $request->execute(array(
        ':title' => $titleArticle,
        ':dateCreation' => $dateCreation
    ));
    $result = $request->fetch();
    return $result;
}

///////////////////////// Une fonction pour récuperer tous les articles///////////////////
function allArticles(): mixed
{
    $cnx = connexionBdd();
    $sql = "SELECT * FROM articles"; // requête d'insertion que je stock dans une variable
    $request = $cnx->query($sql);
    $result = $request->fetchAll();
    return $result;
}
///////////////////////// Une fonction pour récuperer un article //////////////////////////////////////////////

function showArticleViaId(int $id)
{

    $cnx = connexionBdd();
    $sql = "SELECT * FROM articles WHERE id_article = :id ";
    $request = $cnx->prepare($sql);
    $request->execute(array(
        ':id' => $id
    ));
    $result = $request->fetch();
    return $result;
}
////////////////////////// Une fonction pour modifier un article //////////////////////////////////////////////

function updateArticles($image, $titleArticle, $description, $dateCreation, $dateModification, $id_category, $id_article): void
{
    $cnx = connexionBdd();
    $data = [
        'image' => $image,
        'titleArticle' => $titleArticle,
        'description' => $description,
        'dateCreation' => $dateCreation,
        'dateModification' => $dateModification,
        'category_id' => $id_category,
        'id_article' => $id_article
    ];

    foreach ($data as $key => $value) {

        $data[$key] = htmlentities($value);
    }

    $sql = "UPDATE articles SET image =  :image, title = :titleArticle,  description = :description, dateCreation = :dateCreation,  dateModification = :dateModification, category_id = :category_id WHERE id_article = :id_article"; // requête d'insertion que je stock dans une variable

    $request = $cnx->prepare($sql); // je prépare ma fonction et je l'exécute
    $request->execute(array(
        ':image' => $data['image'],
        ':titleArticle' => $data['titleArticle'],
        ':description' => $data['description'],
        ':dateCreation' => $data['dateCreation'],
        ':dateModification' => $data['dateModification'],
        ':category_id' => $data['category_id'],
        ':id_article' => $data['id_article']
    ));
}
///////////////////////// Une fonction pour supprimer un article //////////////////////////////////////////////

function deleteArticle(int $id): void
{

    $cnx = connexionBdd();
    $sql = "DELETE FROM articles WHERE id_article = :id_article ";
    $request = $cnx->prepare($sql);
    $request->execute(array(
        ':id_article' => $id
    ));
}

//////////////////////// Une fonction pour afficher les 6 derniers articles /////////////////////

function articleByDate(): mixed
{

    $cnx = connexionBdd();
    $sql = "SELECT * FROM articles ORDER BY dateCreation DESC LIMIT 6";
    $request = $cnx->query($sql); // querry parcequ on n'a pas de parametre définis
    $result = $request->fetchAll();
    return $result;
}
//////////////////////// Une fonction pour afficher les 6 derniers articles /////////////////////
function articlesByCategory($id): mixed
{

    $cnx = connexionBdd();
    $sql = "SELECT * FROM articles WHERE category_id = :id";
    $request = $cnx->prepare($sql);
    $request->execute(array(
        ':id' => $id
    ));
    $result = $request->fetchAll();
    return $result;
}

///////////////////// Une fonction pour creer la table commentaires/////////////

function createTableCommentaire()
{

    $cnx = connexionBdd();
    $sql = " CREATE TABLE IF NOT EXISTS commentaires (
         commentaire_id INT AUTO_INCREMENT PRIMARY KEY ,
         article_id INT NOT NULL,     
         commentaire TEXT,
         CONSTRAINT com_article FOREIGN KEY (article_id) REFERENCES articles(id_article)                
    )";
    $request = $cnx->exec($sql);
}
// createTableCommentaire();

/////////////////////// Une fonction pour ajouter commentaires/////////////////

function addCommentaire(int $article_id, int $commentaire_id)
{

    $cnx = connexionBdd();
    $sql = "INSERT INTO commentaires (article_id, commentaire_id) VALUES (:commentaire, :article_id, :commentaire_id)";
    $request = $cnx->prepare($sql);
    $request->execute(array(
        ':article_id' => $article_id,
        
        ':commentaire_id' => $commentaire_id

    ));
    
}

/////////////////////// Une fonction pour modifier la table commentaires/////////////////

// function updateCommentaire(int $article_id, string $commentaire):void
// {
//     $cnx = connexionBdd();
//     $sql = "UPDATE commentaires SET commentaire =:commentaire WHERE commentaire_id = :commentaire_id";
//     // $sql = "UPDATE categories  SET name = :name, description = :description WHERE id_category = :id";
//     $request = $cnx->prepare($sql);
//     $request->execute(array(
//         ':article_id' => $article_id,
//         ':commentaire' => $commentaire

//     ));
//     }
// updateCommentaire(5, 'salut');

function getArticleCommentaires(int $id_article)
{
    $cnx = connexionBdd();
    $sql = "SELECT * FROM commentaires WHERE article_id = :article_id";
    $request = $cnx->prepare($sql);
    $request->execute(array(
        ':article_id' => $id_article
    ));
    $result = $request->fetchAll();
    return $result;
}


