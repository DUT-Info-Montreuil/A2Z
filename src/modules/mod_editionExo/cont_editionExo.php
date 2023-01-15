<?php

require_once("./Common/Bibliotheque_Communes/errreur404.php");
if (constant("a2z") != "rya")
    die(affichage_erreur404());

require_once "./modules/mod_editionExo/vue_editionExo.php";
require_once "./modules/mod_editionExo/modele_editionExo.php";

class ContEditionExo extends Controleurgenerique
{
    public function __construct()
    {
        $this->vue = new VueEdition;
        $this->modele = new ModeleEditionExo;
        $this->action = (isset($_GET['action']) ? $_GET['action'] : 'editionExo');
        $this->afficheImageEnregistrer();
    }

    //execution qui est appelle dans le mod_connexion
    public function exec()
    {
        switch ($this->action) {

                ////////////////////////////////////////////////// INSCRIPTION ///////////////////////////////////////////////////////
            case 'editionExo':
                if (isset($_GET['idFiche'])) {
                    if (!$this->verificationDroitAccesFiche()) { //Sécurisation pour éviter d'accéder à des fiches inconnue ou appartenant à quelqu'un 
                        die(affichage_erreur404());
                    }
                    $this->affichagePageEditionExo();
                }

                break;
            default:
                die(affichage_erreur404());
        }
    }

    public function afficheImageEnregistrer()
    {
?>
        <script src="Script_js/import_photos.js"></script>

        <script>
            affichageImageEnregistrer()
        </script>
<?php
    }

    public function affichagePageEditionExo()
    {
        $tableauExercice = $this->modele->recupererExercices();
        $tableauImage = $this->modele->recupererImages();
        $this->vue->pageExoEdition($tableauExercice, $tableauImage);
    }

    public function verificationDroitAccesFiche()
    {
        return $this->modele->verificationDroitAccesFiche();
    }

    public function recupererExercices()
    {
        return  $this->modele->recupererExercices();
    }
}
/*
Version 1.0 - 2022/11/30
GNU GPL  Copyleft (C inversé) 2023-2033
Initiated by Hamidi.Yassine,Chouchane.Rayan,Claude.Aldric
Web Site = http://localhost/A2Z/src/index.php?module=connexion&action=connexion 
*/
?>