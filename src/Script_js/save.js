function tojson() {
    //  This gives you an HTMLElement object
    var contentElements = document.querySelector('page').children; // recupere tous les elements enfants de celui recherche dans querySelector (selecteur CSS)
    let exercicesHTML = [];
    Array.from(contentElements).forEach(element => {
        const texte = $(`#${element.id} input`)[0].value
        $(`#${element.id} input`).attr("value", texte)
        console.log(texte)
        exercicesHTML.push(element.outerHTML)
    }); // transforme le HTMLCollection en tableau et ajoute chaque element dans le tableau exercicesHTML


    //tableau des id du tableau HTMl
    let identifiantExercicesHtml = [];
    const divExercice = document.querySelectorAll(".classeDeBase") // recupere tout les classes qui possede classDeBase 
    Array.from(divExercice).forEach(element => identifiantExercicesHtml.push(element.id)); // transforme le HTMLCollection en tableau et ajoute chaque element dans le tableau exercicesHTML


    //  This gives you a string representing that element and its content
    //var html = element.outerHTML;
    //  This gives you a JSON object that you can send with jQuery.ajax's `data`
    // option, you can rename the property to whatever you want.
    var deco_var = decodeURI($_GET('idFiche'));

    var data = {
        idExo: identifiantExercicesHtml, // creation tableau identifiant UNIQUE identifiant HTML
        html: exercicesHTML, // tableau des exos en html
        idFiche: deco_var
    };


    document.querySelector(".divVraiOuFaux")



    //  This gives you a string in JSON syntax of the object above that you can 
    // send with XMLHttpRequest.

    const json = JSON.stringify(data); // transforme un objet JavaScript en string JSON.
    const obj = JSON.parse(json); // transforme un string JSON en objet JavaScript.
    const idUniqueJSON = JSON.parse(json);



    console.log(deco_var);

    $.ajax({
        method: "POST",
        url: "./modules/mod_editionExo/saveExo.php",
        data: { stringRecu: json },
        dataType: "json"
    })

}



//recuperation idFiche depuis l'url
function $_GET(param) {
    var vars = {};
    window.location.href.replace(location.hash, '').replace(
        /[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
        function(m, key, value) { // callback
            vars[key] = value !== undefined ? value : '';
        }
    );

    if (param) {
        return vars[param] ? vars[param] : null;
    }
    return vars;
}