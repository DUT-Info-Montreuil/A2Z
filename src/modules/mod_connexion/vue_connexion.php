<?php
require_once "./vue_generique.php";

class VueConnexion extends Vue_Generique
{

  public function  __construct()
  {
    parent::__construct(); // comme un super
  }


  ////////////////////////////////////////////////// NAVBAR FOOTER ///////////////////////////////////////////////////////

  //ici on fait ça pour éviter la duplication de code dans la fonction inscription déconnexion et connexion
  public function navBarConnexion()
  {
?>

    <head>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <link rel="stylesheet" href="Style_css/pageConnexion.css">

    </head>
    <header class="headerconnexion">
      <div class="p-3 text-bg-dark">
        <div class="container">
          <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">


            <?php if (!isset($_SESSION["identifiant"])) {
            ?>
              <a href="index.php?module=connexion&action=connexion">
                <img class="logo" src="ressource/images/TabA2Z.png" width="64" height="64">
              </a>

            <?php } elseif (isset($_SESSION["identifiant"])) {
            ?>
              <a href="index.php?module=principale">
                <img class="logo" src="ressource/images/TabA2Z.png" width="64" height="64">
              </a>
            <?php } ?>

            <div class="navigation">
              <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                  <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                    <use xlink:href="#bootstrap" />
                  </svg>
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                  <li><a href="#" class="nav-link px-2 text-white">Contact </a></li>
                  <li><a href="#" class="nav-link px-2 text-white">Respect de la vie privée</a></li>
                  <li><a href="#" class="nav-link px-2 text-white">A propos de</a></li>
                </ul>



                <div class="text-end">

                  <?php
                  //ici on verifie si on est sur la page inscription si c'est le cas alors on affiche pas le bouton sinon on l'affiche
                  if (isset(($_GET['action'])) && !($_GET['action'] == "inscription") && (!isset($_SESSION['identifiant']))) {
                  ?>
                    <a href="index.php?module=connexion&action=inscription"><button type="button" class="btn btn-warning">Inscription</button>
                    <?php
                  }
                  //ici on verifie si on est conencter si oui alors on change le bouton conencter par deconnexion
                  else if ((!isset($_SESSION['identifiant'])) && isset(($_GET['action'])) && $_GET['action'] != "connexion") {
                    ?>
                      <a href="index.php?module=connexion&action=connexion"><button type="button" class="btn btn-outline-light me-2">Connexion</button>
                      <?php
                    } else if (!isset(($_GET['action']))) {
                      ?>
                        <a href="index.php?module=connexion&action=inscription"><button type="button" class="btn btn-warning">Inscription</button>
                        <?php
                      }
                        ?>
                </div>
              </div>
            </div>
          </div>
    </header>


  <?php
  }

  ////////////////////////////////////////////////// INSCRIPTION ///////////////////////////////////////////////////////
  // formulaire d'inscription au site 
  public function form_inscription()
  {
    //index.php?module=joueurs&action=ajout


  ?>

    <head>
      <link rel="stylesheet" href="Style_css/pageConnexion.css">
      <script src="modules/mod_connexion/outilsMotDePasse.js"></script>
    </head>

    <body>

      <div class="contenir">

        <?php
        if (!isset($_SESSION["identifiant"])) { // pour afficher le formulaire uniquement si on n'est pas déjà connecter


        ?>
          <form action="index.php?module=connexion&action=creationCompte" method="post">
          <input type="hidden" name="token" value='<?php echo $_SESSION['token']?>'> <!--Token- -->

            <p>Inscription</p>
            <div> <input class="saisieText" type="text" placeholder="Identifiant" name="identifiant" required maxlength="50"></div>

            <div class="boutonMdp">
              <input class="saisieText" id="monEntree" type="password" placeholder="Mot de passe" name="motDePasse" required maxlength="100">
              <button type="button" class="checkboxMdp"> <img id="oeil" src="ressource/images/oeilCacherMdp.png" onclick="basculerAffichageMotDePasse()"> </button>
            </div>

            <div><input class="saisieText" type="email" placeholder="E-mail" name="adresseMail" required maxlength="75"></div>
            <div><input class="saisieText" type="submit" value="S'inscrire 👋🏻 !"> </div>
            <p>© 2022–2023</p>
          </form>
        <?php
        } else {
          $this->compteInexsistant();
        }

        ?>
      </div>
    </body>

  <?php

  }
  ////////////////////////////////////////////////////TOAST////////////////////////
  //fonction pour l'affichage du toast "pop up" pour afficher un message de bienvenu
  public function popUpClassique($Titre, $Contenu)
  {
  ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Style_css/toast.css">

    <!DOCTYPE html>
    <html>

    <head>
      <meta charset='utf-8'>
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    </head>

    <body>
      <div class="index">

        <div class="container">
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <h4> <?php echo "$Titre"; ?> </h4>
            <?php echo "$Contenu";  ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
          </div>
        </div>
      </div>

    </body>

    </html>

  <?php
  }


