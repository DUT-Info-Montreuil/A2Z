<?php

session_start();
define('SITE_ROOT',__DIR__);

require_once "connexion.php";
require_once "modules/mod_connexion/mod_connexion.php";
require_once "modules/mod_principale/mod_principale.php";
require_once "./modules/mod_favoris/mod_favoris.php";


connexion::initConnexion(); // On l’appelle donc sur une classe, et non sur un objet instancié.



$_GET['module'] = isset($_GET['module']) ? $_GET['module'] : 'acceuil';


switch ($_GET['module']) {

    case "acceuil":
        echo "  <a href=\"index.php?module=acceuil\">acceuil</a> </br> ";
        echo "  <a href=\"index.php?module=connexion&action=menue\">Mod Connexion</a> </br> ";
        echo "  <a href=\"index.php?module=principale\">Mod Habillage</a> </br> ";

        break;

        case "connexion":
        $module = new ModConnexion();
        break;

        case "principale":
        $module = new ModPrincipale();
        break;

        case "favoris":
        $module = new ModFavoris();
        break;
        
}
?>
