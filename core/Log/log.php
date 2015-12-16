<?php

namespace core\Log;

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
            $file = file_get_contents("./logs/error.log");
            $file .= "[".$this->getDate()."]".$this->getSQLQuery();
            file_put_contents("./logs/error.log",$file);
        }else{
            $file = file_get_contents("./logs/access.log");
            $file .= "[".$this->getDate()."]".$this->getSQLQuery();
            file_put_contents("./logs/access.log",$file);
        }
    }

}