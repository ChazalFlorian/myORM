<?php

use entity\Book;
use core\entityQuery;

require_once('autoload.php');


//Some test object
$book = new Book();
$book->setName('testtest');
$book->setAuthor(2);
$book->setYear('2012-02-17');

//test for hydrating data
$queryEdit = new entityQuery();
$queryEdit->persist($book);
$queryEdit->execute();

//test for editing data
$book->setYear('2012-02-18');
$queryEdit->update($book);
$queryEdit->execute();

//test for deleting data
//$queryEdit->remove($book);
//$queryEdit->execute();