<?php

function my_autoload($class){
    require_once(__DIR__ . "\\" . $class . ".php");
}
spl_autoload_register("my_autoload");