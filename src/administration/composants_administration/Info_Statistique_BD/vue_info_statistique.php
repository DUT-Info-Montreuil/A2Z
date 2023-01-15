<?php

require_once("./Common/Bibliotheque_Communes/errreur404.php");
if (constant("a2z") != "rya")
    die(affichage_erreur404_admin());

require_once "./Common/Classe_Generique/vue_generique.php";

class Vue_info_statistique extends Vue_Generique
{

    public function  __construct()
    {
        parent::__construct(); // comme un super
    }


    function affichage_info_statistique($statUseur)
    {

?>
        <div class="container">

            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-pattern">
                        <div class="card-body">
                            <div class="float-right">
                                <i class="fa fa-th text-primary h4 ml-3"></i>
                            </div>
                            <h5 class="font-size-20 mt-0 pt-1"><?php echo $statUseur[2]['userNumber'] ?></h5>
                            <p class="text-muted mb-0">Total des Utilisateurs</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-pattern">
                        <div class="card-body">
                            <div class="float-right">
                                <i class="fa fa-th text-primary h4 ml-3"></i>
                            </div>
                            <h5 class="font-size-20 mt-0 pt-1"><?php echo $statUseur[0]['userNumber'] ?></h5>
                            <p class="text-muted mb-0">Total des Professeurs</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-pattern">
                        <div class="card-body">
                            <div class="float-right">
                                <i class="fa fa-th text-primary h4 ml-3"></i>
                            </div>
                            <h5 class="font-size-20 mt-0 pt-1"><?php echo $statUseur[1]['userNumber'] ?></h5>
                            <p class="text-muted mb-0">Total des Administrateurs</p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card bg-pattern">
                        <div class="card-body">
                            <div class="float-right">
                                <i class="fa fa-th text-primary h4 ml-3"></i>
                            </div>
                            <h5 class="font-size-20 mt-0 pt-1"><?php echo $statUseur[3]['userNumber'] ?></h5>
                            <p class="text-muted mb-0">Total des Fiches</p>
                        </div>
                    </div>
                </div>
                <!--
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form>
                            <div class="form-group mb-0">
                                <label>Rechercher</label>
                                <div class="input-group mb-0">
                                    <input type="text" class="form-control" data-action="filter" data-filters="#dev-table" placeholder="Rechercher..." aria-describedby="project-search-addon" />
                                    <div class="input-group-append">
                                        <button class="btn btn-danger" type="button" id="project-search-addon"><i class="fa fa-search search-icon font-12"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    -->
            </div>
        </div>
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