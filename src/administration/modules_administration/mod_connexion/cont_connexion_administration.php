<?php

require_once("./Common/Bibliotheque_Communes/errreur404.php");
if (constant("a2z") != "rya")
    die(affichage_erreur404_admin());

require_once "vue_connexion_administration.php";
require_once "./Common/Classe_Generique/modele_connexion_generique.php";
require_once("./Common/Bibliotheque_Communes/Verification_Creation_Token.php");

require_once("./Common/Bibliotheque_Communes/affichageRecurrent.php"); //

class ContConnexion_administration extends Controleurgenerique
{
    public function __construct()
    {
        $this->vue = new VueConnexion_administration;
        $this->modele = new Modele_Connexion_Generique;
        $this->action = (isset($_GET['action']) ? $_GET['action'] : 'connexion');
    }

    //execution qui est appelle dans le mod_connexion
    public function exec()
    {
        switch ($this->action) {

                ////////////////////////////////////////////////// CONNEXION ///////////////////////////////////////////////////////
            case 'connexion':
                $this->afficherFormulaireConnexion_administration();
                if (isset($_GET['errorConnexion'])) {  // verification pour voir si la connexion c'est mal passé
                    $this->affichageCompteInexsistant();
                } elseif (isset($_GET['erroDeconnexion'])) {
                    $this->affichageDeconnexionImpossible();
                } elseif (isset($_GET['DeconnexionReussite'])) {
                    $this->affichageDeconnexion();
                }
                break;

            case 'connexionidentifiant':
                if ($this->insereDonneConnexion()) {
                    $this->affichageConnexionReussie(); // mettre cette fonction dans mod principale
                    header('Location: ./index.php?module=gestionUseur&action=gestionUseur&page=1&connexionReussit=true'); //redirection vers la page 
                } else {
                    header('Location: ./index.php?module=administration&action=connexion&errorConnexion=true'); //redirection vers la page 
                }
                break;

                ////////////////////////////////////////////////// DECONNEXION ///////////////////////////////////////////////////////
            case 'deconnexion':
                if ($this->deconnexion()) {
                    header('Location: ./index.php?module=administration&DeconnexionReussite=true');
                } else {
                    header('Location: ./index.php?module=administration&action=connexion&erroDeconnexion=true');
                }
                break;
            default:
                die(affichage_erreur404_admin());
        }
    }

    ////////////////////////////////////////////////// CONNEXION ///////////////////////////////////////////////////////

    public function afficherFormulaireConnexion_administration()
    {
        creation_token();
        $this->vue->form_connexion_administration();
    }

    public function insereDonneConnexion()
    {
        return  $this->modele->verificationConnexion(2);
    }

    public function affichageCompteInexsistant()
    { //toasts
        $this->vue->compteInexsistant();
    }

    public function affichageConnexionReussie()
    {  //toasts

        $this->vue->affichageConnexionReussie();  //toasts
    }

    ////////////////////////////////////////////////// DECONNEXION ///////////////////////////////////////////////////////

    public function affichageDeco()
    {
        $this->vue->deconnexion();
    }

    public function deconnexion()
    {
        return  $this->modele->deconnexionM();
    }

    public function affichageDeconnexion()
    {
        $this->vue->affichageDeconnexion();  //toasts
    }

    public function affichageDeconnexionImpossible()
    {
        $this->vue->affichageDeconnexionImpossible();  //toasts
    }
}
/*
Version 1.0 - 2022/11/30
GNU GPL  Copyleft (C inversé) 2023-2033
Initiated by Hamidi.Yassine,Chouchane.Rayan,Claude.Aldric
Web Site = http://localhost/A2Z/src/index.php?module=connexion&action=connexion 
*/
?>