<?php

use core\classGenerator;
use core\myORM;
require_once('autoload.php');


//$Entity = new classGenerator('localhost', 'root', '', 'myORM', 'Book', 'Book');
$ORM = new myORM(core\Connection::getConnection());
$ORM->getValueFromAnnotation('entity\Book');
