//Fonction pour afficher ou cacher et changer l'image du mdp lors de la connexion ou inscription
const basculerAffichageMotDePasse = (idMotDePasse, idOeil) => {
  // la meme chose que function basculerAffichageMotDePasse() {
  const x = idMotDePasse;
  const image = idOeil;
  if (x.type === `password`) {
    x.type = `text`;
    image.setAttribute("src", "ressource/images/oeilMdp.png");
  } else {
    x.type = `password`;
    image.setAttribute("src", "ressource/images/oeilCacherMdp.png");
  }
};

//fonction vérifie si 2 mdp sont égaux
const checkMdp = () => {
  const mdp = document.getElementById(`premierMdp`).value,
    mdp2 = document.getElementById(`deuxiemeMdp`).value;
  if (mdp !== mdp2) {
    writedivmdp(
      '<span style="color:#F95738">Les mots de passe ne correspondent pas 😮 !</span>'
    );
  } else {
    writedivmdp(
      '<span style="color:#38E4AE" font-weight: bold >Mots de passe OK 😊 !</span>'
    );
  }
};

//fonction pour inserer le message dans un conteneur
const writedivmdp = (texte, icone) => {
  document.getElementById("deuxiemeAffichageMdp").innerHTML = texte;
};

/*
Version 1.0 - 2022/11/30
GNU GPL  Copyleft (C inversé) 2023-2033
Initiated by Hamidi.Yassine,Chouchane.Rayan,Claude.Aldric
Web Site = http://localhost/A2Z/src/index.php?module=connexion&action=connexion 
*/