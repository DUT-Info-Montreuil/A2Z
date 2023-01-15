/**
 * fonction qui permet de supprimer un exo en le supprimant dans la vue puis en envoyant en ajax pour le supprimer dans la bdd
 * @param {*} elem correspond au this de onClick="supprimerExo(this)" qui est l'exo actuel
 */
function supprimerExo(elem) {

    var element = document.getElementById(elem.parentNode.id);
    let elementId = element.id;
    elem.parentNode.remove(element);
}

/*
Version 1.0 - 2022/11/30
GNU GPL  Copyleft (C inversé) 2023-2033
Initiated by Hamidi.Yassine,Chouchane.Rayan,Claude.Aldric
Web Site = http://localhost/A2Z/src/index.php?module=connexion&action=connexion 
*/