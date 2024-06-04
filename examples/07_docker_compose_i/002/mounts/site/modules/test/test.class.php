<?php

class test{
    var $name, $version;
    function __construct() {
        $this->name = "test";
        $this->version = "20141203";
        writeLog("module {$this->name} is loaded");
    }
    
    function process_test(){
        Page::$content = "<meter min='0' max='100' value='12'></meter>"
                . "<br />"
                . "<progress max='10' value='5' id='progress' ></progress>"
                . "<br />"
                . "<script>"
                . "function mycoolfunction(){"
                . "document.getElementById('progress').value = document.getElementById('range').value; }"
                . "</script>"
                . "<input type='date' /> <input type='range' min='1' max='10' onchange='mycoolfunction();' id='range' />";
    }
}
