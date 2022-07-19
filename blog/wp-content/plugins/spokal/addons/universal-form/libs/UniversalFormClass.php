<?php

class UniversalFormClass{
    
    public function __construct($file){
        SpokalVars::getInstance()->htmlFromUrl = plugin_dir_url($file);
        
    }
}