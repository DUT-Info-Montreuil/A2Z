/*changement de la police
function changeAll(font) {
  var elements = document.getElementsByClassName("classeDeBase");

  for (var i = 0; i < elements.length; i++) {
    var element = elements[i];
    element.style.fontFamily = font.value;
  }
}
*/

function canvaAffiche() {
  var largeurCarreau = 20;
  var hauteurCarreau = 20;
  const longueurCanvas = $(".monCanvas").length;

  for (let z = 0; z < longueurCanvas; z++) {
    var ctx = $(".monCanvas")[z].getContext("2d");
    for (var i = 0; i < 39; i++) {
      for (var j = 0; j < 3; j++) {
        ctx.fillStyle = "#ffffff";
        ctx.fillRect(
          i * largeurCarreau,
          j * hauteurCarreau,
          largeurCarreau,
          hauteurCarreau
        );
        ctx.strokeStyle = "#000000";
        ctx.strokeRect(
          i * largeurCarreau,
          j * hauteurCarreau,
          largeurCarreau,
          hauteurCarreau
        );
      }
    }
  }
}

$(function () {
  // page
  $(".sortable").sortable({
    revert: true,
  });

  // empêche la selection du texte des exos qu'on peut drag n drop sur la page
  $("li").disableSelection();
});

//Appelle 1 fois au début du chargement de la page
$(document).ready(function () {
  definitionDraggable();
});

