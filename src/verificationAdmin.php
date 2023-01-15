<?php

require_once("./Common/Bibliotheque_Communes/errreur404.php");
if (constant("a2z") != "rya")
    die(affichage_erreur404());

require_once("./connexion.php");

class  VerifAdmin extends Connexion
{

    public static function verificationConnexionAdmin()
    {

        if (isset($_SESSION['identifiant'])) {

            try {
                $sql = 'Select * from utilisateur WHERE (identifiant=:identifiant)';
                $statement = Connexion::$bdd->prepare($sql);
                $statement->execute(array(':identifiant' => $_SESSION['identifiant']));
                $result = $statement->fetch();
                if ($result) {
                    if ($result['idGroupes'] == 2) {
                        return true;
                    }
                } else {
                    return false;
                }
            } catch (PDOException $e) {
                echo $e->getMessage() . $e->getCode();
            }
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

