function tojson() {
  //  This gives you an HTMLElement object
  var contentElements = document.querySelector("page").children; // recupere tous les elements enfants de celui recherche dans querySelector (selecteur CSS)
  let exercicesHTML = [];

  //Ici on enleve les class que Jquery rajoute car nous n'en n'avons pas besoin et cela créer des bugs si on l'enregistre
  $(".ui-wrapper").remove();
  $(".ui-resizable-handle").remove();

  Array.from(contentElements).forEach((element) => {
    const cssSelector = `#${element.id} .input-utilisateur`;
    const inputs = $(cssSelector); //recupere tous les élement  selectionner par le selecteur css par class
    const inputArray = Array.from(inputs);
    let texte;
    inputArray.forEach((input) => {
      //Boucle for pour inserer la val dans le input
      texte = input.value;
      $(input).attr("value", texte);
    });
    exercicesHTML.push(element.outerHTML);
  }); // transforme le HTMLCollection en tableau et ajoute chaque element dans le tableau exercicesHTML

  //apres sauvegarde on re met les images draggables pour qu'on puisse les modifier meme après sauvegarde
  mettreImageResizable();

  let donneesExercices = [];
  const divExercice = document.querySelectorAll(".classeDeBase"); // recupere tout les classes qui possede classDeBase

  Array.from(divExercice).forEach((element, index) => {
    //index pour récupere l'index qui seras incrementer dans le for each
    const donneExo = {
      // objet
      id: element.id,
      position: index,
    };
    donneesExercices.push(donneExo); //on met les donne dans le tableau
  });

  const deco_var = decodeURI($_GET("idFiche"));

  //Donne envoyer à PHP un objet
  const data = {
    idExo: donneesExercices.map((donnee) => donnee.id), // creation tableau identifiant UNIQUE identifiant HTML
    html: exercicesHTML, // tableau des exos en html
    idFiche: deco_var, //GUID UNIQUE
    positionExercice: donneesExercices.map((donnee) => donnee.position), //stream pour récuperer la position dans le tableau d'objet
  };

  document.querySelector(".divVraiOuFaux");

  const json = JSON.stringify(data); // transforme un objet JavaScript en string JSON.
  const obj = JSON.parse(json); // transforme un string JSON en objet JavaScript.
  const idUniqueJSON = JSON.parse(json);

  envoieExercice(json);
}

function envoieExercice(json) {
  $.ajax({
    method: "POST",
    url: "./modules/mod_editionExo/saveExo.php",
    data: { stringRecu: json },

    // traitement des cas
    success: function (response) {
      affichageSuccess();
    },
    error: function (response) {
      affichageErreur();
    },
  });
}

function affichageSuccess(json) {
  Toast.fire({
    icon: "success",
    title: "Votre travail a été sauvegardé avec succès😄",
  });
}

function affichageErreur(json) {
  Toast.fire({
    icon: "error",
    title: "Erreur lors de la sauvegarde de votre travail🤔",
  });
}
//recuperation idFiche depuis l'url
function $_GET(param) {
  var vars = {};
  window.location.href.replace(location.hash, "").replace(
    /[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
    function (m, key, value) {
      // callback
      vars[key] = value !== undefined ? value : "";
    }
  );

  if (param) {
    return vars[param] ? vars[param] : null;
  }
  return vars;
}

/*
Version 1.0 - 2022/11/30
GNU GPL  Copyleft (C inversé) 2023-2033
Initiated by Hamidi.Yassine,Chouchane.Rayan,Claude.Aldric
Web Site = http://localhost/A2Z/src/index.php?module=connexion&action=connexion 
*/