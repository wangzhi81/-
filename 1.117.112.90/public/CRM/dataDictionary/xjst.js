$(function(){
    $("#fanhui").click(function(){
        location.href = "dd.html?v=3";
    });
    $("#stmc").blur(function(){
        var val = $("#stmc").val();
        $.getJSON("../control/baidu_transapi.php", 
            {src:val},
            function(json){
                $("#stdm").text($("#stlx").val()+json.trans_result[0].dst.replace(/ /gm,"_").toUpperCase());
        });
    });
    $("#baocun").click(function(){
        if($("#stdm").text()===""){
            alert("实体代码为空");
            return false;
        }
        $.post("bcst.php",{
            stmc:$("#stmc").val(),
            stdm:$("#stdm").text(),
            stsm:$("#stsm").val()
        },function(data){
            if(data===""){
                location.href="dd.html?v=3";
            }
        });
    });
});