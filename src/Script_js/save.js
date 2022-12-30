function tojson() {
    //  This gives you an HTMLElement object
    var contentElements = document.querySelector('page').children; // recupere tous les elements enfants de celui recherche dans querySelector (selecteur CSS)
    let exercicesHTML = [];

    Array.from(contentElements).forEach(element => {
        
        const cssSelector = `#${element.id} .input-utilisateur`
        const inputs = $(cssSelector) //recupere tous les élement  selectionner par le selecteur css par class
        const inputArray = Array.from(inputs)
        let texte
        inputArray.forEach(input => {//Boucle for pour inserer la val dans le input 
            texte = input.value
            $(input).attr("value", texte)
        })
        exercicesHTML.push(element.outerHTML)
    }); // transforme le HTMLCollection en tableau et ajoute chaque element dans le tableau exercicesHTML


    let donneesExercices = [];
    const divExercice = document.querySelectorAll(".classeDeBase") // recupere tout les classes qui possede classDeBase 

    Array.from(divExercice).forEach((element, index) => { //index pour récupere l'index qui seras incrementer dans le for each
        const donneExo = { // objet
            id: element.id,
            position: index
        }
        donneesExercices.push(donneExo)//on met les donne dans le tableau 
    });


    const deco_var = decodeURI($_GET('idFiche'));

    //Donne envoyer à PHP un objet
    const data = {
        idExo: donneesExercices.map(donnee => donnee.id), // creation tableau identifiant UNIQUE identifiant HTML
        html: exercicesHTML, // tableau des exos en html
        idFiche: deco_var, //GUID UNIQUE
        positionExercice: donneesExercices.map(donnee => donnee.position) //stream pour récuperer la position dans le tableau d'objet
        
    };
    console.log(donneesExercices.map(donnee => donnee.id))
    console.log(donneesExercices.map(donnee => donnee.position))


    document.querySelector(".divVraiOuFaux")


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
        function (m, key, value) { // callback
            vars[key] = value !== undefined ? value : '';
        }
    );

    if (param) {
        return vars[param] ? vars[param] : null;
    }
    return vars;
}