<?php

require_once("./Common/Bibliotheque_Communes/errreur404.php");
if (constant("a2z") != "rya")
	die(affichage_erreur404());

require_once("./Common/Bibliotheque_Communes/Verification_Creation_Token.php"); //

class ModeleCompte  extends Connexion
{

    //fonction changement d'identifiant et verifie sil est unique 
    public function changerIdentifiant()
    {
        if (!isset($_POST['token']) || !verification_token())
            return 1;
        try {
            //ici on teste si l'identifiant est différents des autres
            $sql = 'Select * from utilisateur WHERE identifiant=:identifiant';
            $statement = self::$bdd->prepare($sql);
            $statement->execute(array(':identifiant' => $_POST['nouveauidentifiant']));
            $resultat = $statement->fetch();

            //si on trouve le bon user alors
            if ($resultat) {
                return false; //identifiant deja utilisé';
            } else {

                // ici on UPDATE les donnee dans la BDD
                $commande = ' UPDATE utilisateur SET identifiant ="' . $_POST['nouveauidentifiant'] . '" WHERE  identifiant=:identifiant';
                $statement = Connexion::$bdd->prepare($commande);
                $statement->execute(array(':identifiant' => ($_SESSION["identifiant"])));
                $result = $statement->fetch();

                //on oublie pas ici de changer également le $Session 
                $_SESSION['identifiant'] = $_POST['nouveauidentifiant'];
                return true;
            }
        } catch (PDOException $e) {
            echo $e->getMessage() . $e->getCode();
        }
    }

    //fonction changement d'adresse mail et verifie s il est unique 
    public function changerAdresseMail()
    {
        if (!isset($_POST['token']) || !verification_token())
            return 1;
        try {

            //ici on teste si l'adresse mail entrer par l'user  est différents des autres
            $sql = 'Select * from utilisateur WHERE adresseMail=:adresseMail';
            $statement = self::$bdd->prepare($sql);
            $statement->execute(array(':adresseMail' => $_POST['nouveladresseMail']));
            $result = $statement->fetch();

            //si on trouve le bon user alors
            if ($result) {
                return false; //adresseMail deja utilisé';
            } else {
                // ici on UPDATE les donnee dans la BDD
                $commande = ' UPDATE utilisateur SET adresseMail ="' . $_POST['nouveladresseMail'] . '" WHERE  identifiant=:identifiant';
                $statement = Connexion::$bdd->prepare($commande);
                $statement->execute(array(':identifiant' =>  $_SESSION['identifiant']));
                $result = $statement->fetch();
                return true;
            }
        } catch (PDOException $e) {
            echo $e->getMessage() . $e->getCode();
        }
    }

    //fonction de changement de mot de passe avec le hashage
    public function changerMotDePasse()
    {
        if (!isset($_POST['token']) || !verification_token())
            return 1;

        elseif (strcmp($_POST['motDePasse'], $_POST['DeuxiemeMotDePasse']) != 0) {
            return 2;
        }
        try {

            // ici on UPDATE les donnee dans la BDD
            $sql = 'UPDATE utilisateur SET motDePasse ="' .  password_hash(htmlspecialchars($_POST['motDePasse']), PASSWORD_DEFAULT) . '" WHERE  identifiant=:identifiant';
            $statement = Connexion::$bdd->prepare($sql);
            $statement->execute(array(':identifiant' =>  $_SESSION['identifiant']));
            $result = $statement->fetch();
            return 3;
        } catch (PDOException $e) {
            echo $e->getMessage() . $e->getCode();
        }
    }

  
    //cette fonction update la photo de profil de l'user en mettant une par défault
    public function suppresionPhotoDeProfile()
    {
        try {
            $path = "ressource/images/pdp.jpeg"; //on met une image par défault 

            $data = file_get_contents($path);
            $base64 =  base64_encode($data);
            $ensembleBase64 = 'data:image/' . '.jpeg' . ';base64, ' . $base64;
            $this->changementPhoto($ensembleBase64);
            return true;
        } catch (Exception $e) {
            echo $e->getMessage() . $e->getCode();
        }
    }

    // fonction qui envoie l'image reçu en base 64 à la BDD
    public function changementPhoto($image)
    {
        if (!isset($_POST['token']) || !verification_token())
            return 1;
        try {

            // ici on UPDATE les donnee dans la BDD
            $commande = 'UPDATE utilisateur SET cheminImage ="' . $image . '" WHERE  identifiant=:identifiant';
            $statement = Connexion::$bdd->prepare($commande);
            $statement->execute(array(':identifiant' =>  $_SESSION['identifiant']));
            $result = $statement->fetch();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage() . $e->getCode();
        }
    }

    // fonction génerique pour récupérer toutes les infosd'un user dans un seul tableau 
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
}
