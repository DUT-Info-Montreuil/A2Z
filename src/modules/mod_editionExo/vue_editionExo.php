<?php

require_once("./Common/Bibliotheque_Communes/errreur404.php");
if (constant("a2z") != "rya")
    die(affichage_erreur404());

require_once("./Common/Classe_Generique/vue_connexion_generique.php");

class VueEdition extends Vue_connexion_generique
{ //fonction pour l'affichage de la nav bar

    public function  __construct()
    {
        parent::__construct(); // comme un super
    }

    function pageExoEdition($tableauExercice, $tableauImage)
    {
?>

        <title> Edition Fiche | A2Z</title>


        <div class="flex-container" id="conteneurPageEdition">

            <div class="flex-row" id="conteneurPageA4">


                <!--Accordeon-->

                <div class="flex-col-md-6" id="accordeonGauche">

                    <div class="panel">

                        <input type="radio" class="acc" id="tab-1" name="tabs">
                        <label class="labelEditionExo" for="tab-1">
                            <div class="cross-box"><span class="cross">
                            </div>
                            <span class="accordion-heading" id="myElement">Mise en page</span>
                        </label>

                        <div class="questions">

                            <div class="question-wrap">
                                <input type="radio" class="acc" id="question-7" name="question">
                                <label class="labelEditionExo" for="question-7">
                                    <div class="cross-box"><span class="cross"></span></div><span class="accordion-heading">Entête</span>
                                </label>
                                <div class="content">
                                    <li class="ui-state-highlight listeDeroulante draggable Entete">Entête</li>

                                </div>
                            </div>
                        </div>
                        <div class="questions">

                            <div class="question-wrap">
                                <input type="radio" class="acc" id="question-6" name="question">
                                <label class="labelEditionExo" for="question-6">
                                    <div class="cross-box"><span class="cross"></span></div><span class="accordion-heading">Consigne</span>
                                </label>
                                <div class="content">
                                    <li class="ui-state-highlight listeDeroulante draggable consigne">Consigne</li>
                                </div>
                            </div>
                        </div>
                    </div>





                    <div class="panel">
                        <input type="radio" class="acc" id="tab-2" name="tabs">
                        <label class="labelEditionExo" for="tab-2">
                            <div class="cross-box"><span class="cross"></span></div><span class="accordion-heading">Catégorie</span>
                        </label>

                        <div class="questions">

                            <div class="question-wrap">
                                <input type="radio" class="acc" id="question-1" name="question">
                                <label class="labelEditionExo" for="question-1">
                                    <div class="cross-box"><span class="cross"></span></div><span class="accordion-heading">Principe alphabétique</span>
                                </label>
                                <div class="content">

                                    <li class="ui-state-highlight listeDeroulante draggable exoVraiouFaux">Vrai ou Faux ?</li>
                                </div>
                            </div>

                            <div class="question-wrap">
                                <input type="radio" class="acc" id="question-2" name="question">
                                <label class="labelEditionExo" for="question-2">
                                    <div class="cross-box"><span class="cross"></span></div><span class="accordion-heading">Conscience phonologique</span>
                                </label>
                                <div class="content">
                                    <li class="ui-state-highlight listeDeroulante draggable repondParPhrase">Phrase simple</li>

                                </div>
                            </div>

                            <div class="question-wrap">
                                <input type="radio" class="acc" id="question-3" name="question">
                                <label class="labelEditionExo" for="question-3">
                                    <div class="cross-box"><span class="cross"></span></div><span class="accordion-heading">Décodage</span>
                                </label>
                                <div class="content">
                                    <li class="ui-state-highlight listeDeroulante draggable entoureMots">Entoure Les Mots</li>
                                </div>
                                <div class="content">
                                    <li class="ui-state-highlight listeDeroulante draggable entoureMots">Entoure Les Mots</li>
                                </div>
                            </div>

                            <div class="question-wrap">
                                <input type="radio" class="acc" id="question-4" name="question">
                                <label class="labelEditionExo" for="question-4">
                                    <div class="cross-box"><span class="cross"></span></div><span class="accordion-heading">Encodage</span>
                                </label>
                                <div class="content">
                                    <li class="ui-state-highlight listeDeroulante draggable continuePhrase">Colorie la bonne Phrase</li>
                                </div>

                            </div>
                            <div class="question-wrap">
                                <input type="radio" class="acc" id="question-5" name="question">
                                <label class="labelEditionExo" for="question-5">
                                    <div class="cross-box"><span class="cross"></span></div><span class="accordion-heading">Copie</span>
                                </label>
                            </div>


                        </div>
                    </div>




                    <div class="panel" id="divImages">
                        <input type="radio" class="acc" id="tab-3" name="tabs">
                        <label class="labelEditionExo" for="tab-3">
                            <div class="cross-box"><span class="cross"></span></div>
                            <span class="accordion-heading">Banque d'image</span>
                        </label>

                        <div class="content">
                            <form action="" class="search-bar"><!--  Mettre la bonne action -->
                                <input type="search" id="barreDeRechercheImages" name="search" pattern=".*\S.*" required value="">

                                <script src="Script_js/import_photos.js"></script>
                                <script type="text/javascript">
                                    recherche()
                                </script>


                            </form>
                            <button class="custom-btn btn-15" id="BoutonImportPhoto" onclick="importerImage()">Importer une image!</button>

                            <!--  <input type="file" id="image-input" accept="image/*"></input> -->

                            <script src="Script_js/import_photos.js"></script>

                            <table class="tableImage">
                                <tbody class="conteneurPhotos">


                                </tbody>

                            </table>

                        </div>


                    </div>



                </div>
                <!--Fin Accordeon-->


                <!--Page-->

                <div id="divpage">

                    <div id="modifieurs">
                        <div class="select">
                            <select id="input-font" class="input button-34" onchange="changeAll(this);">

                                <option value="arial">Arial</option>
                                <option value="cursive">cursive</option>
                            </select>

                        </div>
                        <div id="button">
                            <button id="up" class="button-34" onclick="GetSelection()">+</button>
                            <button id="down" class="button-34">-</button>

                            <button id="getPDF" class="button-34" onclick="getPDF()">Telecharger page en PDF</button>
                            <button id="save" class="button-34" onclick="tojson()"> Sauvegarder</button>
                        </div>



                    </div>


                    <page size="A4" id="page" class="sortable res zima">

                    </page>




                </div>

                <!-- Script pour insertion des exercices au chargement de la page -->
                <script src="Script_js\recuperationExo.js"></script>
                <script src="Script_js/blocageToucheEntree.js"></script>
                <script>
                    const tableauExo = `<?php echo  json_encode($tableauExercice)  ?> `; //ici on encode le tableau pour l'envoyer à JS
                    let exercice
                    <?php
                    for ($i = 0; $i < count($tableauExercice); $i++) {
                        $exercice = htmlspecialchars_decode($tableauExercice[$i]['contenu']); //on decode le htmlspecialchars pour ré avoir les chevrons
                    ?>
                        exercice = `<?php echo $exercice ?>`
                        insertionExercies(exercice)
                    <?php
                    } ?>
                </script>

            </div><!-- flex-row-->
        </div><!-- flex-container-->

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