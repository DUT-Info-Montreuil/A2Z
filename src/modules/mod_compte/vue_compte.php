<?php

require_once("./Common/Bibliotheque_Communes/errreur404.php");
if (constant("a2z") != "rya")
	die(affichage_erreur404());

require_once "./Common/Classe_Generique/vue_generique.php";

class VueCompte extends Vue_Generique
{

  public function  __construct()
  {
    parent::__construct(); // comme un super
  }

  ////////////////////////////////////////////////// Modification Identifiant ///////////////////////////////////////////////////////
  // formulaire pour la modification de l'identifiant
  public function form_modification_compte_identifiant()
  {
?>
    <title> Modification ID | A2Z</title>
    <div class="pageCompte">
      <div>
        <div class="auth-title">
          <h1>Changer votre identifiant</h1>
          <p class="balise_p_generique">Choisissez un nouvel identifiant</p>
        </div>
        <div class="contenir">
          <?php
          ?>
          <form class="formulairegenerale FormulaireInfoCompte" action="index.php?module=compte&action=changementIdentifiant" method="post">
            <input type="hidden" name="token" value='<?php echo $_SESSION['token'] ?>'>
            <!--Token- -->
            <br>
            <div> <input class="saisieText" type="text" placeholder="Nouvel Identifiant" name="nouveauidentifiant" required maxlength="50"></div>
            <div><input class="saisieText" type="submit" value="Sauvegarder !"> </div>
            <button onclick="window.location.href = 'index.php?module=compte&action=affichageInfoCompte'" type="button" class="saisieText">Annuler</button>
          </form>
          <?php
          ?>
        </div>
      </div>
    </div>
  <?php

  }

  ////////////////////////////////////////////////// Modification adresse mail ///////////////////////////////////////////////////////

  // formulaire pour la modification de l' adresse mail
  public function form_modification_compte_adressemail()
  {
  ?>
    <title> Modification Mail | A2Z</title>
    <div class="pageCompte">
      <div>
        <div class="auth-title">
          <h1>Changer votre adresse mail</h1>
          <p class="balise_p_generique">Choisissez une nouvelle adresse mail</p>
        </div>
        <div class="contenir">
          <?php
          ?>
          <form class="formulairegenerale FormulaireInfoCompte" action="index.php?module=compte&action=changementAdresseMail" method="post">
            <input type="hidden" name="token" value='<?php echo $_SESSION['token'] ?>'>
            <!--Token- -->
            <br>
            <div> <input class="saisieText" type="email" placeholder="Nouvel adresse mail" name="nouveladresseMail" required maxlength="75"></div>
            <div><input class="saisieText" type="submit" value="Sauvegarder !"> </div>
            <button onclick="window.location.href = 'index.php?module=compte&action=affichageInfoCompte'" type="button" class="saisieText">Annuler</button>

          </form>
          <?php
          ?>
        </div>
      </div>
    </div>
  <?php

  }

  ////////////////////////////////////////////////// Modification mot de passe ///////////////////////////////////////////////////////

  // formulaire pour la modification du mot de passe
  public function form_modification_compte_mot_de_passe()
  {
  ?>
    <title> Modification MDP | A2Z</title>
    <div class="pageCompte">
      <div>
        <div class="auth-title">
          <h1>Changer votre mot de passe</h1>
          <p class="balise_p_generique">Choisissez un mot de passe sécurisé <br>Ne le réutilisez pas pour d'autres comptes </p>
        </div>
        <div class="contenir">

          <?php
          ?>
          <form class="formulairegenerale FormulaireInfoCompte" action="index.php?module=compte&action=changementMotDePasse" method="post">

            <input type="hidden" name="token" value='<?php echo $_SESSION['token'] ?>'>
            <!--Token- -->
            <div class="conteneurMdp">
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

              <div id="deuxiemeAffichageMdp">
                <!--Vide pour laisser la place au message d'erreur  -->
              </div>
            </div>
            <div><input class="saisieText" type="submit" value="Sauvegarder !">
           </div>
           <button onclick="window.location.href = 'index.php?module=compte&action=affichageInfoCompte'" type="button" class="saisieText">Annuler</button>
          </form>
        </div>
      </div>
    </div>
  <?php
  }

  ////////////////////////////////////////////////// Modification Photo De Profile ////////////////////////////////////////////////////

