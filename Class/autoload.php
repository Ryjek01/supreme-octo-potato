<?php
class myAutoloader
{
    public static function autoload($class)
    {
        $class = str_replace('\\', '/', $class);
        include_once "$class.class.php";

    }
}

spl_autoload_register(['myAutoloader', 'autoload']);