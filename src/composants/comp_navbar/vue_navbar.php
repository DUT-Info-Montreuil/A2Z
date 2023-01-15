<?php

require_once("./Common/Bibliotheque_Communes/errreur404.php");
if (constant("a2z") != "rya")
    die(affichage_erreur404());

require_once "./Common/Classe_Generique/vue_generique.php";

class Vue_navbar extends Vue_Generique
{

    public function  __construct()
    {
        parent::__construct(); // comme un super
    }
    function navBarHabillage($image, $idFiche)
    {
?>
        <link rel="stylesheet" href="Style_css/NavBar.css">
        <nav>
            <div class="conteneur full-width full-height">
                <div class="container full-height">
                    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start full-width full-height">
                        <a href="index.php?module=favoris&location=1"> <img class="logo" alt="logo Site" src="ressource/images/TabA2Z.png" width="64" height="64"></a>
                        <div class="navigation">
                            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                                <li><a href="index.php?module=favoris&location=1" class="nav-link px-2 link-secondary">Accueil</a></li>
                                <li><a href="index.php?module=editionExo&idFiche=<?php echo $idFiche  ?>" class="nav-link px-2 link-secondary">Ma dernière fiche</a></li>
                                <li><a href="#" class="nav-link px-2 link-dark">Fiches publiques</a></li>
                            </ul>
                        </div>

                    </div>
                    <div class="photoProfil">
                        <a href="index.php?module=editionExo" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <img alt="photo de profile" src="<?php echo $image ?>" width="48" height="48" class="rounded-circle">
                        </a>
                        <ul class="dropdown-menu text-small">
                            <li><a class="dropdown-item" href="index.php?module=compte&action=affichageInfoCompte">Profil</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="index.php?module=connexion&action=deconnexion">Déconnexion</a></li>
                        </ul>
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