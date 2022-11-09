<?php


class Vue_Generique 
{

    public function  __construct()
    {
        ob_start();
    }
  
    public function affichageTampon(){
        return ob_get_clean();
    }
}

    ?>

