<?php

namespace Astronphp\Handler\Connectors;

class Orm
{
    public  $return;
    private $params   = [];
    private $commands = [
                            "orm:create-entity"         =>      'php '.PATH_ROOT.'vendor/astronphp/orm/src/schema/generate.php',
                            "orm:update-db"             =>      PATH_ROOT.'vendor/bin/doctrine orm:schema-tool:update --force'
                        ];
    
    public function __construct($p = [])
    {
        $this->params = $p;
        $this->moveConfigRoot();
        $this->executeShell();
        $this->removeConfigRoot();
        return $this;
    }

    private function moveConfigRoot()
    {
        $sep = DIRECTORY_SEPARATOR;

        copy(PATH_ROOT.'vendor' . $sep . 'astronphp' . $sep . 'orm' . $sep . 'src' . $sep . 'schema' . $sep . 'cli-config.php', PATH_ROOT.'cli-config.php');
    }

    private function executeShell()
    {
        if (in_array($this->params[1],array_flip($this->commands))==true) {
            $this->return = system($this->commands[$this->params[1]]);
        } else {
            $sep = DIRECTORY_SEPARATOR;

            array_shift($this->params);
            $this->return = system('.'. $sep . 'vendor'. $sep . 'bin'. $sep . 'doctrine ' . implode(' ',$this->params));
        }
    }

    private function removeConfigRoot()
    {
        if (file_exists(PATH_ROOT . "cli-config.php")) {
            unlink(PATH_ROOT . "cli-config.php"); 
        }
    }
}
