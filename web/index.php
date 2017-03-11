<?php
require "../Class/autoload.php";
require "../Class/App/Smarty/Smarty.class.php";

use App\App;
use App\General;
use Modules\Modules;

$app = new App();
$app->init();
$app->setSmarty(new Smarty());

$css=[];
if($dir=opendir("./asset/css/modules")) {
    while (($rd=readdir($dir)) !== false) {
        if($rd!="."&&$rd!="..") $css[]=$rd;
    }
}

$js=[];
if($dir=opendir("./js/modules")) {
    while (($rd=readdir($dir)) !== false) {
        if($rd!="."&&$rd!="..") $js[]=$rd;
    }
}

App::$view->assign("allCss",$css);
App::$view->assign("allJs",$js);
if(strpos($_SERVER['SERVER_PROTOCOL'],"HTTPS")) {
    $protocol = "https://";
} else {
    $protocol = "http://";
}
App::$view->assign("server",$protocol.$_SERVER['SERVER_NAME']);
App::$view->display("head.tpl");

$page = $_GET['p'] ?? "index";
$param = $_GET['param'];
$sites = General::config("sites",[]);

$p = explode("/",$param);

if(in_array($page,$sites)) {
    $module = Modules::getModule($page);
    $module->parameters($p);
    $module->execute();
    App::$view->display($page.".tpl");
} else {
    App::$view->display("error/404.tpl");
}

App::$view->display("footer.tpl");