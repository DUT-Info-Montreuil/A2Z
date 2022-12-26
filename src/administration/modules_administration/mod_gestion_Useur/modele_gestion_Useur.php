<?php

require_once("./Common/Bibliotheque_Communes/errreur404.php");
if (constant("a2z") != "rya")
    die(affichage_erreur404_admin());

use LDAP\Result;

require_once("./Common/Bibliotheque_Communes/Verification_Creation_Token.php");
require_once("./modules/mod_compte/modele_compte.php");

class ModeleConnexion_gestion_Useur extends ModeleCompte
{

    const nbr_elements_par_page = 5; //on définit ici on veut cb d'useur par page

    public function suppresionUtilisateur($idUseur)
    {
        try {
            $sql = 'DELETE FROM utilisateur WHERE utilisateur.identifiant=:identifiant ';
            $statement = self::$bdd->prepare($sql);
            $statement->execute(array(':adresseMail' => $idUseur));
            $resultat = $statement->fetchAll(); //fetchAll pour recuper le tout dans le tableau resultat
            return $resultat;
        } catch (PDOException $e) {
            echo $e->getMessage() . $e->getCode();
        }

        $sql = 'Select * from utilisateur WHERE adresseMail=:adresseMail or identifiant=:identifiant';
        $statement = self::$bdd->prepare($sql);
        $statement->execute(array(':adresseMail' => htmlspecialchars($_POST['adresseMail']), ':identifiant' => htmlspecialchars($_POST['identifiant'])));
        $result = $statement->fetch();
    }


    // fonction pour récupérer idUser, adresseMail,identifiant, motDePasse,idGroupes,cheminImage dans un tableau 
    public function recuperationInfoCompte()
    {
        if (isset($_GET["page"])) {
            $page = $_GET["page"];
        }
        if (empty($page)) {
            $page = 1; //pour que la première page soit à 1
        }
        $debut = strval(($page - 1) * self::nbr_elements_par_page); //pour convertir la chaine en int si jamais pour la requete sql  ci dessous
        try {
            $sql = "Select idUser, adresseMail,identifiant,cheminImage,idGroupes from utilisateur limit " . $debut . "," . self::nbr_elements_par_page;
            $statement = self::$bdd->prepare($sql);
            $statement->execute();
            $resultat = $statement->fetchAll(); //fetchAll pour recuper le tout dans le tableau resultat
            return $resultat;
        } catch (PDOException $e) {
            echo $e->getMessage() . $e->getCode();
        }
    }

    /**
     * cette fonction calcule le nombre de pages qu'il faut pour toutes les données
     */
    public function pagination()
    {

        try {
            $sql = 'SELECT COUNT(*) as id FROM utilisateur ';
            $statement = self::$bdd->prepare($sql);
            $statement->execute();
            $resultat = $statement->fetchAll(); //fetchAll pour recuper le tout dans le tableau resultat
            $nbr_de_pages = ceil($resultat[0]['id'] / self::nbr_elements_par_page); //ceil pour récuperer la val entière 
            return $nbr_de_pages;
        } catch (PDOException $e) {
            echo $e->getMessage() . $e->getCode();
        }
    }

    public function suppresionUseur($adminactuel)
    {
        if ($adminactuel['idUser'] == htmlspecialchars($_GET['idUseur'])) {
            return 1; //on peut pas se supprimer son compte
        }
        try {
            $sql = 'DELETE FROM `utilisateur` WHERE idUser=:idUser';
            $statement = self::$bdd->prepare($sql);
            $statement->execute(array(':idUser' => htmlspecialchars($_GET['idUseur'])));
            return 2;
        } catch (PDOException $e) {
            echo $e->getMessage() . $e->getCode();
        }
    }

    public function verificationConfirmationMdp()
    {
        //Verification de si on est deja connecte


        if (!isset($_POST['token']) || !verification_token())
            return 1; // faire une pop up et verification dans le  controlleur
        else {

            try { //On cherche si l'id existe déjà
                $sql = 'Select * from utilisateur WHERE (identifiant=:identifiant)';
                $statement = self::$bdd->prepare($sql);
                $statement->execute(array(':identifiant' => ($_SESSION['identifiant'])));
                $result = $statement->fetch();
                if ($result) { //si l'id est correct alors on verifie le mdp
                    if (password_verify(htmlspecialchars($_POST['motDePasse']), $result['motDePasse']) && $result['idGroupes'] == 2) {
                        return 2; // connexion reussie au site
                    }
                } else {
                    return 3; //false
                }
            } catch (PDOException $e) {
                echo $e->getMessage() . $e->getCode();
            }
        }
    }

    // fonction génerique pour récupérer toutes les infosd'un user dans un seul tableau 
    public function recuperationIdUser($identifiant)
    {
        try {

            $sql = 'Select idUser from utilisateur WHERE identifiant=:identifiant';
            $statement = self::$bdd->prepare($sql);
            $statement->execute(array(':identifiant' => $identifiant));
            $resultat = $statement->fetch();
            return $resultat;
        } catch (PDOException $e) {
            echo $e->getMessage() . $e->getCode();
        }
    }

