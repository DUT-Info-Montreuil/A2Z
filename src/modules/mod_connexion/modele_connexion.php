<?php

require_once("./Common/Bibliotheque_Communes/errreur404.php");
if (constant("a2z") != "rya")
    die(affichage_erreur404());

require_once("./Common/Bibliotheque_Communes/Verification_Creation_Token.php");
require_once("./Common/Classe_Generique/modele_connexion_generique.php");

class ModeleConnexion extends Modele_Connexion_Generique
{

    public function insereInscription()
    {
        if (!isset($_POST['token']) || !verification_token())
            return 1;

        elseif (strcmp($_POST['motDePasse'], $_POST['DeuxiemeMotDePasse']) != 0) {
            return 2;
        }

        try {
            //ici on teste si l'adresse mail est deja utilise
            $sql = 'Select * from utilisateur WHERE adresseMail=:adresseMail or identifiant=:identifiant';
            $statement = self::$bdd->prepare($sql);
            $statement->execute(array(':adresseMail' => htmlspecialchars($_POST['adresseMail']), ':identifiant' => htmlspecialchars($_POST['identifiant'])));
            $result = $statement->fetch();
            if ($result) {
                return 3; //adresseMail deja utilisé';
            } else {
                // ici on insere les donnee dans la BDD
                $sql = 'INSERT INTO utilisateur (adresseMail,identifiant,motDePasse) VALUES(:adresseMail,:identifiant, :motDePasse)';
                $statement = Connexion::$bdd->prepare($sql);
                $statement->execute(array(':adresseMail' => htmlspecialchars($_POST['adresseMail']), ':identifiant' => htmlspecialchars($_POST['identifiant']), 'motDePasse' => password_hash(htmlspecialchars($_POST['motDePasse']), PASSWORD_DEFAULT))); //vois si pour le mdp on fait htmlspecialchars
                return 4;
            }
        } catch (PDOException $e) {
            echo $e->getMessage() . $e->getCode();
        }
    }
}
/*
Version 1.0 - 2022/11/30
GNU GPL  Copyleft (C inversé) 2023-2033
Initiated by Hamidi.Yassine,Chouchane.Rayan,Claude.Aldric
Web Site = http://localhost/A2Z/src/index.php?module=connexion&action=connexion 
*/
?>