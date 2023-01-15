<?php

require_once("./Common/Bibliotheque_Communes/errreur404.php");
if (constant("a2z") != "rya")
    die(affichage_erreur404_admin());

require_once "cont_side_Bar_Menu.php";


class Composant_side_Bar_Menu
{
    private $controleur;
    public function __construct()
    {
        $this->controleur = new Cont_side_Bar_Menu();
        $this->controleur->exec();
    }

    public function getControleur()
    {
        return $this->controleur;
    }
}
/*
Version 1.0 - 2022/11/30
GNU GPL  Copyleft (C inversé) 2023-2033
Initiated by Hamidi.Yassine,Chouchane.Rayan,Claude.Aldric
Web Site = http://localhost/A2Z/src/index.php?module=connexion&action=connexion 
*/
?>