  // page pour changer la photo de profile
  public function modifiactionPhotoDeProfile($image)
  {
  ?>
    <title>Modification Photo | A2Z</title>
    <div class="pageCompte">
      <div class="settings">
        <div class="auth-title">
          <h1>Importer une photo de profil</h1>
          <p class="balise_p_generique">Personnaliser votre compte </p>
        </div>

        <form class="formulairegenerale" action="index.php?module=compte&action=changementPhotoDeProfile" method="post" enctype="multipart/form-data">
          <input type="hidden" name="token" value='<?php echo $_SESSION['token'] ?>'>
          <!--Token- -->
          <label class="warningFileUpload">IMPORTER UNE IMAGE :</label>
          <label class="warningFileUpload">Format de fichier autorisé : JPG, JPEG, PNG</label>
          <label class="warningFileUpload">Taille maximale du fichier : 1 Mo</label>

          <div class="mb-3">
            <input type="file" class="form-control form-control-sm" aria-label="Small file input example" accept="image/png, image/jpeg, image/jpg " name="image" required>
          </div>
          <div><input class="saisieText" name="envoiPhoto" type="submit" value="Sauvegarder ma photo !">
          <button onclick="window.location.href = 'index.php?module=compte&action=affichageInfoCompte'" type="button" class="saisieText">Annuler</button>

        </div>
          <a href="index.php?module=compte&action=suppresionPhotoDeProfile"><label class="warningFileUpload">SUPPRIMER LA PHOTO DE PROFIL ACTUELLE</label></a>

          <div class="fileUpload">
            <div class="profilePic" style="background: url('<?php echo $image ?>');"></div>
          </div>
        </form>
      </div>
    </div>
  <?php
  }

  // page pour changer la photo de profile
  public function formSuppresionPhotoDeProfile($image)
  {
  ?>
    <title>Suppression Photo | A2Z</title>
    <div class="pageCompte">
      <div class="settings">
        <div class="auth-title">
          <h1>Supprimer la photo de profil</h1>
          <p class="balise_p_generique">Êtes-vous sûr de vouloir supprimer votre photo de profil?</p>
        </div>

        <form class="formulairegenerale" action="index.php?module=compte&action=demandeSuppresionPhotoDeProfile" method="post">
          <input type="hidden" name="token" value='<?php echo $_SESSION['token'] ?>'>
          <!--Token- -->

          <div>
            <label class="warningFileUpload">Celle-ci sera supprimée définitivement</label>
            <img src="ressource/images/poubelle.svg" width="30" height="30">
          </div>

          <div>
            <input class="saisieText" name="submit" type="submit" value="Supprimer ma photo !">
            <button onclick="window.location.href = 'index.php?module=compte&action=affichageInfoCompte'" type="button" class="saisieText">Annuler</button>
          </div>

          <div class="fileUpload">
            <div class="profilePic" style="background: url('<?php echo $image ?>');"></div>
          </div>
        </form>
      </div>
    </div>
  <?php

  }

  ////////////////////////////////////////////////// INFORMATIONS DU COMPTE ////////////////////////////////////////////////////

  //page génerale pour afficher toutes les informations generale d'un user
  public function affichageInfoCompte($identifiant, $motDePasse, $adresseMail)
  {
  ?>
    <title>Info Compte | A2Z</title>
    <div class="pageCompte">
      <div class="bodyFormulaireInfoCompte">
        <div>
          <div class="auth-title">
            <h1>Informations personnelles</h1>
            <p class="balise_p_generique">Infos sur vous dans A2Z </p>
          </div>
          <div class="informationCompte">

            <div class="my-3 p-3 bg-body rounded shadow-sm">
              <div class="d-flex text-muted pt-3 changement-Taille-Affichage-Info-Compte">
                <svg class="" width="32" height="32" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false">
                  <title>Placeholder</title>
                </svg>


                <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                  <div class="d-flex justify-content-between">
                    <strong class="text-gray-dark">
                      <p class="sousTitre balise_p_generique">Photo</p>
                    </strong>
                    <a href="index.php?module=compte&action=miseAJourPhotoDeProfile">
                      <p class="modification">Modifier</p>
                    </a>
                  </div>
                  <span class="d-block">
                    <p class="balise_p_generique">Personnalisez votre compte en ajoutant une photo</p>
                  </span>
                </div>
              </div>
              <div class="d-flex text-muted pt-3 changement-Taille-Affichage-Info-Compte">
                <svg class="" width="32" height="32" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false">
                  <title>Placeholder</title>
                </svg>

                <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                  <div class="d-flex justify-content-between">
                    <strong class="text-gray-dark">
                      <p class="sousTitre balise_p_generique">Identifiant</p>
                    </strong>
                    <a href="index.php?module=compte&action=miseAJourIdentifiant">
                      <p class="modification">Modifier</p>
                    </a>
                  </div>
                  <span class="d-block">
                    <p class="balise_p_generique"><?php echo $identifiant ?></p>
                  </span>
                </div>
              </div>
              <div class="d-flex text-muted pt-3 changement-Taille-Affichage-Info-Compte">
                <svg class="" width="32" height="32" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false">
                  <title>Placeholder</title>
                </svg>

                <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                  <div class="d-flex justify-content-between">
                    <strong class="text-gray-dark">
                      <p class="sousTitre balise_p_generique">Mot de passe</p>
                    </strong>
                    <a href="index.php?module=compte&action=miseAJourMotDePasse">
                      <p class="modification">Modifier</p>
                    </a>
                  </div>
                  <span class="d-block">
                    <p class="balise_p_generique">****************</p>
                  </span>
                </div>
              </div>

              <div class="d-flex text-muted pt-3 changement-Taille-Affichage-Info-Compte">
                <svg class="" width="32" height="32" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false">
                  <title>Placeholder</title>
                </svg>

                <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                  <div class="d-flex justify-content-between">
                    <strong class="text-gray-dark">
                      <p class="sousTitre balise_p_generique">Adresse Mail</p>
                    </strong>
                    <a href="index.php?module=compte&action=miseAJourEmail">
                      <p class="modification">Modifier</p>
                    </a>
                  </div>
                  <span class="d-block">
                    <p class="balise_p_generique"><?php echo $adresseMail ?></p>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php
  }

