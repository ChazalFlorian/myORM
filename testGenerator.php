<?php

use core\Classes\classGenerator;
use core\ORM\myORM;
require_once('autoload.php');


$Entity = new classGenerator('myORM', 'Book', 'Book');
$Entity = new classGenerator('myORM', 'Author', 'Author');
$ORM = new myORM(core\Connection::getConnection());
$ORM->getValueFromAnnotation('entity\Book');
$ORM->getValueFromAnnotation('entity\Author');