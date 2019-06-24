<?php

namespace Astronphp\Handler;

class Main{
        
    public function __construct(){
       
        $lib=(strpos($argv[1],':')!==false?explode(':',$argv[1])[0]:$argv[1]);

        switch ($lib){
            case 'orm': return $this->Orm(); break;
            case 'front': return $this->FrontView(); break;
            default : return "\e[31mCommand not found\e[0m"."\n"; break;
        }
    }

    private function Orm(){
        if(class_exists('\Astronphp\Orm\Handler')){
            return (new \Astronphp\Orm\Handler($argv))->return;
        }else{
            return "\e[31m composer require astronphp/orm \e[0m"."\n";
        }
    }
    
    private function FrontView(){
        if(class_exists('\Astronphp\FrontView\Handler')){
            return  (new \Astronphp\FrontView\Handler($argv))->return;
        }else{
            return  "\e[31m composer require astronphp/frontview \e[0m"."\n";
        }
    }

}