<?php

require_once "./modules/mod_principale/Vue_mod_principale/Vue_habillage/vue_habillage.php";
require_once "./modules/mod_principale/modele_principale.php";

class ContPrincipale
{

    public function __construct()
    {
        $this->vue = new VueHabillage;
        $this->modele = new ModeleConnexion;

        // ? veutr dire if  
        // : veut dire else  
    }


    public function affichageHabillage(){
        $this->vue->navBarHabillage();
        $this->vue->footerHabillage();
    }  

    
    
}