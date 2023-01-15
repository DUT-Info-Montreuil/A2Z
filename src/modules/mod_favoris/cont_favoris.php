<?php
require_once("./Common/Bibliotheque_Communes/errreur404.php");
if (constant("a2z") != "rya")
    die(affichage_erreur404());

require_once __DIR__ . "/vue_favoris.php";

if (isset($_POST['idDossier'])) {
    session_start();
    Connexion::initConnexion();
    $controleur = new ContFavoris();
}
class ContFavoris extends Controleurgenerique
{
    private $location;

    public function __construct()
    {

        $this->vue = new VueFavoris;
        $this->location = $_GET['location'];
        $this->afficherBoutonCreerDossier();
        $this->afficherIconeDossier();
        $this->afficheDossierRacine();
    }

    public function getLocation()
    {
        return $this->location;
    }
    public function afficheDossierRacine()
    {
?>
        <script>
            src = "Script_js\script_dossier.js"
        </script>
        <script>
            rechercheLocation()
        </script>
<?php
    }

    public function afficherBoutonCreerDossier()
    {
        $this->vue->boutonCreerDossier();
    }

    public function afficherIconeDossier()
    {
        $this->vue->affichageDossier();
    }
}
/*
Version 1.0 - 2022/11/30
GNU GPL  Copyleft (C inversé) 2023-2033
Initiated by Hamidi.Yassine,Chouchane.Rayan,Claude.Aldric
Web Site = http://localhost/A2Z/src/index.php?module=connexion&action=connexion 
*/
?>