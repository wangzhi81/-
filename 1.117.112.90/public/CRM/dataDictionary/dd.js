function delEntitie(obj){
    var curid = $(obj).parent().parent().attr("id");
    if(confirm("是否要删除该实体信息？")){
        $.post("delEntitie.php",{
            ENTITY_UUID:curid
        },function(data){
            if(data===""){
                location.href = "dd.html?v=3";
            }else{
                alert(data);
            }
        });
    }
}
function editEntitie(obj){
    var curid = $(obj).parent().parent().attr("id");
    location.href = "editEntitie.php?id="+curid;
}
function MaintainProperty(obj){
    var curid = $(obj).parent().parent().attr("id");
    location.href = "MaintainProperty.php?id="+curid;
}
function GenerateCode(obj){
    var curid = $(obj).parent().parent().attr("id");
    location.href = "GenerateCode.php?id="+curid;
}
$(function(){
    var _ths = [];
    _ths.push("实体名称");
    _ths.push("实体代码");
    _ths.push("实体说明");
    _ths.push("修改时间");
    $.post("getEntitiesList.php",{},function(data){
        $("#stb").html(crratTable(_ths,data,'<a href="#" onclick="editEntitie(this)">修改</a><a href="#" onclick="MaintainProperty(this)">维护属性</a><a href="#" onclick="GenerateCode(this)">生成代码</a><a href="#" onclick="delEntitie(this)">删除</a>'));
    },"json");
    hideShadow();
});