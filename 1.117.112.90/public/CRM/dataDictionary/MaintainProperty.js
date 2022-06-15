//重新编号
function bianhao(){
    var xuhao = 1;
    $(".SerialNumber").each(function(){
        $(this).text(xuhao);
        xuhao++;
    });
}
//被删除字段公共变量
var delATTRIBUTE_UUIDs = [];
//删除
function shanchu(obj){
    var shuxing = $(obj).parent().parent().find(".FIELD_NAME").val();
    var ATTRIBUTE_UUID = $(obj).parent().parent().attr("ATTRIBUTE_UUID");
    if(confirm("是否要删除该属性信息["+shuxing+"]？")){
        delATTRIBUTE_UUIDs.push(ATTRIBUTE_UUID);
        $(obj).parent().parent().remove();
    }
}
//删除，不记录，因为没有存储
function shanchu_(obj){
    var shuxing = $(obj).parent().parent().find(".FIELD_NAME").val();
    var ATTRIBUTE_UUID = $(obj).parent().parent().attr("ATTRIBUTE_UUID");
    if(confirm("是否要删除该属性信息["+shuxing+"]？")){
        $(obj).parent().parent().remove();
    }
}
//向上移动
function xiangshang(obj){
    var cur = $(obj).parent().parent();
    var prev = $(obj).parent().parent().prev();
    if($("#ProTBody").find("tr").index(cur)===0){return false;}
    cur.insertBefore(prev);
    bianhao();
}
//向下移动
function xiangxia(obj){
    var cur = $(obj).parent().parent();
    var next = $(obj).parent().parent().next();
    var length = $("#ProTBody").find("tr").length;
    if($("#ProTBody").find("tr").index(cur)===length){return false;}
    next.insertBefore(cur);
    bianhao();
}
//翻译
function fanyi(obj){
    var val = $(obj).val();
    $.getJSON("../control/baidu_transapi.php", 
        {src:val},
        function(json){
            $(obj).parent().next().text(json.trans_result[0].dst.replace(/ /gm,"_").toLowerCase());
    });
}
$(function(){
  var clip = new ZeroClipboard($("#ENTITY_CODE"));
  var clip3 = new ZeroClipboard($("#ENTITY_ID"));
  var clip4 = new ZeroClipboard($("#ObjectCode"));
  var clip2 = new ZeroClipboard($(".FIELD_CODE"));
  $("#fanhui").click(function(){
    location.href="dd.html?v=3";
  });
  
  $("#stmc").blur(function(){
        var val = $("#stmc").val();
        $.getJSON("../control/baidu_transapi.php", 
            {src:val},
            function(json){
                $("#stdm").text(json.trans_result[0].dst.replace(/ /gm,"_").toUpperCase());
        });
    });
  //添加属性  
  $("#addProperty").click(function(){
    var xuhao = $("#ProTBody tr").length+1;
    $("#ProTBody").append('<tr class="addProperty"><td style="vertical-align:middle" class="SerialNumber">'+xuhao+'</td><td><input class="form-control FIELD_NAME" type="text" onblur="fanyi(this)"></td><td style="vertical-align:middle" class="FIELD_CODE"></td><td><select class="form-control DATA_TYPE"><option value="varchar(50)">varchar(50)</option><option value="varchar(500)">varchar(500)</option><option value="decimal(10,2)">decimal(10,2)</option><option value="int(11)">int(11)</option><option value="datetime">datetime</option><option value="text">text</option></select></td><td><input class="form-control DEFAULT_VALUE_" type="text"></td><td><input class="form-control NOTES" type="text"></td><td style="vertical-align:middle"><span class="glyphicon glyphicon-arrow-up" onclick="xiangshang(this)"></span><span class="glyphicon glyphicon-arrow-down" onclick="xiangxia(this)"></span><span class="glyphicon glyphicon-remove" onclick="shanchu_(this)"></span></td></tr>');
  });
  if($("#ProTBody tr").length===0){
      $("#addProperty").click();
  }
  $("#savePro").click(function(){
      showShadow();
      var addPropertys = [];
      $(".addProperty").each(function(){
          var Property = {};
          Property.FIELD_NAME = $(this).find(".FIELD_NAME").val(); 
          Property.FIELD_CODE = $(this).find(".FIELD_CODE").text(); 
          Property.ENTITY_UUID = $("#ENTITY_UUID").val(); 
          Property.SerialNumber = $(this).find(".SerialNumber").text(); 
          Property.DATA_TYPE = $(this).find(".DATA_TYPE").val();
          Property.DEFAULT_VALUE_ = $(this).find(".DEFAULT_VALUE_").val(); 
          Property.NOTES = $(this).find(".NOTES").val(); 
          addPropertys.push(Property);
      });
      var Propertys = [];
      $(".Property").each(function(){
          var Property = {};
          Property.ATTRIBUTE_UUID = $(this).attr('ATTRIBUTE_UUID');
          Property.oldFIELD_CODE = $(this).attr('FIELD_CODE');
          Property.FIELD_NAME = $(this).find(".FIELD_NAME").val(); 
          Property.FIELD_CODE = $(this).find(".FIELD_CODE").text(); 
          Property.ENTITY_UUID = $("#ENTITY_UUID").val(); 
          Property.SerialNumber = $(this).find(".SerialNumber").text(); 
          Property.DATA_TYPE = $(this).find(".DATA_TYPE").val();
          Property.DEFAULT_VALUE_ = $(this).find(".DEFAULT_VALUE_").val(); 
          Property.NOTES = $(this).find(".NOTES").val(); 
          Propertys.push(Property);
      });
      //alert(delATTRIBUTE_UUIDs);
      $.post("savePro.php",{
          addPropertys:addPropertys,
          Propertys:Propertys,
          delATTRIBUTE_UUIDs:delATTRIBUTE_UUIDs,
          ENTITY_UUID:$("#ENTITY_UUID").val()
      },function(data){
          if(data===""){
              location.href = "dd.html?v=2";
          }else{
              alert(data);
          }
      });
  });
  hideShadow();
});s