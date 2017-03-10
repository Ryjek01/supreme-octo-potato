<?php
namespace App;

class General extends App
{
    public static function config(string $config, array $params)
    {
        return self::getConfig($config,$params);
    }
}