<?php
require_once "./vue_generique.php";

class VueCompte extends Vue_Generique
{

  public function  __construct()
  {
    parent::__construct(); // comme un super
  }

  ////////////////////////////////////////////////// Modifiaction Identifiant ///////////////////////////////////////////////////////
  // formulaire pour la modification de l'identifiant
  public function form_modification_compte_identifiant()
  {

?>

    <head>
      <link rel="stylesheet" href="Style_css/pageConnexion.css">
    </head>

    <body>
      <div class="contenir">
        <?php
        ?>
        <form action="index.php?module=compte&action=changementIdentifiant" method="post">
          <p>Changement de l'identifiant</p>
          <div> <input class="saisieText" type="text" placeholder="Nouvel Identifiant" name="nouveauidentifiant" required></div>
          <div><input class="saisieText" type="submit" value="Sauvegarder mes informations !"> </div>
        </form>
        <?php
        ?>
      </div>
    </body>
  <?php

  }

  ////////////////////////////////////////////////// Modifiaction adresse mail ///////////////////////////////////////////////////////

  // formulaire pour la modification de l' adresse mail
  public function form_modification_compte_adressemail()
  {
  ?>

    <head>
      <link rel="stylesheet" href="Style_css/pageConnexion.css">
    </head>

    <body>
      <div class="contenir">
        <?php
        ?>
        <form action="index.php?module=compte&action=changementAdresseMail" method="post">
          <p>Changement de l'adresse mail</p>
          <div> <input class="saisieText" type="email" placeholder="Nouvel adresse mail" name="nouveladresseMail" required></div>
          <div><input class="saisieText" type="submit" value="Sauvegarder mes informations !"> </div>
        </form>
        <?php
        ?>
      </div>
    </body>
  <?php

  }

  ////////////////////////////////////////////////// Modifiaction mot de passe ///////////////////////////////////////////////////////

  // formulaire pour la modification du mot de passe
  public function form_modification_compte_mot_de_passe()
  {

  ?>

    <head>
      <link rel="stylesheet" href="Style_css/pageConnexion.css">
      <script src="modules/mod_connexion/outilsMotDePasse.js"></script>
    </head>

    <body>
      <div class="contenir">
        <?php
        ?>
        <form action="index.php?module=compte&action=changementMotDePasse" method="post">
          <p>Changement de mot de passe</p>
          <div class="boutonMdp">
            <input class="saisieText" type="password" id="monEntree" placeholder="Nouvel mot de passe" name="nouveauMotDePasse" required>
            <button type="button" class="checkboxMdp"> <img id="oeil" src="ressource/images/oeilCacherMdp.png" onclick="basculerAffichageMotDePasse()"> </button>
          </div>
          <div><input class="saisieText" type="submit" value="Sauvegarder mes informations !"> </div>
        </form>
        <?php
        ?>
      </div>
    </body>
  <?php
  }

  ////////////////////////////////////////////////// Modifiaction Photo De Profile ////////////////////////////////////////////////////

  // page pour changer la photo de profile
  public function modifiactionPhotoDeProfile($image)
  {
  ?>

    <head>
      <meta charset='utf-8'>
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="Style_css/pageConnexion.css">
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script src="sweetalert2.min.js"></script>
      <link rel="stylesheet" href="sweetalert2.min.css">
    </head>

    <body class="pageCompte">

      <div class="settings">
        <div class="auth-title">
          <h1>Importer une photo de profil</h1>
          <p>Personnaliser votre compte </p>
        </div>

        <form action="index.php?module=compte&action=changementPhotoDeProfile" method="post" enctype="multipart/form-data">
          <label for="formFileSm" class="form-label">IMPORTER UNE IMAGE :</label>
          <label class="warningFileUpload">Format de fichier autorisé : PNG</label>
          <label class="warningFileUpload">Taille maximale du fichier : 1000 Ko</label>

          <div class="mb-3">
            <input type="file" class="form-control form-control-sm" aria-label="Small file input example" accept="image/png, image/jpeg,, image/jpg " name="image" required>
          </div>
          <div><input class="saisieText" name="submit" type="submit" value="Sauvegarder la photo !"> </div>
          <a href="./?module=settings&action=deleteCurrentAvatar"><label class="deleteCurrentAvatar">SUPPRIMER LA PHOTO DE PROFIL ACTUELLE</label></a>

          <div class="fileUpload">
            <div class="profilePic" style="background: url('<?php echo $image ?>');"></div>
          </div>
        </form>
      </div>
    </body>
  <?php
  }

  ////////////////////////////////////////////////// INFORMATIONS DU COMPTE ////////////////////////////////////////////////////

