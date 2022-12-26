function supprimerExo(elem) {

    const idAsupp = elem.parentNode.id;
    console.log(elem.parentNode.id);


    elem.parentNode.removeChild(elem);


    $.ajax({
        method: "POST",
        url: "./modules/mod_editionExo/saveExo.php",
        data: { divASupp: json },
        dataType: "json"
    })


}