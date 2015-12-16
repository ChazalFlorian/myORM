<?php

namespace entity;

/**
*Table: Book
**/
class Book {

	/**
	*Var: Id
	*Type: Integer
	*Primary: True
	*Auto: True
	**/
	 private $id;
	/**
	*Var: name
	*Type: text
	**/
	 private $name;

	/**
	*Var: author
	*Type: string
	*MaxLength: 123
	**/
	 private $author;

	/**
	*Var: year
	*Type: date
	**/
	 private $year;


	 public function setId($id)
	{
		$this->id = $id;
	}

	 public function getId()
	{
		return $this->id;
	}

	 public function setName($name)
	{
		$this->name = $name;
	}

	public function getName()
	{
		 return $this->name;
	}

	 public function setAuthor($author)
	{
		$this->author = $author;
	}

	public function getAuthor()
	{
		 return $this->author;
	}

	 public function setYear($year)
	{
		$this->year = $year;
	}

	public function getYear()
	{
		 return $this->year;
	}

}