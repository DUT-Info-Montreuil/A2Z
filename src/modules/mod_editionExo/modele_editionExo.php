<?php

require_once("./Common/Classe_Generique/modele_connexion_generique.php");

if (constant("a2z") != "rya")
	die(affichage_erreur404());

class ModeleEditionExo  extends Modele_Connexion_Generique
{

	public function __construct()
    {
        parent::initConnexion();
    }

	/**
	 * fonction qui récupere l'ensembles des exercices d'une fiche
	 */
	public function recupererExercices()
	{
		$idFiche = htmlspecialchars($_GET['idFiche']);
		
		$idUseur = $this->recuperationInfoCompte();
		$sql1 ='Select contenu from exercices join fiche using (idFiche) where idUser = :idUser and idFiche = :idFiche ORDER BY positionExercice '; // selectionenr les exercices avec lequel l'id de la fiche existe deja et si l'exo existe deja 
		$statement1 = Connexion::$bdd->prepare($sql1);

		$statement1->execute(array(':idFiche' => htmlspecialchars($idFiche) , ':idUser' => htmlspecialchars($idUseur['idUser'])));
		$result = $statement1->fetchAll();//on  retourne tous les exos

		return $result;
	}

		/**
	 * fonction qui récupere l'ensembles des exercices d'une fiche
	 */
	public function recupererImages()
	{
		$idFiche = htmlspecialchars($_GET['idFiche']);

		$sql1 = 'Select * from images where idUser = :idUser ORDER BY Dateimage'; // selectionenr les exercices avec lequel l'id de la fiche existe deja et si l'exo existe deja 
		$statement1 = Connexion::$bdd->prepare($sql1);
		$idUseur =$this->recuperationInfoCompte();

		$statement1->execute(array(':idUser' => htmlspecialchars($idUseur['idUser'])));
		$result = $statement1->fetchAll();//on  retourne tous les exos

		return $result;
	}

		/**
	 * fonction sécurise pour éviter d'accéder à des fiches inconnue ou appartenant à quelqu'un d'autres
	 */
	public function verificationDroitAccesFiche()
	{
		$idFiche = htmlspecialchars($_GET['idFiche']);
		
		$idUseur = $this->recuperationInfoCompte();
		$sql1 ='Select * from fiche where idUser = :idUser and idFiche = :idFiche'; // selectionenr les exercices avec lequel l'id de la fiche existe deja et si l'exo existe deja 
		$statement1 = Connexion::$bdd->prepare($sql1);
		$statement1->execute(array(':idFiche' => htmlspecialchars($idFiche) , ':idUser' => htmlspecialchars($idUseur['idUser'])));
		$result = $statement1->fetchAll();//on  retourne tous les exos
		return $result;
	}
	
}
/*
Version 1.0 - 2022/11/30
GNU GPL  Copyleft (C inversé) 2023-2033
Initiated by Hamidi.Yassine,Chouchane.Rayan,Claude.Aldric
Web Site = http://localhost/A2Z/src/index.php?module=connexion&action=connexion 
*/
?>