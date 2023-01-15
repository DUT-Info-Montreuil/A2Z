<?php

require_once("./Common/Bibliotheque_Communes/errreur404.php");
if (constant("a2z") != "rya")
  die(affichage_erreur404_admin());

require_once "./Common/Classe_Generique/vue_generique.php";

class VueConnexion_administration extends Vue_Generique
{

  public function  __construct()
  {
    parent::__construct();
  }

  ////////////////////////////////////////////////// CONNEXION ///////////////////////////////////////////////////////

  //fonction pour afficher le foirmulaire de connexion
  public function form_connexion_administration()
  {
?>
    <title>Connexion Admin | A2Z</title>
    <?php
    if (!isset($_SESSION["identifiant"])) {
    ?>
      <div class="pageCompte">
        <div>
          <div class="auth-title">
            <h1>Administration</h1>
            <p class="balise_p_generique">Connexion admin à A2Z</p>
          </div>
          <form class="formulairegenerale" action="index.php?module=administration&action=connexionidentifiant" method="post">
            <input type="hidden" name="token" value='<?php echo $_SESSION['token'] ?>'>
            <!--Token- -->

            <br>
            <br>
            <br>
            <div><input class="saisieText" type="text" placeholder="Identifiant" name="identifiant" required maxlength="50"></div>

            <div class="boutonMdp">
              <input class="saisieText" type="password" id="monEntree" placeholder="Mot de passe" name="motDePasse" required maxlength="100">
              <button type="button" class="checkboxMdp"> <img alt="oeil affichage mot de passe" id="oeil" src="ressource/images/oeilCacherMdp.png" onclick="basculerAffichageMotDePasse(monEntree,oeil)"> </button>
            </div>

            <div><input class="saisieText" type="submit" value="Se connecter 🤩 !"></div>
            <p class="balise_p_generique">&copy;A2Z 2022</p>

          </form>
        </div>
      </div>
    <?php
    } else {
      $this->compteInexsistant();
    }
    ?>
  <?php
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
}
/*
Version 1.0 - 2022/11/30
GNU GPL  Copyleft (C inversé) 2023-2033
Initiated by Hamidi.Yassine,Chouchane.Rayan,Claude.Aldric
Web Site = http://localhost/A2Z/src/index.php?module=connexion&action=connexion 
*/
?>