function definitionDraggable() {
  console.log("Draggable ready");

  // rend les exos draggable
  $(".draggable, #draggable-nonvalid").draggable({
    helper: "clone",
  });
  // rend la page droppable et definit l'event listener du drop
  $("#page").droppable({
    accept: ".draggable",

    drop: function (event, ui) {
      // drop ajoute lt-mirror et modifie les attribut du text area
      const classes = ui.draggable["0"].className;
      let htmlNouvelExercice;
      const uuid = CreateUUID();
      if (classes.includes("exoVraiFaux")) {
        htmlNouvelExercice = ` < div class = "divVraiOuFaux classeDeBase"
        id = "idGuid" > < input type = "text"
        name = "VouF"
        id = "myArea"
        class = "inputVraiF all input-utilisateur" / > < button class = "supprimer"
        onClick = "supprimerExo(this)" > ❌ < /button> <p class="pVraiFaux">---------------Vrai----Faux</p > < /div>`;
      } else if (classes.includes("exoVraiouFaux")) {
        htmlNouvelExercice = `<div class ="divVraiOuFaux classeDeBase" id="idGuid"><input type="text" name="VouF" maxlength="50"  class="inputVraiF all input-utilisateur" /><button class = "supprimer" onClick="supprimerExo(this)">❌</button><p class="pVraiFaux">----------------------Vrai----faux</p> </div>`;
      } else if (classes.includes("consigne")) {
        htmlNouvelExercice = `<div class ="divVraiOuFaux classeDeBase" id="idGuid"><input type="text" name="VouF" class="rond all input-utilisateur" maxlength="1"/><input type="text" name="VouF" maxlength = "60" class="consigne2 all input-utilisateur" /> <button class = "supprimer" onClick="supprimerExo(this)">❌</button> </div>`;
      } else if (classes.includes("repondParPhrase")) {
        htmlNouvelExercice = `<div class ="divVraiOuFaux classeDeBase" id="idGuid"><input type="text" name="VouF" maxlength="50" class="inputCanva inputVraiF all input-utilisateur" /><button class = "supprimer" onClick="supprimerExo(this)">❌</button> <canvas class="monCanvas" width="740" height="61"></canvas></div>`;
      } else if (classes.includes("Entete")) {
        htmlNouvelExercice = `<div class =" classeDeBase " id="idGuid"><button class = "enteteBouton supprimer" onClick="supprimerExo(this)">❌</button><div class = "boiteEntete"><p class = "prenom">Prénom__________</p><p class = "date">Date:____/______/_____</p> </div><div class="Entete"><div class = "left"><input type="text"  class="top input-utilisateur" value = "Titre" maxlength="22"/><input type="text"  class="bot input-utilisateur"  value = "Auteur" maxlength = "15"/> </div>   <div class = "right"><div class = "lectureLeft"><input type="text"  value = "Lecture" maxlength="22"class="lecture input-utilisateur alignCenter" /><input type="text" maxlength="22" value = "Texte " class="lecture2 input-utilisateur alignCenter" /></div> <div class = " lectureRight"> <input type="text"  value = "Groupe" class="groupe input-utilisateur alignCenter " maxlength="8" cols="40" rows="5"/> </div></div> </div></div>`;
      } else if (classes.includes("imagesDraggable")) {
        htmlNouvelExercice =
          `<div class ="divVraiOuFaux classeDeBase" id="idGuid"><img id="Image" class="imagePage " alt="photo de profile" src=` +
          ui.draggable[0].src +
          ` alt="" /><button class = "supprimer" onClick="supprimerExo(this)">❌</button></div>`;
      } else if (classes.includes("imagesDraggable")) {
        htmlNouvelExercice =
          `<div class ="divVraiOuFaux classeDeBase" id="idGuid"><img id="Image" class="imagePage " alt="photo de profile" src=` +
          ui.draggable[0].src +
          ` alt="" /><button class = "supprimer" onClick="supprimerExo(this)">❌</button></div>`;
      } else if (classes.includes("entoureMots")) {
        htmlNouvelExercice = `<div class ="divVraiOuFaux classeDeBase " id="idGuid"><button class = "supprimer" onClick="supprimerExo(this)">❌</button> <div class = "premiereLigne"><input type="text" maxlength="16" name="VouF" class="inputVraiF alignCenter all input-utilisateur entoureMotsExo premierMot " /> <input type="text" maxlength="16" name="VouF" class="inputVraiF alignCenter entoureMotsExo all input-utilisateur" /><input type="text" maxlength="16" name="VouF" class="inputVraiF alignCenter  all input-utilisateur entoureMotsExo" /><input type="text" maxlength="16" name="VouF" class="alignCenter inputVraiF all input-utilisateur entoureMotsExo" /><input type="text" maxlength="16" name="VouF" class="alignCenter inputVraiF all input-utilisateur entoureMotsExo" /></div> </div>`;
      } else if (classes.includes("continuePhrase")) {
        htmlNouvelExercice = `<div class ="divVraiOuFaux classeDeBase  choixPhrase" id="idGuid"> <button class = "supprimer" onClick="supprimerExo(this)">❌</button> <div>  <div class = "phraseGauche"><input type="text" maxlength="35" name="VouF" class="inputVraiF  all input-utilisateur entoureMotsExo phraseGauchecss coloriagePhrase" />  </div>     <div class = "phraseDroite"><input type="text" maxlength="55" name="VouF" class="inputVraiF  all input-utilisateur entoureMotsExo phraseDroitecss1 coloriagePhrase" /><input type="text" maxlength="55" name="VouF" class="inputVraiF  all input-utilisateur entoureMotsExo coloriagePhrase phraseDroitecss1 " /><input type="text" maxlength="55" name="VouF" class="inputVraiF  coloriagePhrase all input-utilisateur entoureMotsExo phraseDroitecss1 " /></div></div> </div>`;
      }

      $(".res").append(htmlNouvelExercice);
      canvaAffiche();
      var idUnique = document.getElementById("idGuid");
      mettreImageResizable();
      idUnique.id = uuid;
    },
  });
}

$(function () {
  mettreImageResizable();
});

function mettreImageResizable() {
  console.log("Image resizable ready");
  $(".imagePage").resizable();
}

$(function () {
  canvaAffiche();
});

function CreateUUID() {
  return ([1e7] + -1e3 + -4e3 + -8e3 + -1e11).replace(/[018]/g, (c) =>
    (
      c ^
      (crypto.getRandomValues(new Uint8Array(1))[0] & (15 >> (c / 4)))
    ).toString(16)
  );
}

function getPDF() {
  window.print();
}

/*
Version 1.0 - 2022/11/30
GNU GPL  Copyleft (C inversé) 2023-2033
Initiated by Hamidi.Yassine,Chouchane.Rayan,Claude.Aldric
Web Site = http://localhost/A2Z/src/index.php?module=connexion&action=connexion 
*/