    public function recuperationInfoCompteUseur()
    {
        try {
            $sql = 'Select * from utilisateur WHERE idUser=:idUseur';
            $statement = self::$bdd->prepare($sql);
            $statement->execute(array(':idUseur' => $_GET['idUseur']));
            $resultat = $statement->fetch();
            return $resultat;
        } catch (PDOException $e) {
            echo $e->getMessage() . $e->getCode();
        }
    }

    public function modificationDonneUseur()
    {
        if (!isset($_POST['token']) || !verification_token()) {
            return 1;
        }
        try {
            foreach ($_POST as $clef => $value) {
                if (!empty($_POST[$clef])  && strcmp($clef, 'token') != 0) { //si la clef n'est pas vide et la clef n'est pas "token"

                    if (strcmp($clef, 'motDePasse') == 0) {
                        // ici on insere les donnee dans la BDD
                        $sql = 'UPDATE utilisateur SET motDePasse= :motDePasse WHERE idUser =:idUser';
                        $statement = Connexion::$bdd->prepare($sql);
                        $statement->execute(array(
                            ':motDePasse' => password_hash(htmlspecialchars($_POST['motDePasse']), PASSWORD_DEFAULT),
                            ':idUser' => $_GET['idUser']
                        )); //vois si pour le mdp on fait htmlspecialchars
                    } else {


                        //on liste les colonnes que l'on peut potentiellemnt mettre a jour car il n'est pas possible de fournir 
                        //un nom de colonne de bdd dynamique
                        $colonneDIsponibleTable = array("adresseMail", "identifiant");

                        //on protege contre des attaques externe
                        if (in_array(strval($clef), $colonneDIsponibleTable)) {
                            $colonneModifier = htmlspecialchars(strval($clef));

                            //ici on teste si l'identifiant ou l'adresseMail est différents des autres
                            $sql = "Select * from utilisateur WHERE " . $colonneModifier . " = :donneUseur";
                            $statement = self::$bdd->prepare($sql);
                            $statement->execute(array(':donneUseur' => htmlspecialchars($value)));
                            $resultat = $statement->fetch();

                            //si on trouve le bon user alors
                            if ($resultat) {
                                return 4; //identifiant deja utilisé';
                            } else {
                                //on stocke à l'avance l'id du compte actuel pour pouvoir mettre à jour le $_SESSION
                                $îdUseur = $this->recuperationIdUser($_SESSION['identifiant']);

                                $sql = "UPDATE utilisateur SET " . $colonneModifier . " = :donneUseur WHERE idUser =:idUser";
                                $statement = Connexion::$bdd->prepare($sql);
                                $statement->execute(array(
                                    ':donneUseur' => htmlspecialchars($value),
                                    ':idUser' => htmlspecialchars($_GET['idUser'])
                                ));

                                //on oublie pas ici de changer également le $_SESSION actuel
                                if (strcmp($colonneModifier, 'identifiant') == 0 && strcmp($_GET['idUser'], $îdUseur['idUser']) == 0) {
                                    $_SESSION['identifiant'] = $_POST[$clef];
                                }
                            }
                        } else {
                            return 3;
                        }
                    }
                }

                /*            else{
                    return 5; // affichageAucuneInfoModifier
                }*/
            }
            return 2;
        } catch (PDOException $e) {
            echo $e->getMessage() . $e->getCode();
        }
    }

    public function inscriptionNouvelAdmin()
    {
        if (!isset($_POST['token']) || !verification_token())
            return 1;

        elseif (strcmp($_POST['motDePasse'], $_POST['DeuxiemeMotDePasse']) != 0) {
            return 2;
        }

        try {
            //ici on teste si l'adresse mail est deja utilise
            $sql = 'Select * from utilisateur WHERE adresseMail=:adresseMail or identifiant=:identifiant';
            $statement = self::$bdd->prepare($sql);
            $statement->execute(array(':adresseMail' => htmlspecialchars($_POST['adresseMail']), ':identifiant' => htmlspecialchars($_POST['identifiant'])));
            $result = $statement->fetch();
            if ($result) {
                return 3; //adresseMail deja utilisé';
            } else {
                // ici on insere les donnee dans la BDD
                $sql = 'INSERT INTO utilisateur (adresseMail,identifiant,motDePasse,idGroupes) VALUES(:adresseMail,:identifiant, :motDePasse, :idGroupes)';
                $statement = Connexion::$bdd->prepare($sql);
                $statement->execute(array(':adresseMail' => htmlspecialchars($_POST['adresseMail']), ':identifiant' => htmlspecialchars($_POST['identifiant']), 'motDePasse' => password_hash(htmlspecialchars($_POST['motDePasse']), PASSWORD_DEFAULT), 'idGroupes' => '2')); //vois si pour le mdp on fait htmlspecialchars
                return 4;
            }
        } catch (PDOException $e) {
            echo $e->getMessage() . $e->getCode();
        }
    }
}
