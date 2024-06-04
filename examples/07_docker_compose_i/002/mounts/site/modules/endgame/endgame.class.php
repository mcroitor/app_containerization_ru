<?php

class endgame {

    var $name;
    var $version;

    function __construct() {
        $this->name = "endgame";
        $this->version = "20141216";
        writeLog("module {$this->name} is loaded");
    }
    
    function process_endgame(){
        global $dblink;
        
        Page::$content = "endgames";
    }
}