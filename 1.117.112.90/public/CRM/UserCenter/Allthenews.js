function delEntitie(obj){
    var curid = $(obj).parent().parent().attr("id");
    if(confirm("是否要删除该实体信息？")){
        $.post("delEntitie.php",{
            ENTITY_UUID:curid
        },function(data){
            if(data===""){
                location.href = "dd.html";
            }else{
                alert(data);
            }
        });
    }
}

var _ths = [{"f":"NOTIFICATION_TIME","n":"通知时间"},{"f":"MESSAGE_CONTENT","n":"消息内容"},{"f":"WHETHER_READ","n":"是否已读"}];
var _oper = [{"onclick":"Setasread","text":"设为已读"}];
var _data = {pageSize:50,pageNow:1};
var _url = "getNOTIFICATION_MESSAGEs.php";

function Setasread(obj){
    $.post("Setasread.php",{
        NOTIFICATION_MESSAGE_ID:$(obj).parent().parent().attr("id")
    },function(data){
        if(data!==""){
            alert(data);
        }else{
            location.reload();
        }
    });
}

function _Query(){
    $.post(_url,_data,function(data){
        $("#stb").html(getTable(_ths,data,_oper));
    },"json");
    hideShadow();
}

function Previouspage(){
    if(_data.pageNow>1){
        _data.pageNow--;
    }
    _Query();
}

function Nextpage(){
    _data.pageNow++;
    _Query();
}

$(function(){
    _Query();
});