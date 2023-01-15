<?php

require_once("./Common/Bibliotheque_Communes/errreur404.php");
if (constant("a2z") != "rya")
    die(affichage_erreur404());

class Modele_Connexion_Generique extends Connexion
{
    public function verificationConnexion($idGroupe)
    {
        //Verification de si on est deja connecte

        if (!isset($_POST['token']) || !verification_token())
            return 1; // faire une pop up et verification dans le  controlleur
        else {

            try { //On cherche si l'id existe déjà
                $sql = 'Select * from utilisateur WHERE (identifiant=:identifiant)';
                $statement = self::$bdd->prepare($sql);
                $statement->execute(array(':identifiant' => htmlspecialchars($_POST['identifiant'])));
                $result = $statement->fetch();
                if ($result) { //si l'id est correct alors on verifie le mdp
                    if (password_verify(htmlspecialchars($_POST['motDePasse']), $result['motDePasse']) && $result['idGroupes'] == $idGroupe) {
                        $_SESSION['identifiant'] = $result['identifiant'];
                        return true; // connexion reussie au site
                    }
                } else {
                    return false; //pas de compte
                }
            } catch (PDOException $e) {
                echo $e->getMessage() . $e->getCode();
            }
        }
    }

    public function deconnexionM()
    {
        if (isset($_SESSION["identifiant"])) {
            unset($_SESSION["identifiant"]);
            session_destroy();
            return true;
        } else {
            return false; //Vous devez d abord vous connecté pour faire cette action !!!
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
}
/*
Version 1.0 - 2022/11/30
GNU GPL  Copyleft (C inversé) 2023-2033
Initiated by Hamidi.Yassine,Chouchane.Rayan,Claude.Aldric
Web Site = http://localhost/A2Z/src/index.php?module=connexion&action=connexion 
*/
?>