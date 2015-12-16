<?php

use core\classGenerator;
use core\myORM;
use core\QueryBuilder;
use entity\Book;
use core\entityQuery;
require_once('autoload.php');


$Entity = new classGenerator('localhost', 'root', '', 'myORM', 'Book', 'Book');
$Entity = new classGenerator('localhost', 'root', '', 'myORM', 'Author', 'Author');
$ORM = new myORM(core\Connection::getConnection());
//$ORM->getValueFromAnnotation('entity\Author');

//Some test object
$book = new Book();
$book->setName('testagain');
$book->setAuthor(2);
$book->setYear(1223);

//Test for basic query
$query = new QueryBuilder();
$query->Select();
$query->From('Book');
$query->Join('a', 'author', 'id');
$query->Where('name', '=', 'test');
$query->prepareQuery();
$result = $query->executeQuery();

//test for hydrating data
//$queryEdit = new entityQuery();
//$queryEdit->persist($book);
//$queryEdit->execute();

//test for editing data
//$book->setYear(1334);
//$queryEdit->update($book);
//$queryEdit->execute();
//test for deleting data

//$queryEdit->remove($book);
//$queryEdit->execute();
