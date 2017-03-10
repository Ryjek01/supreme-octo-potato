<?php
require "../Class/autoload.php";
require "../Class/App/Smarty/Smarty.class.php";

use App\App;

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

App::$view->display("head.tpl");

$page = $_GET['p'] ?? "index";
$sites = ["index"];

if(in_array($page,$sites)) {
    App::$view->display($page.".tpl");
} else {
    App::$view->display("error/404.tpl");
}

App::$view->display("footer.tpl");