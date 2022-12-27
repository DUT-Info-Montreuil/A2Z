<?php

require_once "../../connexion.php";

session_start();

class saveExo extends connexion
{


    public function __construct()
    {
        parent::initConnexion();
    }


    public function insererDonneesExercices()
    {
        $exerciceJSON = $_POST['stringRecu']; // tableau en JSON contenant tout (id et le code html)
        $tableauContenuExerciceDecode = json_decode($exerciceJSON, true);
        //decoder le json en fichier

        try {
            // faire une boucle for qui va d'une part
            $idFiche = htmlspecialchars($tableauContenuExerciceDecode['idFiche']);

            //requete SQL
            $sql = 'INSERT INTO exercices (idExo, contenu, idFiche)  VALUES (:idExo , :contenu, :idFiche)';
            $sql1 = 'SELECT * FROM exercices WHERE idFiche = :idFiche AND idExo = :idExo'; // selectionenr les exercices avec lequel l'id de la fiche existe deja et si l'exo existe deja 
            $sql2 = 'UPDATE exercices SET contenu= :contenu WHERE idExo =:idExo';
            $sql3 = 'SELECT idExo FROM exercices WHERE idFiche = :idFiche'; // selectionenr les exercices avec lequel l'id de la fiche existe deja et si l'exo existe deja 
            $sql4 = 'DELETE FROM exercices WHERE idExo =:idExo';

            //preparation des requetes SQL
            $statement = Connexion::$bdd->prepare($sql);
            $statement1 = Connexion::$bdd->prepare($sql1);
            $statement2 = Connexion::$bdd->prepare($sql2);
            $statement3 = Connexion::$bdd->prepare($sql3);
            $statement4 = Connexion::$bdd->prepare($sql4);
            $statement3->execute(array(':idFiche' => $idFiche));
            $exoDansLaBDD = $statement3->fetchAll();//structure ne dictionnaire
            $nouveauxTableu = array();//pour éviter d'avoir un tableau en dictionnaire de la BDD

            for ($i = 0; $i < count($exoDansLaBDD); $i++) {  //parcours de la bd et compare si delete ou update en fonction
                if (in_array($exoDansLaBDD[$i]['idExo'], $tableauContenuExerciceDecode['idExo'])) { //update
                    $indiceExoSite = htmlspecialchars(array_search($exoDansLaBDD[$i]['idExo'], $tableauContenuExerciceDecode['idExo']));//on cherche lebon index pour le tableau du site web
                    
                    //update
                    $idExercice = htmlspecialchars($tableauContenuExerciceDecode['idExo'][$indiceExoSite]); //recuperation de l'id de l'exo
                    $html =  htmlspecialchars($tableauContenuExerciceDecode['html'][$indiceExoSite]); // recuperation de l'html                    
                    $tableauExec = array(':contenu' => json_encode($html), ':idExo' => $idExercice);
                    $statement2->execute($tableauExec);
                } else {
                    //delete
                    $idExerciceBdd = htmlspecialchars($exoDansLaBDD[$i]['idExo']); //recuperation de l'id de l'exo
                    $tableauExec = array(':idExo' => $idExerciceBdd); //delete
                    $statement4->execute($tableauExec);
                }
                $nouveauxTableu[$i] = $exoDansLaBDD[$i]['idExo'];//on remplit un nv tab qui sera utilisé pour l'insertion car il est plus simple et évite de faire trop de boucle for
            }

            for ($i = 0; $i < count($tableauContenuExerciceDecode['idExo']); $i++) { // boucle for pour l'insertion dans la BDD
                $res = in_array($tableauContenuExerciceDecode['idExo'][$i], $nouveauxTableu); //on vérifie si l'exo n'existe pas déjà dans la BDD

                if (!$res) { //Si l'id de l'exo n'existe pas alors on l'insert
                    //variable de recuperation de données
                    $idExercice = htmlspecialchars($tableauContenuExerciceDecode['idExo'][$i]); //recuperation de l'id de l'exo
                    $html =  htmlspecialchars($tableauContenuExerciceDecode['html'][$i]); // recuperation de l'html
                    $tableauExec = array(':idExo' => $idExercice, ':contenu' => json_encode($html), ':idFiche' => $idFiche);
                    $statement->execute($tableauExec); //vois si pour le mdp on fait htmlspecialchars
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage() . $e->getCode();
        }
    }
}

$exoSauvegarder = new saveExo();
$exoSauvegarder->insererDonneesExercices();