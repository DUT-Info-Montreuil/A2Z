/**
 * fonction qui permet de supprimer un exo en le supprimant dans la vue puis en envoyant en ajax pour le supprimer dans la bdd
 * @param {*} elem correspond au this de onClick="supprimerExo(this)" qui est l'exo actuel
 */
function supprimerExo(elem) {


    var element = document.getElementById(elem.parentNode.id);
    console.log(element.id)
    console.log(elem);

    let elementId = element.id;

    console.log(elementId);



    /*

        $.ajax({
            method: "POST",
            url: "./modules/mod_editionExo/saveExo.php",
            data: { idAsupp: elementId },
            dataType: "json"
        })
    */

    elem.parentNode.remove(element);


}