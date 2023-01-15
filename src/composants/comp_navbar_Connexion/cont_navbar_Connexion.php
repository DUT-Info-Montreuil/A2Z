<?php

require_once("./Common/Bibliotheque_Communes/errreur404.php");
if (constant("a2z") != "rya")
    die(affichage_erreur404());

require_once "vue_navbar_Connexion.php";
class Cont_navbar_Connexion
{
    private $vue;

    public function __construct()
    {
        $this->vue = new Vue_navbar_Connexion;
    }

    public function exec()
    {
        $this->affichageHabillage();
    }

    public function affichageHabillage()
    {
        $this->vue->navBarHabillage();
        // $this->vue->footerHabillage();
    }
}
