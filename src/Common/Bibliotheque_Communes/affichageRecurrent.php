<?php

require_once("./Common/Bibliotheque_Communes/errreur404.php");
if (constant("a2z") != "rya")
  die(affichage_erreur404());

function affichagMotDePasseDifferent()
{
?>
  <script src="Script_js/outils.js"></script>
  <script type="text/javascript">
    Toast.fire({
      icon: 'error',
      title: "Attention les mots de passe sont différents 😡 "
    })
  </script>

<?php
}

function affichagMotDePasseErrone()
{
?>
  <script src="Script_js/outils.js"></script>
  <script type="text/javascript">
    Toast.fire({
      icon: 'error',
      title: "Échec de l'authentification 😡 "
    })
  </script>

<?php
}


function affichageTokenExpire()
{
?>
  <script src="Script_js/outils.js"></script>
  <script type="text/javascript">
    Toast.fire({
      icon: 'info',
      title: "Échec de l'authentification le token a expiré 🙄 "
    })
  </script>

<?php
}
/*
Version 1.0 - 2022/11/30
GNU GPL  Copyleft (C inversé) 2023-2033
Initiated by Hamidi.Yassine,Chouchane.Rayan,Claude.Aldric
Web Site = http://localhost/A2Z/src/index.php?module=connexion&action=connexion 
*/
?>