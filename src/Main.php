<?php

namespace Astronphp\Handler;

class Main{
    private $argv;
    public $return;

    public function __construct($argv=array()){
        $this->argv = $argv;
       
        $lib=(strpos($this->argv[1],':')!==false?explode(':',$this->argv[1])[0]:$this->argv[1]);

        switch ($lib){
            case 'orm': $this->return = $this->Orm(); break;
            case 'front': $this->return = $this->FrontView(); break;
            default : $this->return = "\e[31mCommand not found\e[0m"."\n"; break;
        }

        return $this->return;
    }

    private function Orm(){
        if(class_exists('\Astronphp\Orm\Handler')){
            $this->return = (new \Astronphp\Orm\Handler($this->argv))->return;
        }else{
            return "\e[31m composer require astronphp/orm \e[0m"."\n";
        }
    }
    
    private function FrontView(){
        if(class_exists('\Astronphp\FrontView\Handler')){
            $this->return =  (new \Astronphp\FrontView\Handler($this->argv))->return;
        }else{
            $this->return =  "\e[31m composer require astronphp/frontview \e[0m"."\n";
        }
    }

}