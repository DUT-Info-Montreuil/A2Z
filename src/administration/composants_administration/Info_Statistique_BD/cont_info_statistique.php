<?php

require_once("./Common/Bibliotheque_Communes/errreur404.php");
if (constant("a2z") != "rya")
    die(affichage_erreur404_admin());

require_once "vue_info_statistique.php";
require_once "modele_info_statistique.php";
class Cont_info_statistique extends Controleurgenerique
{

    public function __construct()
    {
        $this->vue = new Vue_info_statistique;
        $this->modele = new Modele_info_statistique;
    }

    public function exec()
    {
        $statUseur = $this->recuperationStatistiqueUseur();
        $this->affichage_info_statistique($statUseur);
    }

    public function affichage_info_statistique($statUseur)
    {
        $this->vue->affichage_info_statistique($statUseur);
    }

    public function recuperationStatistiqueUseur()
    {
        return $this->modele->recuperationStatistiqueUseur();
    }
}
/*
Version 1.0 - 2022/11/30
GNU GPL  Copyleft (C inversé) 2023-2033
Initiated by Hamidi.Yassine,Chouchane.Rayan,Claude.Aldric
Web Site = http://localhost/A2Z/src/index.php?module=connexion&action=connexion 
*/
?>