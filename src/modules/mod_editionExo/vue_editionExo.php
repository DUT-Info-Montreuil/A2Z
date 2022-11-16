<?php
class VueEdition extends Vue_Generique
{ //fonction pour l'affichage de la nav bar

    public function  __construct()
    {
        parent::__construct(); // comme un super
    }

    function pageExoEdition()
    {
?>
        <!DOCTYPE html>
        <html lang="fr">

        <!-- En tête de la page -->

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>A2Z</title>



            <!--Scripts JS-->
            <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
            <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
            <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
            <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
            <script src="Script_js/pageExo.js"></script>

            <!--Link css-->
            <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
            <link rel="stylesheet" href="/resources/demos/style.css">
            <link rel="stylesheet" href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css">
            <link rel="stylesheet" href="Style_css/pageExo.css">


        </head>



        <body>
            <!--Test-->

            <div>

                <ul>
                    <li class=" draggable">Yassine <textarea name="" id="" cols="70" rows="1">test</textarea></li>

                    <li class="draggable dragg">Rayan <textarea name="" id="" cols="30" rows="1">test</textarea></li>
                </ul>
            </div>




            </head>



            <div id="draggable-nonvalid" class="ui-widget-content">
                <p>I&apos;m draggable but can&apos;t be dropped</p>
            </div>

            <div id="draggable" class="ui-widget-content">
                <p>Drag me to my target</p>
            </div>

            <div id="droppable" class="ui-widget-header">
                <p>accept: &apos;#draggable&apos;</p>
            </div>

            <!--Fin Test-->







            <div class="flex-container">

                <div class="flex-row">


                    <!--Accordeon-->

                    <div class="flex-col-md-6">

                        <div class="panel">

                            <input type="radio" class="acc" id="tab-1" name="tabs">
                            <label for="tab-1">
                                <div class="cross-box"><span class="cross">
                                </div>
                                <span class="accordion-heading" id="myElement">Mise en page</span>
                            </label>

                        </div>





                        <div class="panel">
                            <input type="radio" class="acc" id="tab-2" name="tabs">
                            <label for="tab-2">
                                <div class="cross-box"><span class="cross"></span></div><span class="accordion-heading">Catégorie</span>
                            </label>

                            <div class="questions">

                                <div class="question-wrap">
                                    <input type="radio" class="acc" id="question-1" name="question">
                                    <label for="question-1">
                                        <div class="cross-box"><span class="cross"></span></div><span class="accordion-heading">Principe alphabétique</span>
                                    </label>
                                    <div class="content">

                                        <li class="draggable" class="ui-state-highlight">Exo1<input type="text" id="name" name="name">
                                        </li>

                                        <li class="draggable" class="ui-state-highlight">Exo1 <textarea name="" id="" cols="30" rows="1">test</textarea> </li>
                                        <li class="draggable" class="ui-state-highlight">Exo2 <textarea name="" id="" cols="30" rows="1">test</textarea> </li>

                                    </div>
                                </div>

                                <div class="question-wrap">
                                    <input type="radio" class="acc" id="question-2" name="question">
                                    <label for="question-2">
                                        <div class="cross-box"><span class="cross"></span></div><span class="accordion-heading">Conscience phonologique</span>
                                    </label>
                                    <div class="content">
                                        <li class="draggable" class="ui-state-highlight">Exo1 <textarea name="" id="" cols="30" rows="1">test</textarea> </li>
                                        <li class="draggable" class="ui-state-highlight">Exo2 <textarea name="" id="" cols="30" rows="1">test</textarea> </li>

                                    </div>
                                </div>

                                <div class="question-wrap">
                                    <input type="radio" class="acc" id="question-3" name="question">
                                    <label for="question-3">
                                        <div class="cross-box"><span class="cross"></span></div><span class="accordion-heading">Décodage</span>
                                    </label>
                                    <div class="content">
                                        <li class="draggable" class="ui-state-highlight">Exo1 <textarea name="" id="" cols="30" rows="1">test</textarea> </li>
                                        <li class="draggable" class="ui-state-highlight">Exo2 <textarea name="" id="" cols="30" rows="1">test</textarea> </li>

                                    </div>
                                </div>
                                <div class="question-wrap">
                                    <input type="radio" class="acc" id="question-4" name="question">
                                    <label for="question-4">
                                        <div class="cross-box"><span class="cross"></span></div><span class="accordion-heading">Encodage</span>
                                    </label>
                                    <div class="content">
                                        <li class="draggable" class="ui-state-highlight">Exo1 <textarea name="Ex011" id="" cols="30" rows="1">test</textarea> </li>
                                        <li class="draggable" class="ui-state-highlight">Exo2 <textarea name="Ex022" id="" cols="30" rows="1">test</textarea> </li>
                                    </div>
                                </div>
                                <div class="question-wrap">
                                    <input type="radio" class="acc" id="question-5" name="question">
                                    <label for="question-5">
                                        <div class="cross-box"><span class="cross"></span></div><span class="accordion-heading">Copie</span>
                                    </label>
                                    <div class="content">
                                        Ipsam atque, soluta doloribus distinctio saepe labore voluptates facere illum alias
                                        perferendis praesentium quia vel accusamus incidunt corporis veniam sapiente.
                                        Voluptate,
                                        quasi.
                                    </div>
                                </div>


                            </div>
                        </div>




                        <div class="panel">
                            <input type="radio" class="acc" id="tab-3" name="tabs">
                            <label for="tab-3">
                                <div class="cross-box"><span class="cross"></span></div><span class="accordion-heading">Banque d'image</span>
                            </label>

                        </div>

                    </div>
                    <!--Fin Accordeon-->


                    <!--Page-->

                    <div id="divpage">

                        <div id="modifieurs">
                            <div class="select">
                                <select id="input-font" class="input" onchange="changeAll(this);">

                                    <option value="arial">Arial</option>
                                    <option value="cursive">cursive</option>
                                </select>

                            </div>
                            <button id="up">+</button>
                            <button id="down">-</button>

                        </div>

                        
                        <page size="A4" id="page droppable" class="sortable res ">
                        
                        </page>

                    </div>



                </div><!-- flex-row-->
            </div><!-- flex-container-->



        </body>
<?php

    }
}
?>