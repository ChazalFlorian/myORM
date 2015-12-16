<?php
/**
 * Created by PhpStorm.
 * User: ChazalFlorian
 * Date: 09/12/2015
 * Time: 08:44
 */
namespace core;

use core\classAttribute as Attribute;

class classGenerator{

     private $DBHost;
     private $DBUser;
     private $DBPass;
     private $DBName;
     private $DBTableName;
     private $DBClassName;
     protected $Attributes;

     public function __construct($DBHost, $DBUser, $DBPass, $DBName, $DBTableName, $DBClassName){
         $this->DBHost = $DBHost;
         $this->DBUser = $DBUser;
         $this->DBPass = $DBPass;
         $this->DBName = $DBName;
         $this->DBTableName = $DBTableName;
         $this->DBClassName = $DBClassName;
         $this->Attributes = array();
         $this->initNewClass();
     }

     public function initNewClass()
     {
         echo(" Creating new Entity ".$this->DBClassName." on ".$this->DBName."\n");
         echo ("Now we will add attributes to".$this->DBClassName."\n");

         //initialize interactive command prompt
         $stdin = fopen("php://stdin", "r");
         $exit = false;
         while(!$exit)
         {
             echo ("Attribute Name: - ");

             $responseAttribute = fgets($stdin);
             //this line delete 2 unwanted characters at the input's end
             $responseAttribute = substr($responseAttribute, 0, -2);

             if($responseAttribute != "")
             {
                 $attribute = new Attribute($responseAttribute);
                 echo ("Possible values are: text, string, integer, boolean, date. \n");

                 $responseType = fgets($stdin);
                 $responseType = substr($responseType, 0, -2);

                     switch($responseType){

                         case "text":
                             $attribute->setType("text");
                             array_push($this->Attributes, $attribute);
                             break;

                         case "string":
                             $stringExit = false;
                             $attribute->setType("string");

                             echo ("Max character values? (default: 255)\n");

                             while(!$stringExit)
                             {
                                 $responseValue = fgets($stdin);
                                 $responseValue = substr($responseValue, 0, -2);

                                 if($responseValue == "")
                                 {
                                     $attribute->setMaxVal(255);
                                     $stringExit = true;
                                     array_push($this->Attributes, $attribute);
                                 }
                                 elseif(intval($responseValue) !== 0)
                                 {
                                     $attribute->setMaxVal($responseValue);
                                     $stringExit = true;
                                     array_push($this->Attributes, $attribute);
                                 } else
                                 {
                                     echo "Please enter proper integer value \n";
                                 }
                             }
                             break;

                         case "integer":
                             $attribute->setType("integer");
                             array_push($this->Attributes, $attribute);
                             break;

                         case "boolean":
                             $attribute->setType("boolean");
                             array_push($this->Attributes, $attribute);
                             break;

                         case "date":
                             $attribute->setType("date");
                             array_push($this->Attributes, $attribute);
                             break;

                         default:
                             echo ("Please enter a acceptable Type \n");
                     }
                 }
             else
             {
                 echo "End of new Attributes \n";
                 $exit = true;
             }
         }
         $this->generate();
     }

     public function generate(){
         echo "Now generating Class".$this->DBClassName." in entity/".$this->DBClassName.".php";

         //First, initiate basic with an automatic Id value
         $classContent= "<?php\n\n";
         $classContent.="namespace entity;\n\n";
         $classContent.= "class ".$this->DBClassName." {\n\n";
         $classContent.= "\t/**\n";
         $classContent.= "\t*Var: Id\n";
         $classContent.= "\t*Type: Integer\n";
         $classContent.= "\t*Primary: True\n";
         $classContent.= "\t*Auto: True\n";
         $classContent.= "\t**/\n";
         $classContent.= "\t private \$id;\n";


         //Then, add attributes determined by the User
         foreach($this->Attributes as $currentAttribute){
             $classContent.= "\t/**\n";
             $classContent.= "\t*Var: ".$currentAttribute->getName()."\n";
             $classContent.= "\t*Type: ".$currentAttribute->getType()."\n";
             if($currentAttribute->getMaxVal()){$classContent.="\t*MaxLength: ".$currentAttribute->getMaxVal()."\n";}
             $classContent.= "\t**/\n";
             $classContent.= "\t private $".$currentAttribute->getName().";\n\n";
         }
         $classContent.="\n";

         //add setter/getter for ID attribute
         $classContent.= "\t public function setId(\$id)\n";
         $classContent.= "\t{\n";
         $classContent.="\t\t\$this->id = \$id;\n";
         $classContent.= "\t}\n\n";
         $classContent.= "\t public function getId()\n";
         $classContent.= "\t{\n";
         $classContent.="\t\treturn \$this->id;\n";
         $classContent.= "\t}\n\n";

         //Then add getter/setter method for all
         //Its a bit redundant, but the created class is more easily understandable this way
         foreach($this->Attributes as $currentAttribute){
             $classContent .= "\t public function set".ucfirst(strtolower($currentAttribute->getName()))."($".$currentAttribute->getName().")\n";
             $classContent .= "\t{\n";
             $classContent .="\t\t\$this->".$currentAttribute->getName()." = $".$currentAttribute->getName().";\n";
             $classContent .= "\t}\n\n";
             $classContent .= "\tpublic function get".ucfirst(strtolower($currentAttribute->getName()))."()\n";
             $classContent .= "\t{\n";
             $classContent .= "\t\t return \$this->".$currentAttribute->getName().";\n";
             $classContent .= "\t}\n\n";
         }

         $classContent.="}";
         file_put_contents("./entity/".$this->DBClassName.".php", $classContent);
     }

    
}