<?php

require_once "vue_compte.php";
require_once "modele_compte.php";

class ContCompte
{

    private $modele;
    private $action;

    public function __construct()
    {
        $this->vue = new VueCompte;
        $this->modele = new ModeleCompte;

        // ? veutr dire if  
        // : veut dire else  
        $this->action = (isset($_GET['action']) ? $_GET['action'] : 'affichageInfoCompte');
    }

    //execution qui est appelle dans le mod_compte
    public function exec()
    {
        switch ($this->action) {

            case 'affichageInfoCompte':
                //affichage global des infos 
                $this->affichageInformationsCompte();
                if (isset($_GET['changementId'])) {  // verification pour voir si la connexion c'est mal passé
                    $this->affichageChangementIdentifiantReussit();
                } elseif (isset($_GET['changementIdFaux'])) {
                    $this->affichageChangementIdentifiantFaux();
                } elseif (isset($_GET['changementAdresseMail'])) {
                    $this->affichageChangementAdresseMailReussit();
                } elseif (isset($_GET['changementAdresseMailFaux'])) {
                    $this->affichageChangementAdresseMailFaux();
                } elseif (isset($_GET['changementMDP'])) {
                    $this->affichageChangementMDP();
                } elseif (isset($_GET['changementPhoto'])) {
                    $this->affichageChangementPhoto();
                } elseif (isset($_GET['PasImage'])) {
                    $this->affichageChangementImageRate();
                } elseif (isset($_GET['ImageTropGrande'])) {
                    $this->affichageImageTropGrande();
                } elseif (isset($_GET['ErreurTansfert'])) {
                    $this->affichageErreurTansfertImage();
                }
                break;

            case 'miseAJourIdentifiant':
                $this->affichageFormulaireModificationIdentifiant();

                break;

            case 'changementIdentifiant':

                if ($this->changementIdentifiant()) {
                    header('Location: ./index.php?module=compte&action=affichageInfoCompte&changementId=true;'); //redirection vers la page 
                } else //ici l'identifiante xiste déja
                    header('Location: ./index.php?module=compte&action=affichageInfoCompte&changementIdFaux=true;'); //redirection vers la page 
                break;

            case 'miseAJourMotDePasse':
                $this->affichageFormulaireModificationMotDePasse();
                break;

            case 'changementMotDePasse':
                if ($this->changementMotDePasse()) {
                    header('Location: ./index.php?module=compte&action=affichageInfoCompte&changementMDP=true;'); //redirection vers la page 
                }
                break;

            case 'miseAJourEmail':
                $this->affichageFormulaireModificationEmail();
                break;

            case 'changementAdresseMail':
                if ($this->changementAdresseMail()) {
                    header('Location: ./index.php?module=compte&action=affichageInfoCompte&changementAdresseMail=true;'); //redirection vers la page 
                } else //ici l'identifiante xiste déja
                    header('Location: ./index.php?module=compte&action=affichageInfoCompte&changementAdresseMailFaux=true;'); //redirection vers la page 
                break;

            case 'miseAJourPhotoDeProfile':
                $this->affichageChangementPhotoDeProfile();
                break;

            case 'changementPhotoDeProfile':
                $this->changementPhotoDeProfile();
                break;
        }
    }

    /////////////////////////////// Informations Compte//////////////////////////////////////

    public function affichageInformationsCompte()
    {
        $identifiant = $this->modele->recuperationInfoCompte()["identifiant"];
        $motDePasse = $this->modele->recuperationInfoCompte()["motDePasse"];
        $adresseMail = $this->modele->recuperationInfoCompte()["adresseMail"];
        $this->vue->affichageInfoCompte($identifiant, $motDePasse, $adresseMail);
    }

    ///////////////////////////////Identifiant//////////////////////////////////////

    public function affichageFormulaireModificationIdentifiant()
    {
        $this->vue->form_modification_compte_identifiant();
    }

    public function changementIdentifiant()
    {
        return $this->modele->changerIdentifiant();
    }
    ///////////////////////////////MotDePasse//////////////////////////////////////

    public function affichageFormulaireModificationMotDePasse()
    {
        $this->vue->form_modification_compte_mot_de_passe();
    }

    public function changementMotDePasse()
    {
        return $this->modele->changerMotDePasse();
    }
    ///////////////////////////////Adresse Mail//////////////////////////////////////
    public function changementAdresseMail()
    {
        return $this->modele->changerAdresseMail();
    }

    public function affichageFormulaireModificationEmail()
    {
        $this->vue->form_modification_compte_adressemail();
    }

    ///////////////////////////////Photo de Profile//////////////////////////////////////

    public function affichageChangementPhotoDeProfile()
    {
        $image = $this->modele->recuperationInfoCompte()["cheminImage"];

        $this->vue->modifiactionPhotoDeProfile($image);
    }

    //ici en fonction de ce que nous renvoie  recupererImage() on traite si c'est une erreur ou pas 
    public function changementPhotoDeProfile()
    {
        $image = $this->modele->recupereImage();

        switch ($image) {

            case 1; // erreur lors du transfert
                header('Location: ./index.php?module=compte&action=affichageInfoCompte&ErreurTansfert=true;'); //redirection vers la page  affichageInfoCompte
                break;

            case 2;  //taille trop grande
                header('Location: ./index.php?module=compte&action=affichageInfoCompte&ImageTropGrande=true;'); //redirection vers la page  affichageInfoCompte
                break;

            case 3; //fichier pas une image
                header('Location: ./index.php?module=compte&action=affichageInfoCompte&PasImage=true;'); //redirection vers la page  affichageInfoCompte
                break;

            default:
                $this->modele->changementPhoto($image);
                header('Location: ./index.php?module=compte&action=affichageInfoCompte&changementPhoto=true;'); //redirection vers la page affichageInfoCompte

        }
    }
    //////////////////////////Affichage des Toast pour les Informations générales //////////////////////////////////////

    public function affichageChangementImageRate()
    {
        $this->vue->affichageChangementImageRate();
    }

    public function affichageChangementIdentifiantReussit()
    {
        $this->vue->affichageChangementIdentifiant();
    }
    public function affichageChangementIdentifiantFaux()
    {
        $this->vue->affichageChangementIdentifiantFaux();
    }

    public function affichageChangementAdresseMailReussit()
    {
        $this->vue->affichageChangementAdresseMailReussit();
    }

    public function affichageChangementAdresseMailFaux()
    {
        $this->vue->affichageChangementAdresseMailFaux();
    }

    public function affichageChangementMDP()
    {
        $this->vue->affichageChangementMDP();
    }

    public function affichageChangementPhoto()
    {
        $this->vue->affichageChangementPhoto();
    }

    public function affichageImageTropGrande()
    {
        $this->vue->affichageImageTropGrande();
    }

    public function affichageErreurTansfertImage()
    {
        $this->vue->affichageErreurTansfertImage();
    }
}