  ////////////////////////////////////////////////// CONNEXION ///////////////////////////////////////////////////////

  //fonction pour afficher le foirmulaire de connexion
  public function form_connexion()
  {
  ?>

    <head>
      <link rel="stylesheet" href="Style_css/pageConnexion.css">
      <script src="modules/mod_connexion/outilsMotDePasse.js"></script>
    </head>

    <body>
      <?php
      if (!isset($_SESSION["identifiant"])) {
      ?>
        <div class="contenir">
          <form action="index.php?module=connexion&action=connexionidentifiant" method="post">
          <input type="hidden" name="token" value='<?php echo $_SESSION['token']?>'> <!--Token- -->

            <p>Connexion</p>
            <div><input class="saisieText" type="text" placeholder="Identifiant" name="identifiant" required maxlength="50"></div>

            <div class="boutonMdp">
              <input class="saisieText" type="password" id="monEntree" placeholder="Mot de passe" name="motDePasse" required maxlength="100">
              <button type="button" class="checkboxMdp"> <img id="oeil" src="ressource/images/oeilCacherMdp.png" onclick="basculerAffichageMotDePasse()"> </button>
            </div>

            <div><input class="saisieText" type="submit" value="Se connecter 🤩 !"></div>
            <a href="#">Mot de passe oublié</a>
            <p>© 2022–2023</p>

          </form>
        </div>
      <?php
      } else {
        $this->compteInexsistant();
      }
      ?>
    </body>
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

  public function affichageAdreMailUtiliser()
  {
  ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="Script_js/outils.js"></script>
    <script type="text/javascript">
      Toast.fire({
        icon: 'error',
        title: "Attention cette adresse mail <br>ou cet identifiant existe déjà !!! "
      })
    </script>

  <?php
  }

  public function affichageDeconnexion()
  {
  ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="Script_js/outils.js"></script>
    <script type="text/javascript">
      Toast.fire({
        icon: 'info',
        title: "Au revoir et a bientôt sur A2Z la plateforme <br>intuitive pour créer sa fiche d'exercice 🥰! "
      })
    </script>

  <?php
  }

  /// mettre cette fonction dans mod principale
  public function affichageConnexionReussie()
  {
  ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="Script_js/outils.js"></script>
    <script type="text/javascript">
      Toast.fire({
        icon: 'success',
        title: "Heureux de vous revoir  sur A2Z la plateforme intuitive pour créer sa fiche d' exercice 🥰! "
      })
    </script>

  <?php
  }
  
  public function affichageInscriptionReussite()
  {
  ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="Script_js/outils.js"></script>
    <script type="text/javascript">
      Toast.fire({
        icon: 'success',
        title: "Inscription Réussite <br>Bonjour et bienvenue sur A2Z la plateforme intuitive pour créer sa fiche d'exercice 😄! "
      })
    </script>

  <?php
  }

  public function affichageDeconnexionImpossible()
  {
  ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="Script_js/outils.js"></script>
    <script type="text/javascript">
      Toast.fire({
        icon: 'error',
        title: "Vous devez d'abord vous connecter pour faire la déconnexion 😡!!! "

      })
    </script>

  <?php
  }

  public function affichageDejaConnecter()
  {
  ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="Script_js/outils.js"></script>
    <script type="text/javascript">
      Toast.fire({
        icon: 'error',
        title: " Vous êtes déjà connecté, veuillez d'abord vous déconnecter 😡 !!!"
      })
    </script>
  <?php
  }

  public function affichagCompteInexistant()
  {
  ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="Script_js/outils.js"></script>
    <script type="text/javascript">
      Toast.fire({
        icon: 'error',
        title: "Attention  ce compte n'existe pas 😡!!! "
      })
    </script>

<?php
  }
}
