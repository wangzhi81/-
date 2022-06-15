$(function(){
    $("#fanhui").click(function(){
        location.href = "dd.html?v=3";
    });
    $("#stmc").blur(function(){
        var val = $("#stmc").val();
        $.getJSON("../control/baidu_transapi.php", 
            {src:val},
            function(json){
                $("#stdm").text(json.trans_result[0].dst.replace(/ /gm,"_").toUpperCase());
        });
    });
    $.post("getEntitie.php",{
        ENTITY_UUID:$("#ENTITY_UUID").val()
    },function(data){
        $("#stmc").text(data[0]["ENTITY_NAME"]);
        $("#stdm").text(data[0]["ENTITY_CODE"]);
        $("#stsm").val(data[0]["ENTITY_DESCRIPTION"]);
    },"json");
    $("#baocun").click(function(){
        $.post("updateEntitie.php",{
            ENTITY_UUID:$("#ENTITY_UUID").val(),
            ENTITY_NAME:$("#stmc").text(),
            ENTITY_CODE:$("#stdm").text(),
            ENTITY_DESCRIPTION:$("#stsm").val()
        },function(data){
            if(data===""){
                location.href = "dd.html?v=3";
            }else{
                alert(data);
            }
        });
    });
});