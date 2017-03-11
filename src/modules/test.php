<?php

use App\App;
use Modules\Modules;

class test extends Modules
{
    protected $params=['direction','distance'];

    public function execute()
    {
        App::$view->assign("test","Some test text!");
        App::$view->assign("direction",$this->values['direction']);
        App::$view->assign("distance",$this->values['distance']);
    }
}