<?php

require_once "vue_connexion.php";
require_once "modele_connexion.php";

class ContConnexion
{

    private $modele;
    private $action;

    public function __construct()
    {
        $this->vue = new VueConnexion;
        $this->modele = new ModeleConnexion;

        // ? veutr dire if  
        // : veut dire else  
        $this->action = (isset($_GET['action']) ? $_GET['action'] : 'bienvenue');
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
                }
                break;

            case 'creationCompte':
                if ($this->insereDonneInscription()) {
                    $this->affichageInscriptionReussite();
                } else {
                    header('Location: ./index.php?module=connexion&action=inscription&errorInscription=true'); //redirection vers la page 
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
                }

                break;

            case 'connexionidentifiant':
                if ($this->insereDonneConnexion()) {
                    $this->affichageConnexionReussie();
                    header('Location: ./index.php?module=principale'); //redirection vers la page 
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
        }
        $this->affichageNavBar(); //affichage constant de la navbar
    }

    ////////////////////////////////////////////////// INSCRIPTION ///////////////////////////////////////////////////////

    public function affichageFormulaireInscription()
    {
        $this->vue->form_inscription();
    }

    public function insereDonneInscription()
    {
        return  $this->modele->insereInscription();
    }

    public function affichageInscriptionReussite()
    {
        $Titre = ' Inscription Réussite';
        $Contenu = 'Bonjour ' . $_POST['identifiant'] . " et bienvenue sur A2Z la plateforme intuitive pour créer sa fiche d'exercice 😄!";
        //fonction pour l'affichage du toast "pop up" pour afficher un message de bienvenu
        $this->vue->popUpClassique($Titre, $Contenu);  //toasts
    }

    public function affichageAdreMailUtiliser()
    {
        $this->vue->affichageAdreMailUtiliser();  //toasts
    }

    ////////////////////////////////////////////////// CONNEXION ///////////////////////////////////////////////////////

    public function afficherFormulaireConnexion()
    {
        $this->vue->form_connexion();
    }

    public function insereDonneConnexion()
    {
        return  $this->modele->verificationConnexion();
    }

    public function affichageCompteInexsistant()
    { //toasts
        $this->vue->compteInexsistant();
    }

    public function affichageConnexionReussie()
    {  //toasts
        $Titre = ' Connexion Réussie 😍 !!!';
        $Contenu = 'Heureux de vous revoir ' . $_POST['identifiant'] . " sur A2Z la plateforme intuitive pour créer sa fiche d' exercice 🥰!";
        //fonction pour l'affichage du toast "pop up" pour afficher un message connexion Reussi '
        $this->vue->popUpClassique($Titre, $Contenu);  //toasts
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

    ////////////////////////////////////////////////// NAVBAR FOOTER ///////////////////////////////////////////////////////

    public function affichageNavBar()
    {
        $this->vue->navBarConnexion();
    }
}
