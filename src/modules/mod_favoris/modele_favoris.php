<?php

require_once("./Common/Bibliotheque_Communes/errreur404.php");
if (constant("a2z") != "rya")
	die(affichage_erreur404());


class ModeleFavoris extends Connexion {

    public function __construct () {
        
    }

   

}
?>