<?php
/**
 * Created by PhpStorm.
 * User: ChazalFlorian
 * Date: 09/12/2015
 * Time: 08:44
 */
namespace core;

class classGenerator{

     private $DBHost;
     private $DBUser;
     private $DBPass;
     private $DBName;
     private $DBTableName;
     private $DBClassName;

     public function __construct($DBHost, $DBUser, $DBPass, $DBName, $DBTableName, $DBClassName){
         $this->DBHost = $DBHost;
         $this->DBUser = $DBUser;
         $this->DBPass = $DBPass;
         $this->DBName = $DBName;
         $this->DBTableName = $DBTableName;
         $this->DBClassName = $DBClassName;
         $this->initNewClass();
     }

     //public function __contruct($DBHost, $DBUser, $DBPass, $DBName, $DBClass){
     //   $this->DBHost = $DBHost;
     //    $this->DBUser = $DBUser;
     //    $this->DBPass = $DBPass;
     //    $this->DBName = $DBName;
     //    $this->DBTableName = $DBClass;
     //    $this->DBClassName = $DBClass;
     //}

     public function initNewClass(){
        echo(" Creating new Entity".$this->DBClassName." on ".$this->DBName);
     }

     public function addArgument($Argument = ""){
        $newArgument = "test";
         if($Argument !== ""){
             $this->addArgument($newArgument);
         }
     }
    
}