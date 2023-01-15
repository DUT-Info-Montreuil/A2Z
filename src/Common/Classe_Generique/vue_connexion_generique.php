<?php

require_once("./Common/Bibliotheque_Communes/errreur404.php");
if (constant("a2z") != "rya")
  die(affichage_erreur404());

require_once "./Common/Classe_Generique/vue_generique.php";

/**
 * Classe qui est appeller par vueConnexion dans la partie administrateur et useur pour enlever les redondances
 */
class Vue_connexion_generique extends Vue_Generique
{

  public function  __construct()
  {
    parent::__construct(); // comme un super
  }

  //fonction pour l'affichage du toast "pop up" pour afficher un message d'erruer si un compte est Inexsistant '
  public function compteInexsistant()
  {
    if (isset($_SESSION['identifiant'])) {
      $this->affichageDejaConnecter();
    } else {
      $this->affichagCompteInexistant();
    }
  }

  public function affichageDeconnexion()
  {
?>
    <script src="Script_js/outils.js"></script>
    <script type="text/javascript">
      Toast.fire({
        icon: 'info',
        title: "Au revoir et a bientôt sur A2Z la plateforme <br>intuitive pour créer sa fiche d'exercice 🤩! "
      })
    </script>

  <?php
  }

  /// mettre cette fonction dans mod principale
  public function affichageConnexionReussie()
  {
  ?>
    <script src="Script_js/outils.js"></script>
    <script type="text/javascript">
      Toast.fire({
        icon: 'success',
        title: "Heureux de vous revoir  sur A2Z la plateforme intuitive pour créer sa fiche d' exercice 🥰! "
      })
    </script>

  <?php
  }

  public function affichageDeconnexionImpossible()
  {
  ?>
    <script src="Script_js/outils.js"></script>
    <script type="text/javascript">
      Toast.fire({
        icon: 'error',
        title: "Vous devez d'abord vous connecter pour faire la déconnexion 😮!!! "

      })
    </script>

  <?php
  }

  public function affichageDejaConnecter()
  {
  ?>
    <script src="Script_js/outils.js"></script>
    <script type="text/javascript">
      Toast.fire({
        icon: 'error',
        title: " Vous êtes déjà connecté, veuillez d'abord vous déconnecter 😮 !!!"
      })
    </script>
  <?php
  }

  public function affichagCompteInexistant()
  {
  ?>
    <script src="Script_js/outils.js"></script>
    <script type="text/javascript">
      Toast.fire({
        icon: 'error',
        title: "Attention  ce compte n'existe pas 😥!!! "
      })
    </script>
  <?php
  }


  public function affichageAdreMailUtiliser()
  {
  ?>
    <script src="Script_js/outils.js"></script>
    <script type="text/javascript">
      Toast.fire({
        icon: 'error',
        title: "Attention cette adresse mail <br>ou cet identifiant existe déjà 😮 "
      })
    </script>

<?php
  }
}
/*
Version 1.0 - 2022/11/30
GNU GPL  Copyleft (C inversé) 2023-2033
Initiated by Hamidi.Yassine,Chouchane.Rayan,Claude.Aldric
Web Site = http://localhost/A2Z/src/index.php?module=connexion&action=connexion 
*/
?>