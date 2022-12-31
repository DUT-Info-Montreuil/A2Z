/**
 * Fonction qui affiche la pop up de sélection de l'image
 */
async function importerImage() {

  const { value: file } = await Swal.fire({
    title: `Sélectionner l'image`,
    input: 'file',
    confirmButtonColor: '#0096d9',
    inputAttributes: {
      'accept': 'image/*',
      'aria-label': 'Upload your profile picture',
    }
  })

  if (file) {
    //Verifiaction de la taille de l'image
    const tailleMaximum = 1000000
    if (file.size > tailleMaximum) { // 1 MO
      return affichageImportErreurImageSize()
    }
    const nomImage = file.name
    const reader = new FileReader()
    reader.onload = (e) => onFileLoaded(e, nomImage)
    reader.readAsDataURL(file)
  }
}


/**
 * Fonction qui stocke la photo
 * @param {*} event 
 */
function onFileLoaded(event, nomImage) {
  // verifie la taille Mo
  Swal.fire({
    confirmButtonColor: '#0096d9',
    title: 'Votre photo téléchargée',
    imageUrl: event.target.result,
    imageAlt: 'Votre photo téléchargée'
  })
  var imageData = event.target.result;

  //On envoie l'image en base 64 et son nom pour la description
  const data = {
    imageData: imageData, // tableau des exos en html
    nomImage: nomImage, //GUID UNIQUE
  };

  const json = JSON.stringify(data); // transforme un objet JavaScript en string JSON.
  send(json)
}

/**
 * Fonction qui envoie la data reçu en paramètre, en base 64 à php
 * @param {*} json 
 */
function send(json) {
  $.ajax({
    url: "./modules/mod_editionExo/sauvegardePhoto.php",
    type: "POST",
    data: {
      image: json,
    },

    // traitement des cas 
    success: function (response) {
      setTimeout(affichageImportSuccess, 5000)//en millisecondes
    },
    error: function (response) {
      setTimeout(affichageImportErreur, 5000)//en millisecondes
    }
  });
}

function affichageImportSuccess() {
  Toast.fire({
    icon: 'success',
    title: "Image sauvegardée avec succès😄"
  })
}


function affichageImportErreur() {
  Toast.fire({
    icon: 'error',
    title: "Erreur lors de l'envoi de l'image !🤔"
  })
}

function affichageImportErreurImageSize() {
  Toast.fire({
    icon: 'error',
    title: "Erreur votre image est trop grande !🤔"
  })
}