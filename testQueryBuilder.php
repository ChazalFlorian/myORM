<?php

use core\Query\QueryBuilder;
require_once('autoload.php');


//Test for basic query
$query = new QueryBuilder();
$query->Select();
$query->From('Book');
$query->Join('a', 'author', 'id');
$query->Where('name', '=', 'test');
$query->prepareQuery();
$result = $query->executeQuery();
var_dump($result);

$query2 = new QueryBuilder();
$query2->Count();
$query2->From('Book');
$query2->Where('name', '=', 'testagain');
$query2->prepareQuery();
$result2 = $query2->executeQuery();
var_dump($result2);