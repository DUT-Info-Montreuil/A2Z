<?php

require_once("./Common/Bibliotheque_Communes/errreur404.php");
if (constant("a2z") != "rya")
    die(affichage_erreur404());

class ModeleNavBar extends Connexion
{

    public function recupererPhoto()
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
     * fonction recupere l'id de la dernier fiche créer
     */
    function recupererDerniereFicheUser()
    {

        try {
            $sql1 = "select idFiche from fiche join utilisateur using (idUser) where identifiant = :identifiant  ORDER BY `fiche`.`dateEcriture` DESC LIMIT 0, 1";
            $statement1 = Connexion::$bdd->prepare($sql1);
            $statement1->execute(array(':identifiant' => $_SESSION['identifiant']));
            $result = $statement1->fetch(); //on  retourne tous les exos
            return $result;
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