<?php

namespace core\Query;

class  entityQuery{
    private $PDO;
    private $query;
    private $currentObject;

    public function __construct(){
        $this->PDO = \core\Connection::getConnection();
    }

    public function getPDO(){
        return $this->PDO;
    }

    public function setQuery($query){
        $this->query = $query;
    }

    public function getQuery(){
        return $this->query;
    }

    public function addQuery($query){
        $this->query .= $query;
    }

    public function setCurrentObject($currentObject){
        $this->currentObject = $currentObject;
    }

    public function getCurrentObject(){
        return $this->currentObject;
    }

    public function remove($object){
        $tableName = substr(get_class($object), 7);
        $this->setQuery("DELETE FROM ".$tableName." WHERE id = ".$object->getId());
    }

    public function persist($object){
        $tableName = substr(get_class($object), 7);
        $classVars = (array)$object;
        $this->setQuery("INSERT INTO ".$tableName." VALUES (");
        foreach($classVars as $name => $value){
            if($name == 'id'){$value='';}
            if(intval($value)){
                $this->addQuery($value);
            }else{
                $this->addQuery("'".$value."'");
            }

            if($value != end($classVars))
            {
                $this->addQuery(", ");
            }else{
                $this->addQuery(");");
            }
        }
        $this->setCurrentObject($object);
    }

    public function update($object){;
        $tableName = substr(get_class($object), 7);
        $class_vars = (array)$object;
        $this->setQuery("UPDATE ".$tableName." SET ");
        foreach($class_vars as $name => $value){
            if(substr(strrchr($name,0),1) !="id"){
                if(intval($value)){
                    $this->addQuery(substr(strrchr($name,0),1)." = ".$value);
                }else{
                    $this->addQuery(substr(strrchr($name,0),1)." = '".$value."'");
                }
                if($value != end($class_vars))
                {
                    $this->addQuery(", ");
                }
            }
        }
        $this->addQuery(" WHERE id=".$object->getId());
    }

    public function execute(){
        $log = new Log(date('Y-m-d H:i:s'));
        $sth = $this->getPDO()->prepare($this->getQuery());
        try{
            $sth->execute();
            $log->setSQLQuery($this->getQuery());
            $log->setType("Access");
            if(isset($this->currentObject)){
                $this->getCurrentObject()->setId($this->getPDO()->lastInsertId());
                unset($this->currentObject);
            }
            unset($this->query);
        }catch(\PDOException $e){
            $log->setSQLQuery($e->getMessage());
            $log->setType("Error");
        }

    }
}