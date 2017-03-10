<?php
/**
 * User: Ryjek01
 * Date: 10.03.17
 * Time: 19:30
 */
namespace App;

class App
{
    /**
     * @var Database
     */
    public static $db;

    /**
     * @var \Smarty
     */
    public static $view;

    public function init()
    {
        self::$db = new Database();
    }

    public function setSmarty(\Smarty $smarty)
    {
        $smarty->setTemplateDir("template");
        $smarty->setCompileDir("../var/templates_c");
        $smarty->setCacheDir("../var/cache");
        $smarty->setConfigDir("../Config");

        self::$view=$smarty;
    }

    protected function getConfig(string $config,array $out)
    {
        $file = file_exists("../Config/$config");
        if($file) {
            $f = file("../Config/$config");
            $return=[];
            foreach ($f as $line) {
                if($line[0]==="#") continue;
                $values = explode(":",$line);
                $r=[];
                for ($i=0;$i<count($values);$i++){
                    $r[$out[$i]] = $values[$i];
                }
                $return[] = $r;
            }
            return (count($return)>1) ? $return : $return[0];
        } else {
            return false;
        }
    }
}