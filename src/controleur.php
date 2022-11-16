<?php
class Controleur
{
    private $modele;
    private $module;
    public $resultat;
    public function __construct()
    {
        require_once("modele.php"); // pour les Faille include 
        $this->modele = new Modele();
        $this->module = isset($_GET['module']) ? $_GET['module'] : 'connexion';
        $this->exec();
    }

    public function exec()
    {

        switch ($this->module) {

            case "connexion":
                require_once "modules/mod_connexion/mod_connexion.php"; // pour les Faille include 
                $this->module = new ModConnexion();
                break;

            case "compte":
                if (isset($_SESSION["identifiant"])) {  //page accessible uniquement si on est connecter
                    require_once "modules/mod_compte/mod_compte.php"; // pour les Faille include 
                    $this->module = new ModCompte();
                } else {
                    echo "connecte toi d'abord";
                }
                break;

            case "principale":
                if (isset($_SESSION["identifiant"])) {  //page accessible uniquement si on est connecter
                    require_once "modules/mod_principale/mod_principale.php"; // pour les Faille include 
                $this->module= new ModPrincipale();
                }
                else {
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
            default:
                die("Module inconnu");//on peut changer l'affichage ici
        }
        if (isset($_SESSION["identifiant"])) {
            $this->resultat = $this->module->getControleur()->vue->affichageTampon();
        }
    }
}
