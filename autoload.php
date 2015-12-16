<?php

function my_autoload($class){
    if(file_exists(__DIR__ . "\\" . $class . ".php")){
        require_once(__DIR__ . "\\" . $class . ".php");
    }

}
spl_autoload_register("my_autoload");