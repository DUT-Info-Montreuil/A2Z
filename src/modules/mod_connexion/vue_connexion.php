<?php

require_once("./Common/Bibliotheque_Communes/errreur404.php");
if (constant("a2z") != "rya")
  die(affichage_erreur404());

require_once("./Common/Classe_Generique/vue_connexion_generique.php");

class VueConnexion extends Vue_connexion_generique
{

  public function  __construct()
  {
    parent::__construct(); // comme un super
  }


  ////////////////////////////////////////////////// INSCRIPTION ///////////////////////////////////////////////////////
  // formulaire d'inscription au site 
  public function form_inscription()
  {
    //index.php?module=joueurs&action=ajout


?>
    <title> INSCRIPTION | A2Z</title>
    <div class="pageCompte">
      <div class="contenir">
        <div class="auth-title">
          <h1>INSCRIPTION</h1>
          <p class="balise_p_generique">Inscrivez-vous à A2Z</p>
        </div>
        <?php
        if (!isset($_SESSION["identifiant"])) { // pour afficher le formulaire uniquement si on n'est pas déjà connecter

        ?>
          <form class="formulairegenerale" action="index.php?module=connexion&action=creationCompte" method="post">
            <input type="hidden" name="token" value='<?php echo $_SESSION['token'] ?>'>
            <!--Token- -->

            <div> <input class="saisieText" type="text" placeholder="Identifiant" name="identifiant" required maxlength="50"></div>

            <!--Premier Mot de Passe- -->
            <div class="boutonMdp">
              <input class="saisieText" id="premierMdp" type="password" placeholder="Mot de passe" name="motDePasse" required maxlength="100">
              <button type="button" class="checkboxMdp"> <img alt="oeil affichage mot de passe" id="oeil" src="ressource/images/oeilCacherMdp.png" onclick="basculerAffichageMotDePasse(premierMdp,oeil)"> </button>
            </div>

            <!--Deuxième Mot de Passe- -->
            <div class="boutonMdp">
              <input class="saisieText" id="deuxiemeMdp" type="password" placeholder="Confirmation Mdp" name="DeuxiemeMotDePasse" required maxlength="100" onKeyUp="checkMdp()">
              <button type="button" class="checkboxMdp"> <img alt="oeil affichage mot de passe" id="deuxiemeOeil" src="ressource/images/oeilCacherMdp.png" onclick="basculerAffichageMotDePasse(deuxiemeMdp,deuxiemeOeil)"> </button>
            </div>
            <div><input class="saisieText" type="email" placeholder="E-mail" name="adresseMail" required maxlength="75"></div>
            <div><input class="saisieText" type="submit" value="S'inscrire 👋🏻 !"> </div>
            <div id="deuxiemeAffichageMdp">
              <!--Vide pour laisser la place au message d'erreur  -->
            </div>
            <p class="balise_p_generique">&copy;A2Z 2022</p>
          </form>
        <?php
        } else {
          $this->compteInexsistant();
        }

        ?>
      </div>
    </div>
  <?php

  }

  ////////////////////////////////////////////////// CONNEXION ///////////////////////////////////////////////////////

  //fonction pour afficher le foirmulaire de connexion
  public function form_connexion()
  {
  ?>
    <title> CONNEXION | A2Z</title>
    <?php
    if (!isset($_SESSION["identifiant"])) {
    ?>
      <div class="pageCompte">
        <div>
          <div class="auth-title">
            <h1>Connexion</h1>
            <p class="balise_p_generique">Connectez-vous à A2Z</p>
          </div>
          <form class="formulairegenerale" action="index.php?module=connexion&action=connexionidentifiant" method="post">
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

  public function affichageInscriptionReussite()
  {
  ?>
    <script src="Script_js/outils.js"></script>
    <script type="text/javascript">
      Toast.fire({
        icon: 'success',
        title: "Inscription Réussite <br>Bonjour et bienvenue sur A2Z la plateforme intuitive pour créer sa fiche d'exercice 😄! "
      })
    </script>

  <?php
  }

  public function SuppresionCompte()
  {
  ?>
    <script src="Script_js/outils.js"></script>
    <script type="text/javascript">
      Toast.fire({
        icon: 'warning',
        title: "Attention votre compte a été supprimé veuillez contacter votre administrateur s'il s'agit d'une erreur 😓! "
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