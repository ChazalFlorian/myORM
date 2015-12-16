<?php

namespace entity;

/**
*Table: Author
**/
class Author {

	/**
	*Var: Id
	*Type: Integer
	*Primary: True
	*Auto: True
	**/
	 private $id;
	/**
	*Var: name
	*Type: string
	*MaxLength: 120
	**/
	 private $name;

	/**
	*Var: style
	*Type: text
	**/
	 private $style;


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

	 public function setStyle($style)
	{
		$this->style = $style;
	}

	public function getStyle()
	{
		 return $this->style;
	}

}