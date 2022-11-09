
//Fonction pour afficher ou cacher et changer l'image du mdp lors de la connexion ou inscription 
const basculerAffichageMotDePasse = () => {  // la meme chose que function basculerAffichageMotDePasse() {
    const x = document.getElementById(`monEntree`)
    const image = document.getElementById(`oeil`)
    if (x.type === `password`){
        x.type = `text`
        image.setAttribute("src", "ressource/images/oeilMdp.png")
    }

    else{
        x.type = `password`
        image.setAttribute("src", "ressource/images/oeilCacherMdp.png")
    }        
}
