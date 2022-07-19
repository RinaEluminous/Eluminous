<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SpokalVars
 *
 * @author Korisnik
 */
class SpokalVars {
    
    private $vars = array();
    
    private $false = false;
    
    private $true = true;

    public static function getInstance(){
        global $spokalVars;

        if($spokalVars == null)
                $spokalVars = new SpokalVars();

        return $spokalVars;
    }

    public function &__set($key, $value){
            $this->vars[$key] = $value;
            return $this->true;
    }

    public function &__get($key){
        if(array_key_exists( $key, $this->vars )){
            return $this->vars[$key];
        }else{
            return $this->false;
        }
    }
}

?>
