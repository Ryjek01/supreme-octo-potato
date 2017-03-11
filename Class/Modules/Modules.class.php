<?php
namespace Modules;

abstract class Modules
{
    /**
     * @var array
     */
    protected $params=[];
    /**
     * @var array
     */
    protected $values=[];
    /**
     * @param $module
     * @return Modules
     */
    public static function getModule($module)
    {
        if(file_exists("../src/modules/$module.php")) {
            include_once  "../src/modules/$module.php";
            return new $module;
        } else {
            return false;
        }
    }

    public abstract function execute();

    /**
     * @param $param
     */
    public function parameters($param)
    {
        for ($i=0;$i<count($this->params);$i++) {
            $this->values[$this->params[$i]] = $param[$i];
        }
    }
}