/*changement de la police*/
function changeAll(font) {
    var elements = document.getElementsByClassName('classeDeBase');

    for (var i = 0; i < elements.length; i++) {
        var element = elements[i];
        element.style.fontFamily = font.value;

    }
}

$(function() {
    // page
    $(".sortable").sortable({
        revert: true
    });
    /*$(".draggable").draggable({
        connectToSortable: ".sortable",
        helper: "clone",
        revert: "invalid"
    });*/
    // empêche la selection du texte des exos qu'on peut drag n drop sur la page
    $("li").disableSelection();
});

$(function() {
    // rend les exos draggable
    $(".draggable, #draggable-nonvalid").draggable({
            helper: "clone"
        })
        // rend la page droppable et definit l'event listener du drop
    $("#page").droppable({
        accept: ".draggable",
        drop: function(event, ui) { // drop ajoute lt-mirror et modifie les attribut du text area
            const classes = ui.draggable["0"].className
            let htmlNouvelExercice
            const uuid = CreateUUID()
            if (classes.includes("exoVraiFaux")) {
                htmlNouvelExercice = `<div class ="divVraiOuFaux classeDeBase" id="idDivVraiFaux"><input  type="text" name="VouF" class="inputVraiF all input-utilisateur"><button class = "supprimer" onClick="supprimerExo()">❌</button> <p class="pVraiFaux">---------------Vrai----Faux</p> </div>`
            } else if (classes.includes("exoAutre")) {
                htmlNouvelExercice = `<div class ="divVraiOuFaux classeDeBase" id="idDivVraiFaux"><input type="text" name="VouF" class="inputVraiF all input-utilisateur"><button class = "supprimer" onClick="supprimerExo()">❌</button><p class="pVraiFaux">-autre type</p> </div>`
            } else if (classes.includes("consigne")) {
                htmlNouvelExercice = `<div class ="divVraiOuFaux classeDeBase" id="idDivVraiFaux"><input  type="text" name="VouF" class="rond all input-utilisateur" maxlength="1"/><input type="text" name="VouF" class="consigne2 all input-utilisateur" ></div>`

            }

            $(".res").append(htmlNouvelExercice);
            var idUnique = document.getElementById('idDivVraiFaux');
            idUnique.id = uuid
        }
    });
});


function CreateUUID() {
    return ([1e7] + -1e3 + -4e3 + -8e3 + -1e11).replace(/[018]/g, c =>
        (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)
    )
}


function getPDF() {
    window.print()
}