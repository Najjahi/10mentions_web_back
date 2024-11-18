<?php

session_start();

//////////// Constante pour définir le chemin du site /////////////////////////////////////////////////////

//define("RACINE_SITE","/10MentionWeb/Evry_2024/02_php/blog_amv/" );
define("RACINE_SITE", "http://10mentions_web_back.local/02_PHP/site_employes/");

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
define("DBNAME", "ressources");

function connexionBdd()
{
    $dsn = "mysql:host=localhost;dbname=ressources;charset=utf8";
    //$dsn = "mysql:host=" . DBHOST . ";dbname=" . DBNAME . ";charset=utf8";

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
function createTableFiliales()
{ //Table Filiales
    $cnx = connexionBdd();
    $sql = "CREATE TABLE IF NOT EXISTS filiales  (
                id_filiale INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                name VARCHAR(50) NOT NULL,
                description TEXT NULL
                )";
    $request = $cnx->exec($sql);
}
//createTableFiliales();


function createTableEmployes()
{ //Table employes
    $cnx = connexionBdd();
    $sql = "CREATE TABLE IF NOT EXISTS employes (
                id_employe INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                image VARCHAR(255) NOT NULL, 
                nom VARCHAR(50) NOT NULL,
                prenom VARCHAR(50) NOT NULL,
                matricule VARCHAR(8) NOT NULL, 
                dateEmbauche DATE NOT NULL,
                email VARCHAR(100) NOT NULL, 
                phone VARCHAR(30) NOT NULL,  
                ville VARCHAR(100) NOT NULL,                
                filiale_id INT(11) NOT NULL
                )";
    $request = $cnx->exec($sql);
}
createTableEmployes();

function createTableBuletins()
{ // Table BuletinPaie
    $cnx = connexionBdd();
    $sql = " CREATE TABLE IF NOT EXISTS buletins (
                    id_buletin INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                    employe_id INT(11) NOT NULL,
                    mois VARCHAR(2) NOT NULL,
                    annee YEAR NOT NULL,
                    salaire_brut FLOAT NOT NULL,  
                    prime FLOAT NOT NULL,  
                    salaire_net FLOAT NOT NULL,                 
                    dateCreation DATE NOT NULL,
                    dateModification DATE NOT NULL
                    )";

    $request = $cnx->exec($sql);
}
//createTableBuletins();

function createTableUsers()
{
    $cnx = connexionBdd();
    $sql = " CREATE TABLE IF NOT EXISTS users (
    
                id_user INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
                image VARCHAR(255) NOT NULL, 
                nom VARCHAR(50) NOT NULL,
                prenom VARCHAR(50) NOT NULL,
                dateNaissance date NOT NULL, 
                matricule INT NOT NULL,
                email VARCHAR(100) NOT NULL,
                phone VARCHAR(30) NOT NULL,
                situation ENUM('C', 'M', 'D', 'V', 'P') NOT NULL, 
                nbreEnfants INT NOT NULL,                            
                ville VARCHAR(50) NOT NULL,
                dateEmbauche DATE NOT NULL,   
                mdp VARCHAR(100) NOT NULL, 
                filiale_id INT(11) NOT NULL,            
                role ENUM('ROLE_USER','ROLE_ADMIN') DEFAULT 'ROLE_USER'
             )";
    $request = $cnx->exec($sql);
}
//createTableUsers();

################################# Création des clés étrangères  ###########################

function foreignKey(string $users, string $filiale_id, string $filiales, string $id_filiale)
{
    $cnx = connexionBdd();
    $sql = "ALTER TABLE $users ADD FOREIGN KEY ($filiale_id) REFERENCES $filiales ($id_filiale)";
    // $sql ="ALTER TABLE films ADD FOREIGN KEY (category_id) REFERENCES categories (id_category)";
    $request = $cnx->exec($sql);
}

// Création de la clé étrangère dans la table films
//foreignKey('users', 'filiale_id', 'filiales', 'id_filiale');

################################# Fonctons du CRUD pour les utilisateurs ###########################

