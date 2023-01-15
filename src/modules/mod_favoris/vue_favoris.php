<?php

require_once("./Common/Bibliotheque_Communes/errreur404.php");
if (constant("a2z") != "rya")
  die(affichage_erreur404());

require_once "./Common/Classe_Generique/vue_generique.php";

class VueFavoris extends Vue_Generique
{

  public function  __construct()
  {
    parent::__construct();  // comme un super
  }


  public function carouselFiches()
  {
  }

  public function boutonCreerDossier()
  {
?>
    <script src="./Script_js/script_dossier.js">

    </script>
    <title> Accueil | A2Z</title>

    <div class="boxBoutons">
      <button type="button" class="button-34" onClick="popUpNomDuDossier(<?php echo $_GET['location'] ?>)" name="CreerDossier"> Créer un dossier </button>
      <button type="button" class="button-34" onClick="popUpNomDeLaFiche(<?php echo $_GET['location'] ?>)">Créer une fiche</button>
    </div>
  <?php

  }

  public function affichageDossier()
  {
  ?>
    <link rel="stylesheet" href="./Style_css/dossier.css" />
    <script src="./Script_js/script_dossier.js"></script>
    <div class="BoxDossiers">
    </div>

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