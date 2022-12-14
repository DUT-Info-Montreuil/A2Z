async function popUpNomDuDossier($loc) {
  

  (async () => {

      const { value: nomDossier } = await Swal.fire({
        input: 'text',
        inputLabel: 'Entrez le nom du dossier',
        inputPlaceholder: 'Nom du dossier'
      })
      
      if (nomDossier) {
        Swal.fire('nom dossier : ', nomDossier)
        $.ajax ( {
          method : "POST" ,
          url : "./modules/mod_favoris/creerDossier.php",
          data : { dossier : nomDossier,
                  location : $loc  } ,
          dataType : "json"
          })
       
          .done ( function ( retour) {
            
            crÃ©arionIconedossier(retour,nomDossier)

          } ) ;
      }
      

        
      })()
}

function crÃ©arionIconedossier($idDossier,$nomDossier) {
let nouveauDossier = '<figure><a href="index.php?module=favoris&location=' + $idDossier + '"><img onClick="rechercheLocation()"src="./ressource/images/dossier.png" alt="Image de dossier"><figcaption>' + $nomDossier + '</figcaption></figure>';
$(".BoxDossiers").append(nouveauDossier);

}

function rechercheLocation() {

  var url = new URL(window.location.href);
  var idDossier = url.searchParams.get("location");
            $.ajax ( {
            method : "POST" ,
            url : "./modules/mod_favoris/creerDossier.php",
            data : { idDossier : idDossier,
                        } ,
            dataType : "json"
            })
            .done ( function ( element) {
              
              console.log(element)

              for (let i = 0 ; i < element.length; i++) {
              crÃ©arionIconedossier(element[i]['idDossier'],element[i]['nomDossier']);
              }
            } ) ;
}