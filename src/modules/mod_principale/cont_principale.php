<?php

require_once "./modules/mod_principale/Vue_mod_principale/Vue_habillage/vue_habillage.php";
require_once "./modules/mod_principale/modele_principale.php";

class ContPrincipale
{
    private $modele;
    private $action;

    public function __construct()
    {
        $this->vue = new VueHabillage;
        $this->modele = new ModeleConnexion;


    }


    public function affichageHabillage(){
        $this->vue->navBarHabillage();
        $this->vue->footerHabillage();
    }  

    
    
}