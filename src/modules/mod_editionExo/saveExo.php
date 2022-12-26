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

        /*
        $idAsupprimer = $_POST['idAsupp']; // tableau en JSON contenant tout (id et le code html)
        var_dump($idAsupprimer);
        */


        
        try {
            // faire une boucle for qui va d'une part
            $idFiche = htmlspecialchars($tableauContenuExerciceDecode['idFiche']);



            //requete SQL
            $sql = 'INSERT into exercices (idExo, contenu, idFiche)  VALUES (:idExo , :contenu, :idFiche)';
            $sql1 = 'Select * from exercices where idFiche = :idFiche and idExo = :idExo'; // selectionenr les exercices avec lequel l'id de la fiche existe deja et si l'exo existe deja 
            $sql2 = 'UPDATE exercices SET contenu= :contenu WHERE idExo =:idExo';
            $sql3 = 'Select idExo from exercices where idFiche = :idFiche'; // selectionenr les exercices avec lequel l'id de la fiche existe deja et si l'exo existe deja 
            $sql4 = 'DELETE FROM exercices WHERE idExo =:idExo';

            //preparation des requetes SQL
            $statement = Connexion::$bdd->prepare($sql);
            $statement1 = Connexion::$bdd->prepare($sql1);
            $statement2 = Connexion::$bdd->prepare($sql2);
            $statement3 = Connexion::$bdd->prepare($sql3);
            $statement4 = Connexion::$bdd->prepare($sql4);



            $statement3->execute(array(':idFiche' => $idFiche));
            $exoDansLaBDD = $statement3->fetchAll();
            var_dump(count($exoDansLaBDD));

            
            //                count = 3
            for($i = 0 ; $i < count($exoDansLaBDD); $i++){  //parcours de la bd 
                
                echo count($tableauContenuExerciceDecode['idExo']);
                var_dump(count($exoDansLaBDD));
                $idExercice = htmlspecialchars($tableauContenuExerciceDecode['idExo'][$i]); //recuperation de l'id de l'exo
                $html =  htmlspecialchars($tableauContenuExerciceDecode['html'][$i]); // recuperation de l'html

                var_dump($idExercice);
                var_dump($html);
                echo $i;

                if(in_array($tableauContenuExerciceDecode['idExo'],$exoDansLaBDD)){//update
                    $tableauExec = array(':contenu' => json_encode($html), ':idExo' => $idExercice);
                    $statement2->execute($tableauExec);
                    echo 'update';
                    
                }
                else{
                    $tableauExec = array(':idExo' => $idExercice);//delete
                    echo $idExercice;
                    $statement4->execute($tableauExec);
                    echo 'je suis la ';
                    
                }
            }


            /*for ($i = 0; $i < count($tableauContenuExerciceDecode['idExo']); $i++) { //verification de tout les exos

                //variable de recuperation de données
                $idExercice = htmlspecialchars($tableauContenuExerciceDecode['idExo'][$i]); //recuperation de l'id de l'exo
                $html =  htmlspecialchars($tableauContenuExerciceDecode['html'][$i]); // recuperation de l'html


                //verification (select)
                $statement1->execute(array(':idFiche' => $idFiche, ':idExo' => $idExercice));
                $result = $statement1->fetch();


                if ($result) { // si l'exo existe alors on le modifie (update)
                    $tableauExec = array(':contenu' => json_encode($html), ':idExo' => $idExercice);
                    $statement2->execute($tableauExec);
                    
                } else { // sinon on le crée (insert)
                    $tableauExec = array(':idExo' => $idExercice, ':contenu' => json_encode($html), ':idFiche' => $idFiche);
                    $statement->execute($tableauExec); //vois si pour le mdp on fait htmlspecialchars
                    
                }
            }*/

           
            


        } catch (PDOException $e) {
            echo $e->getMessage() . $e->getCode();
        }
    }


}





$exoSauvegarder = new saveExo();
$exoSauvegarder->insererDonneesExercices();


?>