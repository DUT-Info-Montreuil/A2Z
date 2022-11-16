<?php
require_once "./vue_generique.php";

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
                                <img class="logo" src="ressource/images/TabA2Z.png" width="64" height="64">
                            </a>

                        <?php } elseif (isset($_SESSION["identifiant"])) {
                        ?>
                            <a href="index.php?module=principale">
                                <img class="logo" src="ressource/images/TabA2Z.png" width="64" height="64">
                            </a>
                        <?php } ?>

                        <div class="navigation">
                            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                                    <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                                        <use xlink:href="#bootstrap" />
                                    </svg>
                                </a>

                                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                                    <li><a href="#" class="nav-link px-2 text-white">Contact </a></li>
                                    <li><a href="#" class="nav-link px-2 text-white">Respect de la vie privée</a></li>
                                    <li><a href="#" class="nav-link px-2 text-white">A propos de</a></li>
                                </ul>



                                <div class="text-end">

                                    <?php
                                    //ici on verifie si on est sur la page inscription si c'est le cas alors on affiche pas le bouton sinon on l'affiche
                                    if (isset(($_GET['action'])) && !($_GET['action'] == "inscription") && (!isset($_SESSION['identifiant']))) {
                                    ?>
                                        <a href="index.php?module=connexion&action=inscription"><button type="button" class="btn btn-warning">Inscription</button>
                                        <?php
                                    }
                                    //ici on verifie si on est conencter si oui alors on change le bouton conencter par deconnexion
                                    else if ((!isset($_SESSION['identifiant'])) && isset(($_GET['action'])) && $_GET['action'] != "connexion") {
                                        ?>
                                            <a href="index.php?module=connexion&action=connexion"><button type="button" class="btn btn-outline-light me-2">Connexion</button>
                                            <?php
                                        } else if (!isset(($_GET['action']))) {
                                            ?>
                                                <a href="index.php?module=connexion&action=inscription"><button type="button" class="btn btn-warning">Inscription</button>
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
?>