<?php

use core\classGenerator;

require_once('autoload.php');


$Entity = new classGenerator('localhost', 'root', '', 'myORM', 'Book', 'Book');

var_dump($Entity);