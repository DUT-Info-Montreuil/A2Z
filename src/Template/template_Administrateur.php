<?php
require_once("./Common/Bibliotheque_Communes/errreur404.php");
if (constant("a2z") != "rya")
  die(affichage_erreur404());
?>

<html lang="fr">
<!DOCTYPE html>

<head>
  <meta charset='utf-8'>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- CSS only -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="Style_css/formulaire_creation_admin.css">
  <link rel="stylesheet" href="sweetalert2.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel=" icon" href="ressource/images/TabA2Z.png" type="image/x-icon">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

  <!-- Script only -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="sweetalert2.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <!-- CSS only -->
  <link rel="stylesheet" href="Style_css/side_Bar_Menu.css">
  <link rel="stylesheet" href="Style_css/affichageListeUseur.css">
  <link rel="stylesheet" href="Style_css/affichage_confirmation_SuppresionUseur.css">
  <link rel="stylesheet" href="Style_css/pageConnexion.css">
  <link rel="stylesheet" href="Style_css/pageCompte.css">

</head>


<body>
  <?php

  if (!isset($_SESSION["identifiant"])) {  //page accessible uniquement si on est connecter
    require_once("./composants/comp_navbar_Connexion/composants_navbar_Connexion.php");
    $navbar_Connexion = new Composant_navbar_Connexion();
  } else {
    require_once("administration/composants_administration/comp_side_Bar_Menu/composants_side_Bar_Menu.php");
    $side_Bar_Menu = new Composant_side_Bar_Menu();
  }

  require_once("./administration/composants_administration/Info_Statistique_BD/composant_info_statistique.php");
  $Info_statistique = new Composant_info_statistique();
  echo $controleur->resultat; // affichage ici comme ça le contenu des modules sera toujours entre la navbar et le footer
  ?>

</body>

<!-- Script only -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="Script_js/outilsMotDePasse.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="Script_js/barreDeRecherche.js"></script>


</html>

<!-- 
Version 1.0 - 2022/11/30
GNU GPL  Copyleft (C inversé) 2023-2033
Initiated by Hamidi.Yassine,Chouchane.Rayan,Claude.Aldric
Web Site = http://localhost/A2Z/src/index.php?module=connexion&action=connexion 

-->