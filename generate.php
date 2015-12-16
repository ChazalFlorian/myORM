<?php

use core\classGenerator;
use core\myORM;
use core\QueryBuilder;
require_once('autoload.php');


//$Entity = new classGenerator('localhost', 'root', '', 'myORM', 'Book', 'Book');
//$Entity = new classGenerator('localhost', 'root', '', 'myORM', 'Author', 'Author');
$ORM = new myORM(core\Connection::getConnection());
//$ORM->getValueFromAnnotation('entity\Author');

$query = new QueryBuilder();
$query->From('Book');
$query->Join('a', 'author', 'id');
$query->Where('name', '=', 'test');
$query->prepareQuery();
$result = $query->executeQuery();
var_dump($result);