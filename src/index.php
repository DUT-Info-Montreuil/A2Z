<?php

session_start();
define('SITE_ROOT',__DIR__);

require_once "connexion.php";
require_once "modules/mod_connexion/mod_connexion.php";

connexion::initConnexion(); // On l’appelle donc sur une classe, et non sur un objet instancié.



$_GET['module'] = isset($_GET['module']) ? $_GET['module'] : 'acceuil';


switch ($_GET['module']) {

    case "acceuil":
        echo "  <a href=\"index.php?module=acceuil\">acceuil</a> </br> ";
        echo "  <a href=\"index.php?module=connexion&action=menue\">Mod Connexion</a> </br> ";
        break;

        case "connexion":
        $module = new ModConnexion();
        break;
}
?>