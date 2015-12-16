<?php

namespace core;

class classAttribute
{
    private $name;
    private $type;
    private $maxVal;

    public function __construct($name){
        $this->name = $name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setMaxVal($maxVal)
    {
        $this->maxVal = $maxVal;
    }

    public function getMaxVal()
    {
        return $this->maxVal;
    }
}