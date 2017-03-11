<?php
use Modules\Modules;

class index extends Modules
{
    protected $params=["p","q"];

    public function execute()
    {
        var_dump($this->values);
    }
}