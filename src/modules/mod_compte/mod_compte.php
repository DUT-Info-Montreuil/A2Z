<?php

require_once "cont_compte.php";


class ModConnexion
{
    private $controleur;
    public function __construct()
    {
        $this->controleur = new ContCompte();
        $this->controleur->exec();

    }

    public function getControleur()
    {
        return $this->controleur;
    }
}
