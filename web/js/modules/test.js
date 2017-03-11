$(document).ready(function () {
    var div = $(".move-me"),
        direction = div.data("direction"),
        distance = div.data("distance");

    if (direction=="left"){
        div.animate({right:distance+"px"},2000);
    }
    if (direction=="up"){
        div.animate({bottom:distance+"px"},2000);
    }
    if (direction=="right"){
        div.animate({left:distance+"px"},2000);
    }
    if (direction=="down"){
        div.animate({top:distance+"px"},2000);
    }
});