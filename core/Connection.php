<?php

namespace core;

class Connection extends \PDO
{
    private static $DBHost ="localhost";
    private static $DBUser ="root";
    private static $DBPass='';
    private static $DBName="myormtest";
    private static $pdo;

    public function __construct(){
        parent::__construct('mysql:host='.self::$DBHost.';dbname='.self::$DBName, self::$DBUser, self::$DBPass, [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ]);
    }

    public static function getConnection() {
        if (!self::$pdo)
            self::$pdo = new self;

        return self::$pdo;
    }

    public static function setDBHost($DBHost){
        self::$DBHost = $DBHost;
    }

    public static function setDBUser($DBUser){
        self::$DBUser = $DBUser;
    }

    public static function setDBPass($DBPass){
        self::$DBPass = $DBPass;
    }

    public static function setDBName($DBName){
        self::$DBName = $DBName;
    }
}
