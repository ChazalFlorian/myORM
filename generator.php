<?php

use core\Classes\classGenerator;
use core\ORM\myORM;

require_once('autoload.php');

core\Connection::setDBHost($argv[1]);
core\Connection::setDBUser($argv[2]);
//core\Connection::setDBPass($argv[3]);
core\Connection::setDBName($argv[4]);

$Entity = new classGenerator($argv[4], $argv[5], $argv[6]);
$ORM = new myORM(core\Connection::getConnection());
$ORM->getValueFromAnnotation('entity\\'.$argv[5]);