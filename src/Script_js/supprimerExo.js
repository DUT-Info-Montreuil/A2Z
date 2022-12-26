function supprimerExo(elem) {


    var element = document.getElementById(elem.parentNode.id);
    console.log(element.id)
    console.log(elem);
    elem.parentNode.remove(element);

    /*
        let idExoAsupp = elem.parentNode.id;
        console.log(idExoAsupp)


        let idExoAsuppjson = JSON.stringify(idExoAsupp);
        console.log(idExoAsuppjson)

        var t = document.getElementById(elem.parentNode.id);
        elem.parentNode.removeChild(t.parentNode.id);


        $.ajax({
            method: "POST",
            url: "./modules/mod_editionExo/saveExo.php",
            data: { idAsupp: idExoAsuppjson },
            dataType: "json"
        })*/

}