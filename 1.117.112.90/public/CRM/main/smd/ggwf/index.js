$(function(){
  //菜单自适应高度
  $("#righttd").css("height",$(window).height());
  $("#mainfram").attr("height",$(window).height()-4);
  //滑动菜单
  $("#huadong").css("top",$(window).height()/2);
  $("#huadong").click(function(){
    if($("#huadong .glyphicon").hasClass("glyphicon-chevron-left")){
      $("#righttd div").hide();
      $("#righttd").animate({"width":"0px"});
      $("#huadong").animate({"left":"0px"});
      $("#huadong .glyphicon").removeClass("glyphicon-chevron-left");
      $("#huadong .glyphicon").addClass("glyphicon-chevron-right");
    }else{
      $("#righttd").animate({"width":"180px"});
      $("#huadong").animate({"left":"165px"},function(){
        $("#righttd div").show();
        $("#huadong .glyphicon").removeClass("glyphicon-chevron-right");
        $("#huadong .glyphicon").addClass("glyphicon-chevron-left");
      });
    }
  });
  //选中菜单
  $(".div2").click(function(){
    $(".div2").removeClass("div2selected");
    $(this).addClass("div2selected");
  });
  //应急设备
  $("#qxgl").click(function(){
    $("#mainfram").attr("src","qxgl.php");
  });
  //应急人员
  $("#yhgl").click(function(){
    $("#mainfram").attr("src","yhgl.php");
  });
  $("#rzgl").click(function(){
    $("#mainfram").attr("src","rzgl.php");
  });
  
  hideShadow();
});