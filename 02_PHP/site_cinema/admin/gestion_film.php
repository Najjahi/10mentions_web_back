<?php
require_once "../inc/functions.inc.php";

// gestion de l'accessibilité des pages admin 
if (empty($_SESSION['user'])) {
    header('location:'.RACINE_SITE.'authentification.php');
} else {
    if ($_SESSION['user']['role'] =='ROLE_USER') {
        header('location:'.RACINE_SITE.'index.php');
    }
}


require_once "../inc/header.inc.php";
?>

<?php

require_once "../inc/footer.inc.php";

?>
