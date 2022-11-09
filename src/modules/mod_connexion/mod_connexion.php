<?php

require_once "cont_connexion.php";


class ModConnexion
{
    private $con;
    public function __construct()
    {
        $this->con = new ContConnexion();
        $this->con->exec();

    }

    public function getControleur()
    {
        return $this->con;
    }
}
