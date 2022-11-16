<?php


class ModeleConnexion extends Connexion
{


    public function insereInscription()
    {
        try {
            //ici on teste si l'adresse mail est deja utilise
            $sql = 'Select * from Utilisateur WHERE adresseMail=:adresseMail or identifiant=:identifiant';
            $statement = self::$bdd->prepare($sql);
            $statement->execute(array(':adresseMail' => $_POST['adresseMail'] , ':identifiant' => $_POST['identifiant'] ));
            $result = $statement->fetch();
            if($result){
                return false; //adresseMail deja utilisé';
            }

            else{

            // ici on insere les donnee dans la BDD
            $sql = 'INSERT INTO Utilisateur (adresseMail,identifiant,motDePasse) VALUES(:adresseMail,:identifiant, :motDePasse)';
            $statement = Connexion::$bdd->prepare($sql);
            $statement->execute(array(':adresseMail'=>$_POST['adresseMail'],':identifiant' => $_POST['identifiant'], 'motDePasse' => password_hash($_POST['motDePasse'], PASSWORD_DEFAULT)));
            return true;
        }
        } catch (PDOException $e) {
            echo $e->getMessage() . $e->getCode();
        }
    }

    public function verificationConnexion()
    {   
        //Verification de si on est deja connecte
        if (isset($_SESSION['identifiant'])) {
            //Vous êtes déjà connecté sous l’identifiant 
            //TROUVER UN AUTRE MOYEN POUR LE IF
        } 
        else {

            try {//On cherche si l'id existe déjà
                $sql = 'Select * from Utilisateur WHERE (identifiant=:identifiant)';
                $statement = self::$bdd->prepare($sql);
                $statement->execute(array(':identifiant' => $_POST['identifiant']));
                $result = $statement->fetch();

                if ($result) { //si l'id est correct alors on verifie le mdp
                    if (password_verify($_POST['motDePasse'], $result['motDePasse'])) {
                        $_SESSION['identifiant'] = $result['identifiant'];
                        return true; // connexion reussie au site
                    }
                }
                else {
                    return false;//pas de compte
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
        }
        else { 
            return false;//Vous devez d abord vous connecté pour faire cette action !!!
        }
    }
}
