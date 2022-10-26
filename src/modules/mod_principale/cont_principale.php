<?php

require_once "vue_connexion.php";
require_once "modele_connexion.php";

class ContPrincipale
{

    public function __construct()
    {
        $this->vue = new VueHabillage;
        $this->modele = new ModeleConnexion;

        // ? veutr dire if  
        // : veut dire else  
        $this->action = (isset($_GET['action']) ? $_GET['action'] : 'bienvenue');
    }
}