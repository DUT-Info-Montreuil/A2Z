async function popUpNomDuDossier($loc) {
  (async () => {
    const { value: nomDossier } = await Swal.fire({
      input: "text",
      inputLabel: "Entrez le nom du dossier",
      inputPlaceholder: "Nom du dossier",
    });

    if (nomDossier) {
      Swal.fire("Nom de votre dossier :", nomDossier);
      $.ajax({
        method: "POST",
        url: "./modules/mod_favoris/creerDossier.php",
        data: { dossier: nomDossier, location: $loc },
        dataType: "json",
      }).done(function (retour) {
        créationIconedossier(retour, nomDossier);
      });
    }
  })();
}
function supprimerDossier(idDossier) {
  $.ajax({
    method: "POST",
    url: "./modules/mod_favoris/creerDossier.php",
    data: { idDossier: idDossier },
    dataType: "json",

    success: function (response) {
      location.reload();
    },
  });
}
function supprimerFiche(idFiche) {
  $.ajax({
    method: "POST",
    url: "./modules/mod_editionExo/creerFiche.php",
    data: { idFiche: idFiche },
    dataType: "json",
  }).done(function (element) {
    location.reload();
  });
}

function créationIconedossier($idDossier, $nomDossier) {
  let nouveauDossier =
    '<div id="' +
    $idDossier +
    '" class=" draggableFiche dossier"><button type="button" class="boutonSupp" onClick="supprimerDossier(' +
    $idDossier +
    ')">❌</button> <figure class="imageSeule"><a class="lien" href="index.php?module=favoris&location=' +
    $idDossier +
    '"><img onClick="rechercheLocation()"src="./ressource/images/dossier.png" alt="Image de dossier"><figcaption>' +
    $nomDossier +
    "</figcaption></figure></div>";
  $(".BoxDossiers").append(nouveauDossier);
}

function rechercheLocation() {
  var url = new URL(window.location.href);
  var location = url.searchParams.get("location");
  rechercheDossier(location);
  rechercheFiche(location);
}
function rechercheDossier(location) {
  $.ajax({
    method: "POST",
    url: "./modules/mod_favoris/creerDossier.php",
    data: { idParent: location },
    dataType: "json",
  }).done(function (element) {
    for (let i = 0; i < element.length; i++) {
      créationIconedossier(element[i]["idDossier"], element[i]["nomDossier"]);
    }
  });
}
function rechercheFiche(location) {
  $.ajax({
    method: "POST",
    url: "./modules/mod_editionExo/creerFiche.php",
    data: { idParent: location },
    dataType: "json",
  }).done(function (element) {
    for (let i = 0; i < element.length; i++) {
      créationIconeFiche(element[i]["idFiche"], element[i]["nomFiche"]);
    }
  });
}
async function popUpNomDeLaFiche($loc) {
  (async () => {
    const { value: nomFiche } = await Swal.fire({
      input: "text",
      inputLabel: "Entrez le nom de la fiche",
      inputPlaceholder: "Nom de la fiche",
    });

    if (nomFiche) {
      Swal.fire("Nom de votre fiche : ", nomFiche);
      $.ajax({
        method: "POST",
        url: "./modules/mod_editionExo/creerFiche.php",
        data: { nomFiche: nomFiche, location: $loc },
        dataType: "json",
      }).done(function (retour) {
        créationIconeFiche(retour, nomFiche);
      });
    }
  })();
}

function créationIconeFiche($idFiche, $nomFiche) {
  let nouvelElement =
    '<div id="' +
    $idFiche +
    '" class=" draggableFiche"><button type="button" class="boutonSupp" onClick="supprimerFiche(' +
    $idFiche +
    ')">❌</button> <figure class="imageSeule" ><a class="lien" href="index.php?module=editionExo&idFiche=' +
    $idFiche +
    '"><img src="./ressource/images/fiche.png" class="fiche"><figcaption>' +
    $nomFiche +
    "</figcaption></figure></div>";
  $(".BoxDossiers").append(nouvelElement);
}

/*
Version 1.0 - 2022/11/30
GNU GPL  Copyleft (C inversé) 2023-2033
Initiated by Hamidi.Yassine,Chouchane.Rayan,Claude.Aldric
Web Site = http://localhost/A2Z/src/index.php?module=connexion&action=connexion 
*/
