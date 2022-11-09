<?php

require_once "./vue_generique.php";

class VueFavoris extends Vue_Generique
{

  public function  __construct()
  {
    parent::__construct();  // comme un super
  }

  public function carousel() {

?>



<?php
  }

  public function boutonCreerDossier() {
?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="./Script_js/script_dossier.js">


</script>
   <button type="button" onClick="popUpNomDuDossier()" name="CreerDossier" > Créer un dossier </button>
   


<?php
  }


}

?>