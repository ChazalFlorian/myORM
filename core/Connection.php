<?php

namespace core;

class Connection extends \PDO
{
    private $DBHost;
    private $DBUser;
    private $DBPass;
    private $DBName;
    private static $pdo;

    public function __construct(){
        parent::__construct('mysql:host='.$this->DBHost.';dbname='.$this->DBName, $this->DBUser, $this->DBPass, [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ]);
    }

    public static function getConnection() {
        if (!self::$pdo)
            self::$pdo = new self;

        return self::$pdo;
    }

    public function setDBHost($DBHost){
        $this->DBHost = $DBHost;
    }

    public function setDBUser($DBUser){
        $this->DBUser = $DBUser;
    }

    public function setDBPass($DBPass){
        $this->DBPass = $DBPass;
    }

    public function setDBName($DBName){
        $this->DBName = $DBName;
    }
}
