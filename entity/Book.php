<?php

namespace entity;

class Book {

	 private $id;
	 private $name;
	 private $author;
	 private $year;

	 public function setId($id)
	{
		$this->id = $id;
	}

	 public function getId()
	{
		return $this->id;
	}

	 public function setname($name)
	{
		$this->name = $name;
	}

	public function getname()
	{
		 return $this->name;
	}

	 public function setauthor($author)
	{
		$this->author = $author;
	}

	public function getauthor()
	{
		 return $this->author;
	}

	 public function setyear($year)
	{
		$this->year = $year;
	}

	public function getyear()
	{
		 return $this->year;
	}

}