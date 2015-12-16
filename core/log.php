<?php

namespace core;

class Log{
    private $date;
    private $SQLQuery;
    private $type;

    public function __construct($date){
        $this->date = $date;
    }

    public function setDate($date){
        $this->date = $date;
    }

    public function getDate(){
        return $this->date;
    }

    public function setSQLQuery($SQLQuery){
        $this->SQLQuery = $SQLQuery;
    }

    public function getSQLQuery(){
        return $this->SQLQuery;
    }

    public function setType($type){
        $this->type = $type;
    }

    public function getType(){
        return $this->type;
    }

    public function stock(){
        if($this->getType() == "Error"){
            file_put_contents("./logs/error.log","[".$this->getDate()."]".$this->getSQLQuery());
        }else{
            file_put_contents("./logs/access.log","[".$this->getDate()."]".$this->getSQLQuery());
        }
    }

}