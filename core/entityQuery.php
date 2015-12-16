<?php

namespace core;

class  entityQuery{
    private $PDO;
    private $query;
    private $currentObject;

    public function __construct(){
        $this->PDO = Connection::getConnection();
    }

    public function remove($object){
        $tableName = substr(get_class($object), 7);
        $this->query = "DELETE FROM ".$tableName." WHERE id = ".$object->getId();
    }

    public function persist($object){
        $tableName = substr(get_class($object), 7);
        $classVars = (array)$object;
        $this->query = "INSERT INTO ".$tableName." VALUES (";
        foreach($classVars as $name => $value){
            if($name == 'id'){$value='';}
            if(intval($value)){
                $this->query.= $value;
            }else{
                $this->query.= "'".$value."'";
            }

            if($value != end($classVars))
            {
                $this->query.=", ";
            }else{
                $this->query.=");";
            }
        }
        $this->currentObject = $object;
    }

    public function update($object){;
        $tableName = substr(get_class($object), 7);
        $class_vars = (array)$object;
        $this->query = "UPDATE ".$tableName." SET ";
        foreach($class_vars as $name => $value){
            if(substr(strrchr($name,0),1) !="id"){
                if(intval($value)){
                    $this->query.= substr(strrchr($name,0),1)." = ".$value;
                }else{
                    $this->query.= substr(strrchr($name,0),1)." = '".$value."'";
                }
                if($value != end($class_vars))
                {
                    $this->query.=", ";
                }
            }
        }
        $this->query.= " WHERE id=".$object->getId();
    }

    public function execute(){
        $sth = $this->PDO->prepare($this->query);
        $sth->execute();
        if(isset($this->currentObject)){
            $this->currentObject->setId($this->PDO->lastInsertId());
            unset($this->currentObject);
        }
        unset($this->query);
    }
}