  public function affichageChangementImageRate()
  {
  ?>
    <script src="Script_js/outils.js"></script>
    <script type="text/javascript">
      Toast.fire({
        icon: 'error',
        title: "Le fichier n'est pas une image 😥"
      })
    </script>
  <?php
  }

  public function affichageChangementIdentifiant()
  {
  ?>
    <script src="Script_js/outils.js"></script>
    <script type="text/javascript">
      Toast.fire({
        icon: 'success',
        title: "Bravo, vous avez bien changé votre Identifiant 😊"
      })
    </script>
  <?php
  }

  public function affichageChangementIdentifiantFaux()
  {
  ?>
    <script src="Script_js/outils.js"></script>
    <script type="text/javascript">
      Toast.fire({
        icon: 'error',
        title: "L'identifiant choisi existe déjà 😡 "
      })
    </script>
  <?php
  }

  public function affichageChangementAdresseMailReussit()
  {
  ?>
    <script src="Script_js/outils.js"></script>
    <script type="text/javascript">
      Toast.fire({
        icon: 'success',
        title: "Bravo, vous avez bien changé votre adresse mail 😊 "
      })
    </script>
  <?php
  }

  public function affichageChangementAdresseMailFaux()
  {
  ?>
    <script src="Script_js/outils.js"></script>
    <script type="text/javascript">
      Toast.fire({
        icon: 'error',
        title: "L'adresse mail choisi existe déjà 😡"
      })
    </script>

  <?php
  }

  public function affichageChangementMDP()
  {
  ?>
    <script src="Script_js/outils.js"></script>
    <script type="text/javascript">
      Toast.fire({
        icon: 'success',
        title: "Bravo, vous avez bien changé votre  mot de passe 😊 "
      })
    </script>
  <?php
  }

  public function affichageChangementPhoto()
  {
  ?>
    <script src="Script_js/outils.js"></script>
    <script type="text/javascript">
      Toast.fire({
        icon: 'success',
        title: "Bravo, vous avez bien changé votre photo de profil 😊"
      })
    </script>

  <?php
  }

  public function affichageImageTropGrande()
  {
  ?>
    <script src="Script_js/outils.js"></script>
    <script type="text/javascript">
      Toast.fire({
        icon: 'error',
        title: "La taille du fichier est trop grande 😥 "
      })
    </script>

  <?php
  }
  public function affichageErreurTansfertImage()
  {
  ?>
    <script src="Script_js/outils.js"></script>
    <script type="text/javascript">
      Toast.fire({
        icon: 'error',
        title: "La taille du fichier est trop grande 😥 "
      })
    </script>

  <?php
  }

  public function affichagesuppresionPhotoDeProfileReussit()
  {
  ?>
    <script src="Script_js/outils.js"></script>
    <script type="text/javascript">
      Toast.fire({
        icon: 'success',
        title: "Bravo, vous avez bien supprimé votre photo de profil 😊 "
      })
    </script>

  <?php
  }

  public function affichagesuppresionPhotoDeProfileErreur()
  {
  ?>
    <script src="Script_js/outils.js"></script>
    <script type="text/javascript">
      Toast.fire({
        icon: 'error',
        title: "Erreur lors de la suppression de votre photo de profil 😥"
      })
    </script>
<?php
  }
}
