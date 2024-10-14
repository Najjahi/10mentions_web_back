<!doctype html>
<html lang="fr">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" charset="mon site viet">
  <meta name="author" content="imane najjahi">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Flex:opsz,wght@8..144,100..1000&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= RACINE_SITE ?>assets/css/style.css">

  <title>Blog AMV</title>
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg fixed-top ">
      <div class="container-fluid">
        <h1><a class="navbar-brand" href="<?= RACINE_SITE ?>index.php"><img src="<?= RACINE_SITE ?>assets/img/logo.png" alt=""> Blog AMV</a></h1>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link " aria-current="page" href="<?= RACINE_SITE ?>index.php">Accueil</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="<?= RACINE_SITE ?>articles.php">Articles</a>
            </li>

            <?php
            if (empty($_SESSION['user'])) {
            ?>
              <li class="nav-item">
                <a class="nav-link" href="<?= RACINE_SITE ?>register.php">Inscription</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?= RACINE_SITE ?>authentification.php">Connexion</a>
              </li>
            <?php
            } else {

            ?>
              <li class="nav-item">
                <a class="nav-link" href="profil.php"> <sup class="badge text-bg-warning"><?=$_SESSION['user']['firstName'] ?? "" ?></sup></a>
              </li>

              <?php

              if ($_SESSION['user']['role'] == 'ROLE_ADMIN') {

              ?>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">Backoffice</a>

                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item text-dark fs-4" href="<?= RACINE_SITE ?>admin/categories.php">Catégories</a></li>
                    <li><a class="dropdown-item text-dark fs-4" href="<?= RACINE_SITE ?>admin/articles.php">Articles</a></li>
                    <li><a class="dropdown-item text-dark fs-4" href="<?= RACINE_SITE ?>admin/users.php">utilisateurs</a></li>
                    <li><a class="dropdown-item text-dark fs-4" href="<?= RACINE_SITE ?>admin/gestion_article.php">Gestion des articles</a></li>
                  </ul>
                </li>
              <?php

              }
              ?>
              <li class="nav-item">
                <a class="nav-link" href="?action=deconnexion">Déconnexion</a>
              </li>
            <?php
            }
            ?>
            <li class="nav-item">
              <a class="nav-link" href="<?= RACINE_SITE ?>contact.php">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
