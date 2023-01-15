<?php

require_once "../../connexion.php";

session_start();

class SauvegardePhoto  extends Connexion
{

    public function __construct()
    {
        parent::initConnexion();
    }

    public function envoiePhotos()
    {

        if (isset($_POST['image'])) {
            $photo = $_POST['image']; // tableau en JSON contenant tout (id et le code html)
            $tableauContenuImage = json_decode($photo, true);

            $sql1 = 'INSERT into images (cheminImages,DateImage,idUser,DescriptionImages)  VALUES (:cheminImages ,:DateImage,:idUser,:DescriptionImages)';
            $statement1 = Connexion::$bdd->prepare($sql1);

            $cheminImages = $tableauContenuImage['imageData'];
            $DescriptionImages = $tableauContenuImage['nomImage'];


            $DateImage  = date("Y-m-d");
            $idUser = $this->recuperationInfoCompte();
            $statement1->execute(array(':cheminImages' => htmlspecialchars($cheminImages), ':DateImage' => htmlspecialchars($DateImage), ':idUser' => htmlspecialchars($idUser['idUser']), ':DescriptionImages' => htmlspecialchars($DescriptionImages)));
            $this->recuperationPhotos();
        }
    }

    // fonction génerique pour récupérer toutes les infos d'un user dans un seul tableau 
    public function recuperationInfoCompte()
    {
        try {
            $sql = 'Select * from utilisateur WHERE identifiant=:identifiant';
            $statement = self::$bdd->prepare($sql);
            $statement->execute(array(':identifiant' => $_SESSION['identifiant']));
            $resultat = $statement->fetch();
            return $resultat;
        } catch (PDOException $e) {
            echo $e->getMessage() . $e->getCode();
        }
    }

    /**
     * FOnction pour récupérer toutes les images de la BDD pour ensuite les envoyé à Js 
     */
    public function recuperationPhotos()
    {
        try {

            if (isset($_POST['nomImage'])) {
                $nomImage = htmlspecialchars((string) trim($_POST['nomImage']));

                $sql = 'SELECT idImages FROM `images` join utilisateur using (idUser) where  identifiant = ? and  DescriptionImages LIKE  ? LIMIT 10';
                $statement1 = self::$bdd->prepare($sql);
                $statement1->execute(array($_SESSION['identifiant'], "%$nomImage%"));
                $resultat_Tab_ID = $statement1->fetchAll(PDO::FETCH_ASSOC);
            } else {
                //Requetes SQL
                $sql = 'SELECT idImages FROM `images` WHERE idUser=:idUser LIMIT 10;'; //On récupere d'abord tous les id des images à afficher
                $statement1 = self::$bdd->prepare($sql);
                $idUser = $this->recuperationInfoCompte();

                $statement1->execute(array(':idUser' => htmlspecialchars($idUser['idUser'])));
                $resultat_Tab_ID = $statement1->fetchAll(PDO::FETCH_ASSOC);
            }
            $func = function ($tableau): string {
                return ($tableau['idImages']);
            };;

            $nouveauxTableauBdd = array_map($func, $resultat_Tab_ID); //Pour éviter les structure lourdes de php
            //preparation des requetes SQL

            $sql2 = 'SELECT cheminImages FROM `images` WHERE idImages=:idImages LIMIT 10;'; //On prend les images 1 à 1
            $statement2 = self::$bdd->prepare($sql2);


            //////////////////// 2ème requete ////////////////////
            $tailleTabImage = count($nouveauxTableauBdd);

            //Boucle for pour envoyer 1 à 1 les images à Js
            for ($i = 0; $i < $tailleTabImage; $i++) {

                $sql2 = 'SELECT cheminImages FROM `images` WHERE idImages =:idImages';
                $statement2->execute(array(':idImages' => htmlspecialchars($nouveauxTableauBdd[$i])));
                $resultat_Tab_cheminImages[$i] = $statement2->fetch(PDO::FETCH_ASSOC);
            }
            if (!empty($resultat_Tab_cheminImages)) {
                header("Content-Type: application/json"); // On avertit le navigateur du type de donnée qu'on lui envoit !!!Hyper important ne pas enlever ou la page va complétement buguer!!!
                echo json_encode($resultat_Tab_cheminImages); //Envoie à Js
            }
        } catch (PDOException $e) {
            echo $e->getMessage() . $e->getCode();
        }
    }
}


$photoExercice = new SauvegardePhoto();

if (isset($_POST['image'])) {
    $photoExercice->envoiePhotos();
} else {
    $photoExercice->recuperationPhotos();
}
/*
Version 1.0 - 2022/11/30
GNU GPL  Copyleft (C inversé) 2023-2033
Initiated by Hamidi.Yassine,Chouchane.Rayan,Claude.Aldric
Web Site = http://localhost/A2Z/src/index.php?module=connexion&action=connexion 
*/
?>