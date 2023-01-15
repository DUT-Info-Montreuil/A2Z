<?php
require_once("./Common/Bibliotheque_Communes/errreur404.php");
if (constant("a2z") != "rya")
    die(affichage_erreur404());

class Controleur
{
    private $module;
    public $resultat;
    public function __construct()
    {
        $this->module = isset($_GET['module']) ? $_GET['module'] : 'connexion';
        $this->exec();
    }

    public function exec()
    {
        require_once("./Common/Classe_Generique/verificationExistanceUser.php");

        $verificationExistanceUser = new verificationExistanceUser();

        $verificationExistanceUser->verificationExistanceUser();
        switch ($this->module) {

            case "connexion":
                require_once "modules/mod_connexion/mod_connexion.php"; // pour les Faille include 
                $this->module = new ModConnexion();
                $this->resultat = $this->module->getControleur()->getVueControleur()->affichageTampon(); //affichage du tampon
                break;

            case "compte":
                if (isset($_SESSION["identifiant"])) {  //page accessible uniquement si on est connecter
                    require_once "modules/mod_compte/mod_compte.php"; // pour les Faille include 
                    $this->module = new ModCompte();
                } else {
                    echo "connecte toi d'abord";
                }
                break;

            case "favoris":
                if (isset($_SESSION["identifiant"])) {  //page accessible uniquement si on est connecter
                    require_once "./modules/mod_favoris/mod_favoris.php"; // pour les Faille include 
                    $this->module = new ModFavoris();
                }
                break;


            case "editionExo":
                if (isset($_SESSION["identifiant"])) {  //page accessible uniquement si on est connecter
                    require_once "modules/mod_editionExo/mod_editionExo.php"; // pour les Faille include 
                    $this->module = new ModEditionExo();
                } else {
                    echo "connecte toi d'abord";
                }
                break;

            case "administration":
                require_once "administration/modules_administration/mod_connexion/mod_connexion_administration.php"; // pour les Faille include 
                $this->module = new ModConnexion_administration();
                $this->resultat = $this->module->getControleur()->getVueControleur()->affichageTampon(); //affichage du tampon
                break;

            default:
                die(affichage_erreur404()); //on peut changer l'affichage ici
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