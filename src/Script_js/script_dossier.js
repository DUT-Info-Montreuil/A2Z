async function popUpNomDuDossier() {

    (async () => {

        const { value: nomDossier } = await Swal.fire({
          input: 'text',
          inputLabel: 'Entrez le nom du dossier',
          inputPlaceholder: 'Nom du dossier'
        })
        
        if (nomDossier) {
          Swal.fire('nom dossier:', nomDossier)
        }
        
        })()
}

    