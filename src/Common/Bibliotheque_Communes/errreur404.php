<?php

require_once("./Common/Bibliotheque_Communes/errreur404.php");
if (constant("a2z") != "rya")
    die(affichage_erreur404());

function affichage_erreur404()
{
?>
    <link rel="stylesheet" href="Style_css/erreur404.css">
    <h1>Erreur 404</h1>
    <p class="zoom-area"><b>A2Z</b> Page Inconnu </p>
    <section class="error-container">
        <span class="four"><span class="screen-reader-text">4</span></span>
        <span class="zero"><span class="screen-reader-text">0</span></span>
        <span class="four"><span class="screen-reader-text">4</span></span>
    </section>
    <div class="link-container">
        <a href="index.php?module=connexion&action=connexion" class="more-link">Retour à la page d'accueil</a>
    </div>
<?php

}

function affichage_erreur404_admin()
{
?>
    <link rel="stylesheet" href="Style_css/erreur404.css">
    <h1>Erreur 404</h1>
    <p class="zoom-area"><b>A2Z</b> Page Inconnu </p>
    <section class="error-container">
        <span class="four"><span class="screen-reader-text">4</span></span>
        <span class="zero"><span class="screen-reader-text">0</span></span>
        <span class="four"><span class="screen-reader-text">4</span></span>
    </section>
    <div class="link-container">
        <a href="index.php?module=administration&action=connexion" class="more-link">Retour à la page d'accueil</a>
    </div>
<?php

}

/*
Version 1.0 - 2022/11/30
GNU GPL  Copyleft (C inversé) 2023-2033
Initiated by Hamidi.Yassine,Chouchane.Rayan,Claude.Aldric
Web Site = http://localhost/A2Z/src/index.php?module=connexion&action=connexion 
*/
?>