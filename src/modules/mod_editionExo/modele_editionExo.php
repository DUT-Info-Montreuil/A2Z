<?php

require_once("./Common/Bibliotheque_Communes/errreur404.php");
if (constant("a2z") != "rya")
	die(affichage_erreur404());


class ModeleEditionExo  extends Connexion
{

	/**
	 * fonction qui récupere l'ensembles des exercices d'une fiche
	 */
	public function recupererExercices()
	{
		$idFiche = htmlspecialchars($_GET['idFiche']);

		$sql1 = 'Select contenu from exercices where idFiche = :idFiche'; // selectionenr les exercices avec lequel l'id de la fiche existe deja et si l'exo existe deja 
		$statement1 = Connexion::$bdd->prepare($sql1);

		$statement1->execute(array(':idFiche' => $idFiche));
		$result = $statement1->fetchAll();//on  retourne tous les exos

		return $result;
	}
}
?>