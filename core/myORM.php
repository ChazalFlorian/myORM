<?php

namespace core;

class myORM{

    private $PDO;

    public function __construct($PDO){
        $this->PDO = $PDO;
    }

    public function getPDO(){
        return $this->PDO;
    }

    public function getValueFromAnnotation($class){
        //ReflectionClass is a native PHP class which allow to read annotations
        $rc = new \ReflectionClass($class);
        $props = $rc->getProperties();
        $SQLProperties = array();

        if(strpos($rc->getDocComment(), "Table:")){
            $start = strpos($rc->getDocComment(),":",0);//return offset of ":"
            $end =strpos($rc->getDocComment(), "\n", strpos($rc->getDocComment(),":",0));//return offset of first * after ":"
            $tableName = substr($rc->getDocComment(),($start +2) , (($end - $start) - 2));//get table Name | The minus 2 refers to ": "
            $SQLProperties['Table'] = $tableName;
        }


        foreach($props as $property)
        {
            $SQLProperty = array();
            $comment = $property->getDocComment();

            if(strpos($comment, "Var:")){
                $varName = substr($comment,(strpos($comment,"Var:",0)+5) , ((strpos($comment, "\n", strpos($comment,"Var:",0)) - (strpos($comment,"Var:",0) ))-5 ));
                $SQLProperty['Var'] = $varName;
            }
            if(strpos($comment, "Type:")){
                $typeName = substr($comment,(strpos($comment,"Type:",0)+6) , ((strpos($comment, "\n", strpos($comment,"Type:",0)) - (strpos($comment,"Type:",0) ))-6 ));
                $SQLProperty['Type'] = $typeName;
            }
            if(strpos($comment, "MaxLength:")){
                $MaxLength = substr($comment,(strpos($comment,"MaxLength:",0)+11) , ((strpos($comment, "\n", strpos($comment,"MaxLength:",0)) - (strpos($comment,"MaxLength:",0) ))-11 ));
                $SQLProperty['Max'] = $MaxLength;
            }
            if(strpos($comment, "Primary:")){
                $Primary = substr($comment,(strpos($comment,"Primary:",0)+9) , ((strpos($comment, "\n", strpos($comment,"Primary:",0)) - (strpos($comment,"Primary:",0) ))-9 ));
                $SQLProperty['Primary'] = $Primary;
            }
            if(strpos($comment, "Auto:")){
                $Auto = substr($comment,(strpos($comment,"Auto:",0)+6) , ((strpos($comment, "\n", strpos($comment,"Auto:",0)) - (strpos($comment,"Auto:",0) ))-6 ));
                $SQLProperty['Auto'] = $Auto;
            }
            array_push($SQLProperties, $SQLProperty);
        }
        $this->createFromValues($SQLProperties);
    }

    public function createFromValues($SQLProperties){
        $sql = "Create TABLE ".$SQLProperties['Table']."(";
        unset($SQLProperties['Table']);
        foreach($SQLProperties as $SQLProperty){
            $sql .= $this->createLineFromValues($SQLProperty);
            if($SQLProperty != end($SQLProperties)){
                $sql .=", ";
            }else{
                $sql .= ");";
            }
        }
        try{
            $this->getPDO()->exec($sql);
        } catch(\PDOException $e){
            echo $e->getMessage();
        }
    }

    public function createLineFromValues($SQLProperty){
        $line = "";

        $line .= $SQLProperty['Var']." ";
        switch($SQLProperty['Type']){
            case "Integer":
                $line .= "INT(11)";
                break;
            case "string":
                $line .= "VARCHAR(".$SQLProperty['Max'].")";
                break;
            case "text":
                $line .="TEXT";
                break;
            case "boolean":
                $line .= "BOOL";
                break;
            case "date":
                $line .= "DATE";
                break;
        }
        if(isset($SQLProperty['Primary'])){
            $line .= " PRIMARY KEY";
        }
        if(isset($SQLProperty['Auto'])){
            $line .= " AUTO_INCREMENT";
        }
        return $line;
    }

}