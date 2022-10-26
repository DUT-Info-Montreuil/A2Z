<?php

require_once "vue_connexion.php";
require_once "modele_connexion.php";

class ContConnexion
{

    public function __construct()
    {
        $this->vue = new VueConnexion;
        $this->modele = new ModeleConnexion;

        // ? veutr dire if  
        // : veut dire else  
        $this->action = (isset($_GET['action']) ? $_GET['action'] : 'bienvenue');
    }


    public function getAction(){
        return $this->action;
    }

    public function exec()
    {
        $this->vue->menu();
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

    public function affichageInscriptionReussite (){
        $this->vue->inscription();  //toasts
    }

    public function affichageAdreMailUtiliser(){
        $this->vue->adresseMailUtilise();  //toasts
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

    public function affichageCompteInexsistant(){ //toasts
        $this->vue->compteInexsistant();
    }

    public function affichageConnexionReussie(){  //toasts
        $this->vue->connexionReussi();
    }

  ////////////////////////////////////////////////// DECONNEXION ///////////////////////////////////////////////////////

  public function affichageDeco(){
        $this->vue->deconnexion();
    }

    public function deconnexion(){
       return  $this->modele->deconnexionM();
    }

    public function affichageDeconnexion(){
        $this->vue->deconnexion();  //toasts
    }

    public function affichageDeconnexionImpossible(){
        $this->vue->deconnexionImpossible();
    }

    ////////////////////////////////////////////////// NAVBAR FOOTER ///////////////////////////////////////////////////////

    public function affichageNavBar(){
        $this->vue->navBarConnexion();
    }    
}
