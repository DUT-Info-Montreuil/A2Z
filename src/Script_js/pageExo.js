/*changement de la police*/
function changeAll(font) {
    var elements = document.getElementsByClassName('all');

    for (var i = 0; i < elements.length; i++) {
        var element = elements[i];
        element.style.fontFamily = font.value;

    }
}


$(function() {
    $(".sortable").sortable({
        revert: true
    });
    $(".draggable").draggable({
        connectToSortable: ".sortable",
        helper: "clone",
        revert: "invalid"
    });
    $("ul, li").disableSelection();
});

/*

$(function() {
    $(".dropp2").droppable();
    $(".dragg").draggable({
        connectToSortable: ".sortable",
        helper: "clone",
        revert: "invalid",

        drag: function(event, ui) {

            $(".res") += ('<div id = "divTest"> <span class="accordion-heading all" id="myElement">Mise en page test </span><p> je suis le plus BG</p>  </div>');


        }

    });

});

*/





$(function() {
    $("#draggable, #draggable-nonvalid").draggable();
    $("#droppable").droppable({
        accept: "#draggable",
        classes: {
            "ui-droppable-active": "ui-state-active",
            "ui-droppable-hover": "ui-state-hover"
        },
        drop: function(event, ui) {
            $(this)
                .addClass("ui-state-highlight")

            $(".res").append('<div class = "divTest"> <textarea name="VouF" class="inputVraiF"  ></textarea>  <p class="p">----------------------Vrai----Faux</p> </div>');




            var divT = document.getElementsByClassName('divTest');

            for (var i = 0; i < divT.length; i++) {
                var element = divT[i];
                element.style.border = " solid grey";

            }




            var divT = document.getElementsByClassName('p');

            for (var i = 0; i < divT.length; i++) {
                var elementp = divT[i];
                elementp.style.border = " solid grey";
                elementp.style.cssFloat = "right";
                elementp.style.marginTop = "revert";






            }


            var inputVraiF = document.getElementsByClassName('inputVraiF');

            for (var i = 0; i < inputVraiF.length; i++) {
                var element2 = inputVraiF[i];
                element2.style.height = "50px";
                element2.style.width = "470px";

                element2.style.resize = "none";



            }


        }
    });
});