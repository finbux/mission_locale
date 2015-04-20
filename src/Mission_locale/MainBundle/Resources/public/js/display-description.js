$(function(){
    $(".item, hr").mouseover(function(){
        $(".item_right").fadeIn();
        $("#first-right").hide();
    });
    $(".item_right").mouseleave(function(){
    $(".item_right").hide();
    $("#first-right").fadeIn();
    });

});
