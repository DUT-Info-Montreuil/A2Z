<?php

require_once "cont_editionExo.php";


class ModEditionExo
{
    private $con;
    public function __construct()
    {
        $this->con = new ContEditionExo();
        $this->con->exec();

    }

    public function getControleur()
    {
        return $this->con;
    }
}
