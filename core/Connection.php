<?php

namespace core;

class Connection extends \PDO
{
    private static $pdo;

    public function __construct(){
        parent::__construct('mysql:host=localhost;dbname=myormtest', 'root', '', [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ]);
    }

    public static function getConnection() {
        if (!self::$pdo)
            self::$pdo = new self;

        return self::$pdo;
    }
}
