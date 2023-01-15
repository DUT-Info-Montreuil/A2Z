<?php

require_once("./Common/Bibliotheque_Communes/errreur404.php");
if (constant("a2z") != "rya")
    die(affichage_erreur404());

require_once "vue_connexion.php";
require_once "modele_connexion.php";
require_once("./Common/Bibliotheque_Communes/Verification_Creation_Token.php");
require_once("./Common/Bibliotheque_Communes/affichageRecurrent.php"); //

class ContConnexion extends Controleurgenerique
{

    public function __construct()
    {
        $this->vue = new VueConnexion;
        $this->modele = new ModeleConnexion;
        $this->action = (isset($_GET['action']) ? $_GET['action'] : 'connexion');
    }

    //execution qui est appelle dans le mod_connexion
    public function exec()
    {
        switch ($this->action) {

                ////////////////////////////////////////////////// INSCRIPTION ///////////////////////////////////////////////////////
            case 'inscription':
                $this->affichageFormulaireInscription();
                if (isset($_GET['errorInscription'])) {  // verification pour voir si la connexion c'est mal passé
                    $this->affichageAdreMailUtiliser();
                } elseif (isset($_GET['errorMotDePasseDifferents'])) {  // verification pour voir si la connexion c'est mal passé
                    affichagMotDePasseDifferent();
                }

                break;

            case 'creationCompte':
                $resultatInsereDonneInscription = $this->insereDonneInscription();

                if ($resultatInsereDonneInscription == 4) {
                    header('Location: ./index.php?module=connexion&action=connexion&InscriptionReussi=true'); //redirection vers la page 
                } else if ($resultatInsereDonneInscription == 3) {
                    header('Location: ./index.php?module=connexion&action=inscription&errorInscription=true'); //redirection vers la page 
                } else if ($resultatInsereDonneInscription == 2) {
                    header('Location: ./index.php?module=connexion&action=inscription&errorMotDePasseDifferents=true'); //redirection vers la page 
                }
                break;

                ////////////////////////////////////////////////// CONNEXION ///////////////////////////////////////////////////////
            case 'connexion':
                $this->afficherFormulaireConnexion();
                if (isset($_GET['errorConnexion'])) {  // verification pour voir si la connexion c'est mal passé
                    $this->affichageCompteInexsistant();
                } elseif (isset($_GET['erroDeconnexion'])) {
                    $this->affichageDeconnexionImpossible();
                } elseif (isset($_GET['DeconnexionReussite'])) {
                    $this->affichageDeconnexion();
                } elseif (isset($_GET['InscriptionReussi'])) {
                    $this->affichageInscriptionReussite();
                } elseif (isset($_GET['SuppresionCompte'])) {
                    $this->SuppresionCompte();
                }

                break;

            case 'connexionidentifiant':
                if ($this->insereDonneConnexion()) {
                    $this->affichageConnexionReussie(); // mettre cette fonction dans mod principale
                    //header('Location: ./index.php?module=editionExo&connexion=true&idFiche=1')
                    header('Location: ./index.php?module=favoris&location=1'); //redirection vers la page 
                } else {
                    header('Location: ./index.php?module=connexion&action=connexion&errorConnexion=true'); //redirection vers la page 
                }
                break;

                ////////////////////////////////////////////////// DECONNEXION ///////////////////////////////////////////////////////
            case 'deconnexion':
                if ($this->deconnexion()) {
                    header('Location: ./index.php?module=connexion&action=connexion&DeconnexionReussite=true');
                } else {
                    header('Location: ./index.php?module=connexion&action=connexion&erroDeconnexion=true');
                }
                break;
            default:
                die(affichage_erreur404());
        }
    }

    ////////////////////////////////////////////////// INSCRIPTION ///////////////////////////////////////////////////////

    public function affichageFormulaireInscription()
    {
        creation_token();
        $this->vue->form_inscription();
    }

    public function insereDonneInscription()
    {
        return  $this->modele->insereInscription();
    }

    public function affichageInscriptionReussite()
    {
        $this->vue->affichageInscriptionReussite();  //toasts
    }

    public function affichageAdreMailUtiliser()
    {
        $this->vue->affichageAdreMailUtiliser();  //toasts
    }


    ////////////////////////////////////////////////// CONNEXION ///////////////////////////////////////////////////////

    public function afficherFormulaireConnexion()
    {
        creation_token();
        $this->vue->form_connexion();
    }

    public function insereDonneConnexion()
    {
        return  $this->modele->verificationConnexion(1);
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

    public function SuppresionCompte()
    {
        $this->vue->SuppresionCompte();  //toasts
    }
}
/*
Version 1.0 - 2022/11/30
GNU GPL  Copyleft (C inversé) 2023-2033
Initiated by Hamidi.Yassine,Chouchane.Rayan,Claude.Aldric
Web Site = http://localhost/A2Z/src/index.php?module=connexion&action=connexion 
*/
?>