  //page génerale pour afficher toutes les informations generale d'un user
  public function affichageInfoCompte($identifiant, $motDePasse, $adresseMail)
  {

  ?>
    <!DOCTYPE html>
    <html>

    <head>
      <meta charset='utf-8'>
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="Style_css/pageCompte.css">
      <link rel="stylesheet" href="Style_css/toast.css">

    </head>

    <body class="pageCompte">

      <div class="informationCompte">
        <div class="my-3 p-3 bg-body rounded shadow-sm">
          <h4 class="titre">Informations générales</h6>
            <div class="d-flex text-muted pt-3">
              <svg class="" width="32" height="32" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false">
                <title>Placeholder</title>
              </svg>


              <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                <div class="d-flex justify-content-between">
                  <strong class="text-gray-dark">
                    <p class="sousTitre">Photo</p>
                  </strong>
                  <a href="index.php?module=compte&action=miseAJourPhotoDeProfile">
                    <p class="modification">Modifier</p>
                  </a>
                </div>
                <span class="d-block">
                  <p>Personnalisez votre compte en ajoutant une photo</p>
                </span>
              </div>
            </div>
            <div class="d-flex text-muted pt-3">
              <svg class="" width="32" height="32" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false">
                <title>Placeholder</title>
              </svg>

              <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                <div class="d-flex justify-content-between">
                  <strong class="text-gray-dark">
                    <p class="sousTitre">Identifiant</p>
                  </strong>
                  <a href="index.php?module=compte&action=miseAJourIdentifiant">
                    <p class="modification">
                      <p class="modification">Modifier</p>
                  </a>
                </div>
                <span class="d-block">
                  <p><?php echo $identifiant ?></p>
                </span>
              </div>
            </div>
            <div class="d-flex text-muted pt-3">
              <svg class="" width="32" height="32" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false">
                <title>Placeholder</title>
              </svg>

              <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                <div class="d-flex justify-content-between">
                  <strong class="text-gray-dark">
                    <p class="sousTitre">Mot de passe</p>
                  </strong>
                  <a href="index.php?module=compte&action=miseAJourMotDePasse">
                    <p class="modification">Modifier</p>
                  </a>
                </div>
                <span class="d-block">
                  <p>****************</p>
                </span>
              </div>
            </div>

            <div class="d-flex text-muted pt-3">
              <svg class="" width="32" height="32" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false">
                <title>Placeholder</title>
              </svg>

              <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                <div class="d-flex justify-content-between">
                  <strong class="text-gray-dark">
                    <p class="sousTitre">Adresse Mail</p>
                  </strong>
                  <a href="index.php?module=compte&action=miseAJourEmail">
                    <p class="modification">Modifier</p>
                  </a>
                </div>
                <span class="d-block">
                  <p><?php echo $adresseMail ?></p>
                </span>
              </div>
            </div>
        </div>
      </div>
    </body>

    </html>

  <?php
  }
  ///////////////////////////////////////////////////////////////////////////TOAST////////////////////////////////////////////////////
  //fonction pour l'affichage du toast "pop up" pour afficher un message de bienvenu générique 
  public function popUpClassique($Titre, $Contenu)
  {

  ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

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
            <h4> <?php echo $Titre; ?> </h4>
            <?php echo $Contenu;  ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
          </div>
        </div>
      </div>

    </body>

    </html>

  <?php
  }

  public function affichageChangementImage()
  {
  ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="Script_js/outils.js"></script>
    <script type="text/javascript">
      Toast.fire({
        icon: 'success',
        title: ' Bravo, vous avez bien changé votre photo de profil !!! '
      })
    </script>

  <?php
  }

  public function affichageChangementImageRate()
  {
  ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="Script_js/outils.js"></script>
    <script type="text/javascript">
      Toast.fire({
        icon: 'error',
        title: "Le fichier n'est pas une image !!!"
      })
    </script>

  <?php
  }

  public function affichageChangementIdentifiant()
  {
  ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="Script_js/outils.js"></script>
    <script type="text/javascript">
      Toast.fire({
        icon: 'success',
        title: "Bravo, vous avez bien changé votre Identifiant !!!"
      })
    </script>

  <?php
  }

  public function affichageChangementIdentifiantFaux()
  {
  ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="Script_js/outils.js"></script>
    <script type="text/javascript">
      Toast.fire({
        icon: 'error',
        title: "L'identifiant choisi existe déjà !!! "
      })
    </script>

  <?php
  }

  public function affichageChangementAdresseMailReussit()
  {
  ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="Script_js/outils.js"></script>
    <script type="text/javascript">
      Toast.fire({
        icon: 'success',
        title: "Bravo, vous avez bien changé votre adresse mail !!! "
      })
    </script>

  <?php
  }

  public function affichageChangementAdresseMailFaux()
  {
  ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="Script_js/outils.js"></script>
    <script type="text/javascript">
      Toast.fire({
        icon: 'error',
        title: "L'adresse mail choisi existe déjà !!! "
      })
    </script>

  <?php
  }

  public function affichageChangementMDP()
  {
  ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="Script_js/outils.js"></script>
    <script type="text/javascript">
      Toast.fire({
        icon: 'success',
        title: "Bravo, vous avez bien changé votre  mot de passe !!! "
      })
    </script>

  <?php
  }

  public function affichageChangementPhoto()
  {
  ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="Script_js/outils.js"></script>
    <script type="text/javascript">
      Toast.fire({
        icon: 'success',
        title: "Bravo, vous avez bien changé votre photo de profil !!! "
      })
    </script>

  <?php
  }

  public function affichageImageTropGrande()
  {
  ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="Script_js/outils.js"></script>
    <script type="text/javascript">
      Toast.fire({
        icon: 'error',
        title: "La taille du fichier est trop grande!!! "
      })
    </script>

  <?php
  }
  public function affichageErreurTansfertImage()
  {
  ?>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="Script_js/outils.js"></script>
    <script type="text/javascript">
      Toast.fire({
        icon: 'error',
        title: "La taille du fichier est trop grande!!! "
      })
    </script>

<?php
  }
}
