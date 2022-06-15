$(function(){
    $("#righttd").load('homeright.html');
    if($("#openid").val()===""){
        //window.top.location.href = "../index.php";
    }
    $(window.parent.document).find("#username").text($("#username").val());
});