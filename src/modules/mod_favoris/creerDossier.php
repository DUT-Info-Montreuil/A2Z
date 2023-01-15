<?php

require_once "../../connexion.php";

session_start();

class dossierBDD extends Connexion
{

    public function  __construct()
  {
    parent::initConnexion();
    }

    function envoieDossierBdd() {
      try {

        $sql = 'select idUser from utilisateur where identifiant = :identifiant';
        $stmt = self::$bdd->prepare($sql);
        
        $stmt->execute(array(':identifiant' => $_SESSION['identifiant']));
        $tabretour = $stmt->fetch();
        $idUser =$tabretour['idUser'];

        $sql2 = 'INSERT INTO dossier(nomDossier, idParent, idUser) VALUES ( :nomDossier , :idParent, :idUser)';
        $stmt2 = self::$bdd->prepare($sql2); 


        $location = intval ($_POST['location']);
        $stmt2->execute(array(':nomDossier'=> htmlspecialchars($_POST['dossier']), ':idParent'=> htmlspecialchars($location), ':idUser'=> htmlspecialchars($idUser)));
        
        $sql3 = 'select idDossier from dossier where nomDossier = :nomDossier';
        $stmt3 = self::$bdd->prepare($sql3);

        $stmt3->execute(array(':nomDossier' =>htmlspecialchars($_POST['dossier'])));
        $tabretour2 = $stmt3->fetch();
        $idDossier = $tabretour2['idDossier'];

      } catch (PDOException $e) {
        echo false;

      }
      echo $idDossier;
    }

    public function recupereDossierSelonLocation() {
      try {
      $sql = "select idDossier, nomDossier from dossier join utilisateur using (idUser) where identifiant = :id and idParent = :idParent";
      $stmt = self::$bdd->prepare($sql);
      $stmt->execute(array(":idParent" =>htmlspecialchars($_POST['idParent']), ":id" => $_SESSION['identifiant']));
      
      $resultat = $stmt->fetchAll();
      } catch (PDOException $e) {
      echo false;
    }
    echo json_encode($resultat);

  }

  public function supprimerDossier() {
    try{      
      $sql = "DELETE from dossier where idDossier = :idDossier";
      $stmt = self::$bdd->prepare($sql);
      $stmt->execute(array(":idDossier" => htmlspecialchars($_POST['idDossier'])));

    }catch (PDOException $e) {
      echo false;
    }
    echo true;
  }


}
$dossier = new dossierBDD();

if(isset($_POST['idDossier'])){
$dossier->supprimerDossier();
}
if (isset($_POST['dossier'])){
  $dossier->envoieDossierBdd();
 }

if (isset($_POST['idParent'])){
  $dossier->recupereDossierSelonLocation();
}

/*
Version 1.0 - 2022/11/30
GNU GPL  Copyleft (C inversé) 2023-2033
Initiated by Hamidi.Yassine,Chouchane.Rayan,Claude.Aldric
Web Site = http://localhost/A2Z/src/index.php?module=connexion&action=connexion 
*/
?>