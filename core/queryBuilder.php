<?php

namespace core;

class QueryBuilder{
    private $Query;
    private $Alias;
    private $PDO;

    public function __construct(){
        $this->PDO = Connection::getConnection();
    }

    public function Select(){
        $this->Query = "SELECT * ";
    }

    public function Count(){
        $this->Query = "SELECT COUNT(*)";
    }

    public function Exists($from, $where, $value){
        $this->Query .= "WHERE EXISTS ( SELECT * FROM ".$from." WHERE ".$where." = ".$value." )";
    }

    public function Max($attribute){
        $this->Query = "SELECT MAX(".$attribute.")";
    }

    public function From($table){
        $this->Alias = substr(strtolower($table), 0, 1);
        $this->Query .= "FROM ".$table." ".$this->Alias." ";
    }

    public function Where($attribute, $comparator, $value){
        $this->Query .= "WHERE ".$this->Alias.".".$attribute." ".$comparator." '".$value."' ";
    }

    public function andWhere($attribute, $comparator, $value){
        $this->Query .= "AND ".$this->Alias.".".$attribute." ".$comparator." ".$value." ";
    }

    public function orWhere($attribute, $comparator, $value){
        $this->Query .= "OR ".$this->Alias.".".$attribute." ".$comparator." ".$value." ";
    }

    public function customWhere($query){
        $this->Query.= $query." ";
    }

    public function Join($alias, $table, $link){
        $this->Query .= "JOIN ".$table." ".$alias." ON ".$this->Alias.".".$table." = ".$alias.".".$link." ";
    }

    public function OrderBy($value = "ASC"){
        $this->Query.= "ORDER BY ".$value." ";
    }

    public function prepareQuery(){
        $this->Query.=";";
        var_dump($this->Query);
    }

    public function executeQuery(){
        $log = new Log(date('Y-m-d H:i:s'));
        try{
            $sth = $this->PDO->prepare($this->Query);
            $sth->execute();
            $result = $sth->fetchAll();
            $log->setSQLQuery($this->Query);
            $log->setType("Access");
        }catch (\PDOException $e){
            $log->setSQLQuery($e->getMessage());
            $log->setType("Error");
        }
        $log->stock();
        return $result;
    }
}