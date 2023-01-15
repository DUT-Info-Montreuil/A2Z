<?php

require_once("./Common/Bibliotheque_Communes/errreur404.php");
if (constant("a2z") != "rya")
    die(affichage_erreur404());

require_once "./Common/Classe_Generique/vue_generique.php";

class Vue_footer extends Vue_Generique
{

    public function  __construct()
    {
        parent::__construct(); // comme un super
    }
    //fonction pour l'affichage du Footer
    function footerHabillage()
    {
?>
        <footer class="footer-distributed">
            <div class="conteneurFooter">
                <div class="footer-left">
                    <p class="footer-links balise_p_generique">
                        <a class="link-1" href="index.php?module=favoris&location=1">Accueil</a> <!-- Changer ici l'action une fois page acceuil finie-->

                        <a href="index.php?module=principale">Fiches publiques</a>

                        <a href="index.php?module=compte&action=affichageInfoCompte">Profil</a>

                        <a href="index.php?module=principale">Contact</a>
                    </p>
                    <p class="balise_p_generique"> &copy;A2Z 2022</p>
                </div>

            </div>
        </footer>
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