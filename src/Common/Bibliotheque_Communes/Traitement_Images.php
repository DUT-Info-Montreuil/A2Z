<?php

  /*fonction qui récupere l'image upload  par l'user et met le format de l'image au format base 64   et qui teste plusieurs choses
       1- tout d'abord  si on a pas d'erreur pour le transfert 
       2- puis on vérifie la taille du fichier
       3- ensuite l'extension du fichier si c'est bien une image
       4- ensuite on met la photo dans un dossier temporaire pour ensuite la mettre au format base 64 
    */
    function recupereImage()
    {
        if (isset($_POST['envoiPhoto'])) {

            $tailleMaximum = 1000000;
            $extension = array('.jpg', '.jpeg', '.png');

            if ($_FILES['image']['error'] > 0) {
                return 1; // erreur lors du transfert
            }

            $tailleFichier = $_FILES['image']['size']; /* taille en octets */

            if ($tailleFichier > $tailleMaximum) {
                return 2; //taille trop grande
            }

            $nomFichier =  $_FILES['image']['name'];  /* nom du fichier */
            $extensionFichier = "." . strtolower(substr(strrchr($nomFichier, '.'), 1));

            $nomTemporaire = $_FILES['image']['tmp_name']; /* tmp_name emplacement du fichier temporaire sur le serveur */
            $nomUnique = md5(uniqid(rand(), true)); // on lui donne  un id unique au nom fichier
            $destination  = "./upload/" . $nomUnique . $extensionFichier;
            $resultat = move_uploaded_file($nomTemporaire, $destination); //Déplace un fichier téléchargé ici dans upload

            //vérifier le type mime 
            if (!(in_array($extensionFichier, $extension)) && !(mime_content_type($destination) == $extensionFichier)) {
                return 3; //fichier pas une image;
            }

            if ($resultat) {
                $path = $destination;
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $data = file_get_contents($path); //Lit tout un fichier dans une chaîne
                $base64 =  base64_encode($data);
                $ensembleBase64 = 'data:image/' . $type . ';base64, ' . $base64;
                unlink($destination);
                return $ensembleBase64; // echo"transfert termniné";
            }
        }
    }
