<?php 

require_once("./Common/Bibliotheque_Communes/errreur404.php");
if (constant("a2z") != "rya")
	die(affichage_erreur404());

class Controleurgenerique{

    protected $vue;
    protected $modele;
    protected $action;


    public function getVueControleur(){
        return $this->vue;
    }

    public function getModeleControleur(){
        return $this->modele;
    }

    
    public function getActionControleur(){
        return $this->action;
    }
}
