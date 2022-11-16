<?php

require_once "./modules/mod_principale/cont_principale.php";


class ModPrincipale
{
    public function __construct()
    {

        $this->controleur = new ContPrincipale();

       // switch ($this->con->getAction()) {
            
        //}
    
        $this->controleur->affichageHabillage();//affichage constant de la navbar et du footer

    }
    public function getControleur()
    {
        return $this->controleur;
    }
}
