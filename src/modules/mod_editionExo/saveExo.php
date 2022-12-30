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
        //var_dump($exerciceJSON);
        $tableauContenuExerciceDecode = json_decode($exerciceJSON, true);
        //decoder le json en fichier
        try {
            // faire une boucle for qui va d'une part
            $idFiche = htmlspecialchars($tableauContenuExerciceDecode['idFiche']);

            //requete SQL
            $sql = 'INSERT into exercices (idExo, contenu, idFiche,positionExercice)  VALUES (:idExo , :contenu, :idFiche, :positionExercice)';
            $sql1 = 'SELECT * from exercices where idFiche = :idFiche and idExo = :idExo'; // selectionenr les exercices avec lequel l'id de la fiche existe deja et si l'exo existe deja 
            $sql2 = 'UPDATE exercices SET contenu= :contenu , positionExercice =:positionExercice WHERE idExo =:idExo';
            $sql3 = 'SELECT idExo FROM exercices WHERE idFiche = :idFiche'; // selectionenr les exercices avec lequel l'id de la fiche existe deja et si l'exo existe deja 
            $sql4 = 'DELETE FROM exercices WHERE idExo =:idExo';

            //preparation des requetes SQL
            $statement = Connexion::$bdd->prepare($sql);
            $statement1 = Connexion::$bdd->prepare($sql1);
            $statement2 = Connexion::$bdd->prepare($sql2);
            $statement3 = Connexion::$bdd->prepare($sql3);
            $statement4 = Connexion::$bdd->prepare($sql4);
            $statement3->execute(array(':idFiche' => $idFiche));
            $exoDansLaBDD = $statement3->fetchAll(); //structure ne dictionnaire

            $nouveauxTableauBdd = array(); //pour éviter d'avoir un tableau en dictionnaire de la BDD

            $tailleTableauSite = count($exoDansLaBDD);
            $tailleTableauBdd = count($tableauContenuExerciceDecode['idExo']);

            $nouveauxTableauBdd = array_map(fn($value) : string => $value['idExo'], $exoDansLaBDD);//on remplit un nouveux tab avec tous les id des exos qui sera utilisé pour l'insertion car il est plus simple et évite de faire trop de boucle for

            for ($i = 0; $i < $tailleTableauSite || $i < $tailleTableauBdd; $i++) {  //parcours de la bd et compare si delete, insert ou update en fonction

                if ($i < $tailleTableauBdd) {
                    $this->inserer($tableauContenuExerciceDecode, $i, $nouveauxTableauBdd, $statement, $idFiche);
                }
                if ($i < $tailleTableauSite) {
                    $this->modifierOuSupprimer($i, $exoDansLaBDD, $tableauContenuExerciceDecode, $statement2, $statement4);
                }

            }
        } catch (PDOException $e) {
            echo $e->getMessage() . $e->getCode();
        }
    }

    private function modifierOuSupprimer($i, $exoDansLaBDD, $tableauContenuExerciceDecode, $statement2, $statement4)
    {
        if (in_array($exoDansLaBDD[$i]['idExo'], $tableauContenuExerciceDecode['idExo'])) { //update
            $indiceExoSite = htmlspecialchars(array_search($exoDansLaBDD[$i]['idExo'], $tableauContenuExerciceDecode['idExo'])); //on cherche lebon index pour le tableau du site web

            //update
            $idExercice = htmlspecialchars($tableauContenuExerciceDecode['idExo'][$indiceExoSite]); //recuperation de l'id de l'exo
            $html =  htmlspecialchars($tableauContenuExerciceDecode['html'][$indiceExoSite]); // recuperation de l'html   
            $positionExercice = htmlspecialchars($tableauContenuExerciceDecode['positionExercice'][$i]);
                 
            $tableauExec = array(':contenu' => json_encode($html), ':idExo' => $idExercice, ':positionExercice'=> $positionExercice);
            $statement2->execute($tableauExec);
        } else {
            //delete
            $idExerciceBdd = htmlspecialchars($exoDansLaBDD[$i]['idExo']); //recuperation de l'id de l'exo
            $tableauExec = array(':idExo' => $idExerciceBdd); //delete
            $statement4->execute($tableauExec);
        }
    }

    private function inserer($tableauContenuExerciceDecode, $i, $nouveauxTableauBdd, $statement, $idFiche)
    {
        $res = in_array($tableauContenuExerciceDecode['idExo'][$i], $nouveauxTableauBdd); //on vérifie si l'exo n'existe pas déjà dans la BDD

        if (!$res) { //Si l'id de l'exo n'existe pas alors on l'insert
            //variable de recuperation de données
            $idExercice = htmlspecialchars($tableauContenuExerciceDecode['idExo'][$i]); //recuperation de l'id de l'exo
            $html =  htmlspecialchars($tableauContenuExerciceDecode['html'][$i]); // recuperation de l'html
            $positionExercice = htmlspecialchars($tableauContenuExerciceDecode['positionExercice'][$i]);

            var_dump($html);
            $tableauExec = array(':idExo' => $idExercice, ':contenu' => json_encode($html), ':idFiche' => $idFiche, ':positionExercice'=> $positionExercice);
            $statement->execute($tableauExec); //vois si pour le mdp on fait htmlspecialchars
        }
    }
}

$exoSauvegarder = new saveExo();
$exoSauvegarder->insererDonneesExercices();
