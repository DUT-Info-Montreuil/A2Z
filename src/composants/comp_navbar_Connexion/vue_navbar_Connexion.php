<?php

require_once("./Common/Bibliotheque_Communes/errreur404.php");
if (constant("a2z") != "rya")
    die(affichage_erreur404());

require_once "./Common/Classe_Generique/vue_generique.php";

class Vue_navbar_Connexion extends Vue_Generique
{

    public function  __construct()
    {
        parent::__construct(); // comme un super
    }
    //fonction pour l'affichage de la nav bar

    function navBarHabillage()
    {
?>
        <nav>
            <div class="p-3 text-bg-dark">
                <div class="container">
                    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                        <?php if (!isset($_SESSION["identifiant"])) {
                        ?>
                            <a href="index.php?module=connexion&action=connexion">
                                <img class="logo" src="ressource/images/TabA2Z.png" alt="logo Site" width="64" height="64">
                            </a>

                        <?php } elseif (isset($_SESSION["identifiant"])) {
                        ?>
                            <a href="index.php?module=principale">
                                <img class="logo" src="ressource/images/TabA2Z.png" alt="logo Site" width="64" height="64">
                            </a>
                        <?php } ?>

                        <div class="navigation">
                            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                                    <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                                        <use xlink:href="#bootstrap" />
                                    </svg>
                                </a>
                                <div class="text-end">
                                    <?php
                                    //ici on verifie si on est sur la page inscription si c'est le cas alors on affiche pas le bouton sinon on l'affiche
                                    if (isset(($_GET['action'])) && !($_GET['action'] == "inscription") && (!isset($_SESSION['identifiant']))) {
                                    ?>
                                        <button onclick="window.location.href = 'index.php?module=connexion&action=inscription'" type="button" class="btn btn-warning">Inscription</button>
                                        <button onclick="window.location.href = 'index.php?module=administration'" type="button" class="btn btn-outline-light me-2">Administration</button>
                                    <?php
                                    }
                                    //ici on verifie si on est conencter si oui alors on change le bouton conencter par deconnexion
                                    else if ((!isset($_SESSION['identifiant'])) && isset(($_GET['action'])) && $_GET['action'] != "connexion") {
                                    ?>
                                        <button onclick="window.location.href = 'index.php?module=connexion&action=connexion'" type="button" class="btn btn-warning">Connexion</button>
                                        <button onclick="window.location.href = 'index.php?module=administration'" type="button" class="btn btn-outline-light me-2">Administration</button>
                                    <?php
                                    }
                                    //Pour la page admini on met connexion et inscription
                                    else if (!isset(($_GET['action']))) {
                                    ?>
                                        <button onclick="window.location.href = 'index.php?module=connexion&action=inscription'" type="button" class="btn btn-warning">Inscription</button>
                                        <button onclick="window.location.href = 'index.php?module=connexion&action=connexion'" type="button" class="btn btn-outline-light me-2">Connexion</button>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
<?php
    }
}
/*
Version 1.0 - 2022/11/30
GNU GPL  Copyleft (C inversé) 2023-2033
Initiated by Hamidi.Yassine,Chouchane.Rayan,Claude.Aldric
Web Site = http://localhost/A2Z/src/index.php?module=connexion&action=connexion 
*/
?>