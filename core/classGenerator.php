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
        echo(" Creating new Entity ".$this->DBClassName." on ".$this->DBName."\n");
         echo ("Testing Interactive Console \n");

         //initialize interactive command prompt
         $stdin = fopen("php://stdin", "r");
         $exit = false;
         while(!$exit)
         {
             echo ("Does this simple test works? (yes/no) - ");
             $response = fgets($stdin);
             //this line delete 2 characters at the input's end
             $response = substr($response, 0, -2);
             if($response == "yes")
             {
                 echo "response was Yes";
                 $exit = true;
             }elseif($response == "no")
             {
                 echo "response was No";
             }
             else
             {
                 echo "Wrong Statement";
             }
         }
     }

     public function addArgument($Argument = ""){
        $newArgument = "test";
         if($Argument !== ""){
             $this->addArgument($newArgument);
         }
     }
    
}