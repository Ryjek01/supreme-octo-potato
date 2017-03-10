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
        $smarty->setConfigDir("../configs");

        self::$view=$smarty;
    }
}