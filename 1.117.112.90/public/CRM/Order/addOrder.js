$(function(){
    //alert($('.line').parent().parent().parent().html());
    $(".line").css("left",$('.line').parent().offset().left+15);
    $(".line").css("top",$('.line').parent().offset().top);
    $(".line").css("height",$('.line').parent().parent().parent().outerHeight(true));
});