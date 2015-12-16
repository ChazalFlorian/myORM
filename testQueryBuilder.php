<?php

use core\QueryBuilder;
require_once('autoload.php');


//Test for basic query
$query = new QueryBuilder();
$query->Select();
$query->From('Book');
$query->Join('a', 'author', 'id');
$query->Where('name', '=', 'test');
$query->prepareQuery();
$result = $query->executeQuery();