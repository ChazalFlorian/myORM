<?php

namespace core\Query;

class QueryBuilder{
    private $Query;
    private $Alias;
    private $PDO;

    public function __construct(){
        $this->PDO = \core\Connection::getConnection();
    }

    public function getPDO(){
        return $this->PDO;
    }

    public function setQuery($query){
        $this->Query = $query;
    }

    public function getQuery(){
        return $this->Query;
    }

    public function addQuery($query){
        $this->Query .= $query;
    }

    public function setAlias($alias){
        $this->Alias = $alias;
    }

    public function getAlias(){
        return $this->Alias;
    }

    public function Select(){
        $this->setQuery("SELECT * ");
    }

    public function Count(){
        $this->setQuery("SELECT COUNT(*) ");
    }

    public function Max($attribute){
        $this->setQuery("SELECT MAX(".$attribute.")");
    }

    public function From($table){
        $this->setAlias(substr(strtolower($table), 0, 1));
        $this->addQuery("FROM ".$table." ".$this->Alias." ");
    }

    public function Where($attribute, $comparator, $value){
        $this->addQuery("WHERE ".$this->Alias.".".$attribute." ".$comparator." '".$value."' ");
    }

    public function andWhere($attribute, $comparator, $value){
        $this->addQuery("AND ".$this->Alias.".".$attribute." ".$comparator." ".$value." ");
    }

    public function orWhere($attribute, $comparator, $value){
        $this->addQuery("OR ".$this->Alias.".".$attribute." ".$comparator." ".$value." ");
    }

    public function customWhere($query){
        $this->addQuery($query." ");
    }

    public function Exists($from, $where, $value){
        $this->addQuery("WHERE EXISTS ( SELECT * FROM ".$from." WHERE ".$where." = ".$value." )");
    }

    public function Join($alias, $table, $link){
        $this->addQuery("JOIN ".$table." ".$alias." ON ".$this->Alias.".".$table." = ".$alias.".".$link." ");
    }

    public function OrderBy($value = "ASC"){
        $this->addQuery("ORDER BY ".$value." ");
    }

    public function prepareQuery(){
        $this->addQuery(";");;
    }

    public function executeQuery(){
        $log = new \core\Log\Log(date('Y-m-d H:i:s'));
        try{
            $sth = $this->getPDO()->prepare($this->getQuery());
            echo $this->getQuery();
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