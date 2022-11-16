<?php
require_once("modele.php");
require_once "modules/mod_connexion/mod_connexion.php";
require_once "modules/mod_compte/mod_compte.php";

require_once "modules/mod_principale/mod_principale.php";
require_once "./modules/mod_favoris/mod_favoris.php";
class Controleur
{
    private $modele;
    private $module;
    public $resultat;

    public function __construct()
    {
        require_once("modele.php");
        $this->modele = new Modele();
        $this->module = isset($_GET['module']) ? $_GET['module'] : 'connexion';
        $this->exec();
    }

    public function exec()
    {

        switch ($_GET['module']) {

            case "connexion":
                require_once "modules/mod_connexion/mod_connexion.php";

                $this->module = new ModConnexion();
                break;

            case "compte":
                if (isset($_SESSION["identifiant"])) {  //page accessible uniquement si on est connecter
                    require_once "modules/mod_compte/mod_compte.php";

                    $this->module = new ModCompte();
                } else {
                    echo "connecte toi d'abord";
                }
                break;

            case "principale":
                if (isset($_SESSION["identifiant"])) {  //page accessible uniquement si on est connecter

                $this->module= new ModPrincipale();
                }
                else {
                    echo "connecte toi d'abord";
                }
                break;

            case "favoris":
                if (isset($_SESSION["identifiant"])) {  //page accessible uniquement si on est connecter

                $this->module = new ModFavoris();
                }

                else {
                    echo "connecte toi d'abord";
                }
                break;
        }
        if (isset($_SESSION["identifiant"])) {
            $this->resultat = $this->module->getControleur()->vue->affichageTampon();
        }
    }
}
