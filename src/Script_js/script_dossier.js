async function popUpNomDuDossier() {

    (async () => {

        const { value: nomDossier } = await Swal.fire({
          input: 'text',
          inputLabel: 'Entrez le nom du dossier',
          inputPlaceholder: 'Nom du dossier'
        })
        
        if (nomDossier) {
          Swal.fire('nom dossier :', nomDossier)
        }

          echo 

        try {
          $sql = 'INSERT INTO Dossier (NomDossier,PartagerPrive,ParentsPaths,ChildsPaths,idUser)VALUES (:nomDossier,false,)';
        } catch {

        }
        
        })()
}
