<?php

require_once("./Common/Bibliotheque_Communes/errreur404.php");
if (constant("a2z") != "rya")
    die(affichage_erreur404_admin());

class Controleur_administration
{
    private $module;
    public $resultat;
    public function __construct()
    {
        $this->module = isset($_GET['module']) ? $_GET['module'] : 'gestionUseur';
        $this->exec();
    }

    public function exec()
    {
        switch ($this->module) {

            case "administration":
                require_once "administration/modules_administration/mod_connexion/mod_connexion_administration.php"; // pour les Faille include 
                $this->module = new ModConnexion_administration();
                $this->resultat = $this->module->getControleur()->getVueControleur()->affichageTampon(); //affichage du tampon
                break;

            case "gestionUseur":
                if (isset($_SESSION["identifiant"])) {  //page accessible uniquement si on est connecter
                    require_once "administration/modules_administration/mod_gestion_Useur/mod_gestion_Useur.php"; // pour les Faille include 
                    $this->module = new Mod_gestionUseur();
                } else {
                    echo "connecte toi d'abord";
                }
                break;

            default:
                die(affichage_erreur404_admin());
        }
        if (isset($_SESSION["identifiant"])) {  //page accessible uniquement si on est connecter
            $this->resultat = $this->module->getControleur()->getVueControleur()->affichageTampon(); //affichage du tampon
        }
    }
}
/*
Version 1.0 - 2022/11/30
GNU GPL  Copyleft (C inversé) 2023-2033
Initiated by Hamidi.Yassine,Chouchane.Rayan,Claude.Aldric
Web Site = http://localhost/A2Z/src/index.php?module=connexion&action=connexion 
*/
?>