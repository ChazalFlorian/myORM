<?php

use core\classGenerator;
use core\myORM;
use core\QueryBuilder;
require_once('autoload.php');


//$Entity = new classGenerator('localhost', 'root', '', 'myORM', 'Book', 'Book');
$ORM = new myORM(core\Connection::getConnection());
//$ORM->getValueFromAnnotation('entity\Book');

$query = new QueryBuilder();
$query->From('Book');
$query->Where('name', '=', 'test');
$query->prepareQuery();
$result = $query->executeQuery();