function inscriptionUsers(string $nom, string $prenom, string $dateNaissance, int $matricule, string $email,  string $phone, string $situation, int $nbreEnfants, string $ville, string $mdp): void
{

    $data = [
        'nom' => $nom,
        'prenom' => $prenom,
        'dateNaissance' => $dateNaissance,
        'matricule' => $matricule,
        'email' => $email,
        'phone' => $phone,
        'situation' => $situation,
        'nbreEnfants' => $nbreEnfants,
        'ville' => $ville,
        'mdp' => $mdp
    ];

    foreach ($data as $key => $value) {  // echapper les données et les traiter contre les failles JS (XSS)

        $data[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        //$data['firstName'] = htmlspecialchars($fisrstName, ENT_QUOTES, 'UTF-8')
    }

    $cnx = connexionBdd();

    $sql = "INSERT INTO users (nom, prenom, dateNaissance, matricule, email, phone, situation, nbreEnfants, ville, mdp) VALUES ( :nom, :prenom, :dateNaissance, :matricule, :email, :phone, :situation, :nbreEnfants, :ville, :mdp)";

    $request = $cnx->prepare($sql);
    $request->execute(array(

        ':nom' => $data['nom'],
        ':prenom' => $data['prenom'],
        ':dateNaissance' => $data['dateNaissance'],
        ':matricule' => $data['matricule'],
        ':email' => $data['email'],
        ':phone' => $data['phone'],
        ':situation' => $data['situation'],
        ':nbreEnfants' => $data['nbreEnfants'],
        ':ville' => $data['ville'],
        ':mdp' => $data['mdp']
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
////////// Une fonction pour vérifier si le matricule existe dans la BDD  /////////

function checkMleUser(string $matricule): mixed
{

    $cnx = connexionBdd();
    $sql = "SELECT * FROM users WHERE matricule = :matricule";
    $request = $cnx->prepare($sql);
    $request->execute(array(

        ':matricule' => $matricule
    ));
    $result = $request->fetch(PDO::FETCH_ASSOC);

    return $result;
}

//// Une fonction pour vérifier un utilisateur dans la BDD  ///////////////

function checkUser(string $matricule, string $email): mixed
{
    $cnx = connexionBdd();
    $sql = "SELECT * FROM users WHERE matricule = :matricule AND email = :email";
    $request = $cnx->prepare($sql);
    $request->execute(array(
        ":matricule" => $matricule,
        ":email" => $email
    ));
    $result = $request->fetch();

    return $result;
}
//////////  fonctions pour récupérer tous les utilisateurs //////////

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

function showFiliale(string $name): mixed
{
    $cnx = connexionBdd();
    $sql = "SELECT * FROM filiales WHERE name = :name";
    $request = $cnx->prepare($sql);
    $request->execute(array(
        ":name" => $name
    ));
    $result = $request->fetch();
    return $result;
}

///  fonction pour afficher une catégorie via son id /////////////////////

function showFilialeViaId(int $id): mixed
{
    $cnx = connexionBdd();
    $sql = "SELECT * FROM filiales WHERE id_filiale = :id";
    $request = $cnx->prepare($sql);
    $request->execute(array(
        ":id" => $id
    ));
    $result = $request->fetch();
    return $result;
}
///////////  fonction pour insérer une catégorie ///////////////////////////

function addFiliale(string $nameFiliale, string $description): void
{
    $pdo = connexionBdd();
    $sql = "INSERT INTO filiales (name, description) VALUES (:name, :description)";
    $request = $pdo->prepare($sql);
    $request->execute(array(

        ':name' => $nameFiliale,
        ':description' => $description
    ));
}
///////////////////// Une fonction pour récupérer toutes les catégories ////////////////////

function allFiliales(): mixed
{
    $pdo = connexionBdd();
    $sql = "SELECT * FROM filiales";
    $request = $pdo->query($sql);
    $result = $request->fetchAll();
    return $result;
}
//////////////// Une fonction pour supprimer une catégorie//////////////////

function deleteFiliale(int $id): void
{
    $cnx = connexionBdd();
    $sql = "DELETE FROM filiales WHERE id_filiale = :id";
    $request = $cnx->prepare($sql);
    $request->execute(array(
        ':id' => $id
    ));
}
//////////// Une fonction pour modifier une Filiale//////////////////////

function updateFiliale(int $id, string $name, string $description): void
{
    $cnx = connexionBdd();
    $sql = "UPDATE filiales  SET name = :name, description = :description WHERE id_filiale = :id";
    $request = $cnx->prepare($sql);
    $request->execute(array(

        ':id' => $id,
        ':name' => $name,
        ':description' => $description
    ));
}
################################# Fonctions du CRUD pour les employes #############

function addEmployes(string $image, string $nom, string $prenom, string $matricule, string $email, string $phone, string $ville, string $dateEmbauche, int $filiale_id)
{
    $cnx = connexionBdd();
    $data = [
        'image' => $image,
        'nom' => $nom,
        'prenom' => $prenom,
        'matricule' => $matricule,
        'email' => $email,
        'phone' => $phone,
        'ville' => $ville,
        'dateEmbauche' => $dateEmbauche,
        'filiale_id' => $filiale_id
    ];

    foreach ($data as $key => $value) {

        $data[$key] = htmlentities($value);
    }

    $sql = "INSERT INTO employes (image, nom, prenom,  matricule, email, phone, dateEmbauche, filiale_id) VALUES (:image,  :nom, :prenom,  :matricule, :email, :phone, :dateEmbauche, :filiale_id )";
    $request = $cnx->prepare($sql);
    $request->execute(array(

        'image' => $image,
        'nom' => $nom,
        'prenom' => $prenom,
        'matricule' => $matricule,
        'email' => $email,
        'phone' => $phone,
        'ville' => $ville,
        'dateEmbauche' => $dateEmbauche,
        'filiale_id' => $filiale_id

    ));
}

//////////// Une fonction pour verifier l'existance d'un  employe///////////////////

function verifEmploye(string $matricule, string $dateEmbauche): mixed
{
    $cnx = connexionBdd();
    $sql = "SELECT * FROM employes WHERE matricule = :matricule AND dateEmbauche = :dateEmbauche";
    $request = $cnx->prepare($sql);
    $request->execute(array(
        ':matricule' => $matricule,
        ':dateEmbauche' => $dateEmbauche
    ));
    $result = $request->fetch();
    return $result;
}

////////////// Une fonction pour récuperer tous les employes///////////////////
function allEmployes(): mixed
{
    $cnx = connexionBdd();
    $sql = "SELECT * FROM employes"; // requête d'insertion que je stock dans une variable
    $request = $cnx->query($sql);
    $result = $request->fetchAll();
    return $result;
}
//////// Une fonction pour récuperer un employe ////////////////////

function showEmployeViaId(int $id)
{

    $cnx = connexionBdd();
    $sql = "SELECT * FROM USERs WHERE id_employe = :id ";
    $request = $cnx->prepare($sql);
    $request->execute(array(
        ':id' => $id
    ));
    $result = $request->fetch();
    return $result;
}
//////// Une fonction pour modifier un employe///////////////////////

function updateEmployes($image, $nomEmploye, $matricule, $dateEmbauche, $dateModification, $id_filiale, $id_employe): void
{
    $cnx = connexionBdd();
    $data = [
        'image' => $image,
        'nomEmploye' => $nomEmploye,
        'matricule' => $matricule,
        'dateEmbauche' => $dateEmbauche,
        'dateModification' => $dateModification,
        'filiale_id' => $id_filiale,
        'id_employe' => $id_employe
    ];

    foreach ($data as $key => $value) {

        $data[$key] = htmlentities($value);
    }

    $sql = "UPDATE employes SET image =  :image, nomEmploye = :nomEmploye,  matricule = :matricule, dateEmbauche = :dateEmbauche,  dateModification = :dateModification, filiale_id = :filiale_id WHERE id_employe = :id_employe"; // requête d'insertion que je stock dans une variable

    $request = $cnx->prepare($sql); // je prépare ma fonction et je l'exécute
    $request->execute(array(
        ':image' => $data['image'],
        ':nom' => $data['nom'],
        ':matricule' => $data['matricule'],
        ':dateEmbauche' => $data['dateEmbauche'],
        ':dateModification' => $data['dateModification'],
        ':filiale_id' => $data['filiale_id'],
        ':id_employe' => $data['id_employe']
    ));
}
////////////// Une fonction pour supprimer un employe ///////////////

function deleteEmploye(int $id): void
{

    $cnx = connexionBdd();
    $sql = "DELETE FROM employes WHERE id_employe = :id_employe ";
    $request = $cnx->prepare($sql);
    $request->execute(array(
        ':id_employe' => $id
    ));
}

////////////// Une fonction pour afficher les 6 derniers employes /////////////////////

function employeByDate(): mixed
{

    $cnx = connexionBdd();
    $sql = "SELECT * FROM employes ORDER BY dateEmbauche DESC LIMIT 6";
    $request = $cnx->query($sql); // querry parcequ on n'a pas de parametre définis
    $result = $request->fetchAll();
    return $result;
}
////////////// Une fonction pour afficher les 6 derniers employes /////////////////////
function employesByFiliale($id): mixed
{

    $cnx = connexionBdd();
    $sql = "SELECT * FROM filiales WHERE filiale_id = :id";
    $request = $cnx->prepare($sql);
    $request->execute(array(
        ':id' => $id
    ));
    $result = $request->fetchAll();
    return $result;
}
