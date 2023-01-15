<?php

require_once("./Common/Bibliotheque_Communes/errreur404.php");
if (constant("a2z") != "rya")
	die(affichage_erreur404_admin());

require_once("./connexion.php"); //


class Modele_info_statistique extends Connexion
{

    public function recuperationStatistiqueUseur()
    {
        try {
            $sql = 'SELECT COUNT(*) as userNumber FROM utilisateur WHERE idGroupes = 1 UNION ALL SELECT COUNT(*) as userNumber2 FROM utilisateur WHERE idGroupes = 2 UNION ALL SELECT COUNT(*) as totalUseur FROM utilisateur UNION ALL  SELECT COUNT(*) as nombreFiche FROM fiche  ';
            $statement = self::$bdd->prepare($sql);
            $statement->execute();
            $resultat = $statement->fetchAll(); //fetchAll pour recuper le tout dans le tableau resultat
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