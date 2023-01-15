<?php

session_start();
define('SITE_ROOT', __DIR__);
define("a2z", "rya"); //définition d'une constante pour vérifier ensuite quand on accède au fichier 
// ,qu'on soit bien passé par l'index

require_once "connexion.php";
require_once("./Common/Classe_Generique/vue_generique.php");
require_once("controleur/controleur.php");
require_once("controleur/controleur_administration.php");
require_once("./Common/Classe_Generique/controleur_generique.php"); //on le fait ici car il est utilisé par plusiseur controleur
require_once("./verificationAdmin.php");

Connexion::initConnexion();

//Pour la partie Admin
if (VerifAdmin::verificationConnexionAdmin()) {
    $controleur = new Controleur_administration();
    require_once("./Template/template_Administrateur.php"); //affichage du site 
}
//Pour la partie Useur
else {
    $controleur = new Controleur();
    require_once("./Template/template.php"); //affichage du site 
}

/*
Version 1.0 - 2022/11/30
GNU GPL  Copyleft (C inversé) 2023-2033
Initiated by Hamidi.Yassine,Chouchane.Rayan,Claude.Aldric
Web Site = http://localhost/A2Z/src/index.php?module=connexion&action=connexion 
*/
?>