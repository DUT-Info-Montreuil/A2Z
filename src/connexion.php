<?php

class Connexion{

    protected static $bdd;


    //initialise $bdd 

    public static function initConnexion(){

        //self :: $bdd = new PDO('mysql:host=database-etudiants.iut.univ-paris8.fr;dbname=dutinfopw201619', 'dutinfopw201619', 'gysezypu'); // on met self :: car c'est champ statique à l’intérieur d’une classe
        //pour rayan NE PAS SUPPRIMER ET UTILISER L AUTRE BDD
        //self :: $bdd = new PDO('mysql:host=localhost;dbname=dutinfopw201620', 'dutinfopw201620', 'dejyjamu');  
        //self :: $bdd = new PDO('mysql:host=sunixes.com;dbname=A2Z', 'A2Z', '5Zapo5DMEW3m&UgZB%!qAhEr*^5Z7oF&^c4!5#BHUXU^Uy$i86sk38yp84zQ%#gE');  
                
        //pour yassine le BG NE PAS SUPPRIMER ET UTILISER L AUTRE BDD
          self::$bdd = new PDO('mysql:host=localhost;dbname=dutinfopw201620', 'yassine', 'yassine');
    }
}

?>