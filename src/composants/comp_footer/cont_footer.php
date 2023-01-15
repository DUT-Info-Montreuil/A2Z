<?php

require_once("./Common/Bibliotheque_Communes/errreur404.php");
if (constant("a2z") != "rya")
	die(affichage_erreur404());

require_once "vue_footer.php";
class Cont_footer
{
    private $vue;

    public function __construct()
    {
        $this->vue = new Vue_footer;
    }

    public function exec()
    {
        $this->affichageHabillage();
    }

    public function affichageHabillage()
    {
        $this->vue->footerHabillage();
    }
}
