<?php

use core\classGenerator;
use core\myORM;
require_once('autoload.php');


$Entity = new classGenerator('myORM', 'Book', 'Book');
$Entity = new classGenerator('myORM', 'Author', 'Author');
$ORM = new myORM(core\Connection::getConnection());
$ORM->getValueFromAnnotation('entity\Book');
$ORM->getValueFromAnnotation('entity\Author');