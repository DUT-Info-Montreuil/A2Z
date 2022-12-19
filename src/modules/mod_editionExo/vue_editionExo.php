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

    function pageExoEdition($tableauExercice)
    {
?>








        <div class="flex-container">

            <div class="flex-row">


                <!--Accordeon-->

                <div class="flex-col-md-6">

                    <div class="panel">

                        <input type="radio" class="acc" id="tab-1" name="tabs">
                        <label class="labelEditionExo" for="tab-1">
                            <div class="cross-box"><span class="cross">
                            </div>
                            <span class="accordion-heading" id="myElement">Mise en page</span>
                        </label>


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

                                    <li class="ui-state-highlight listeDeroulante draggable exoVraiFaux">Vrai ou Faux ?</li>
                                </div>
                            </div>

                            <div class="question-wrap">
                                <input type="radio" class="acc" id="question-2" name="question">
                                <label class="labelEditionExo" for="question-2">
                                    <div class="cross-box"><span class="cross"></span></div><span class="accordion-heading">Conscience phonologique</span>
                                </label>
                                <div class="content">
                                    <li class="ui-state-highlight listeDeroulante draggable exoAutre">Vrai ou Faux ?</li>

                                </div>
                            </div>

                            <div class="question-wrap">
                                <input type="radio" class="acc" id="question-3" name="question">
                                <label class="labelEditionExo" for="question-3">
                                    <div class="cross-box"><span class="cross"></span></div><span class="accordion-heading">Décodage</span>
                                </label>
                                <div class="content">
                                    <li class="ui-state-highlight listeDeroulante draggable">Vrai ou Faux ?</li>

                                </div>
                            </div>
                            <div class="question-wrap">
                                <input type="radio" class="acc" id="question-4" name="question">
                                <label class="labelEditionExo" for="question-4">
                                    <div class="cross-box"><span class="cross"></span></div><span class="accordion-heading">Encodage</span>
                                </label>
                                <div class="content">
                                    <li class="ui-state-highlight listeDeroulante draggable">Vrai ou Faux ?</li>
                                </div>
                            </div>
                            <div class="question-wrap">
                                <input type="radio" class="acc" id="question-5" name="question">
                                <label class="labelEditionExo" for="question-5">
                                    <div class="cross-box"><span class="cross"></span></div><span class="accordion-heading">Copie</span>
                                </label>
                                <div class="content">
                                    <li class="ui-state-highlight listeDeroulante draggable">Vrai ou Faux ?</li>
                                </div>
                            </div>


                        </div>
                    </div>




                    <div class="panel">
                        <input type="radio" class="acc" id="tab-3" name="tabs">
                        <label class="labelEditionExo" for="tab-3">
                            <div class="cross-box"><span class="cross"></span></div><span class="accordion-heading">Banque d'image</span>
                        </label>

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
                            <button id="up" class="button-34">+</button>
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
?>