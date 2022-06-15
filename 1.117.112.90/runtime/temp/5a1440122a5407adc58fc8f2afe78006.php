<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:75:"/www/wwwroot/39.99.164.250/public/../application/music/view/shop/adddz.html";i:1598092633;}*/ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="stylesheet" type="text/css" href="/static/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="/static/css/loading.css?v=0.3" />
        <link rel="stylesheet" type="text/css" href="/static/js/swiper-5.4.5/swiper-5.4.5/package/css/swiper.min.css" />
        <style>
        </style>
        <title>音乐之声</title>
    </head>
    
    <body>
        <div style="background-color:#f2f3f7;padding:10px"><img src="/static/img/ico/fanhui.png" style="height:20px" id="fanhui"></div>
        <table width="100%">
            <tr>
                <td style="width:10px"></td>
                <td style="padding:10px;width:100px;border-bottom-width: 1px;border-bottom-style: solid;border-color:#cdcdcd">收件人</td>
                <td style="border-bottom-width: 1px;border-bottom-style: solid;border-color:#cdcdcd"><input style="width:100%;border-width:0px" placeholder="收件人姓名" id="addressee"></td>
            </tr>
            <tr>
                <td style="width:10px"></td>
                <td style="padding:10px;width:100px;border-bottom-width: 1px;border-bottom-style: solid;border-color:#cdcdcd">联系电话</td>
                <td style="border-bottom-width: 1px;border-bottom-style: solid;border-color:#cdcdcd"><input style="width:100%;border-width:0px" placeholder="联系电话" id="contact_number"></td>
            </tr>
            <tr>
                <td style="width:10px"></td>
                <td style="padding:10px;width:100px;border-bottom-width: 1px;border-bottom-style: solid;border-color:#cdcdcd">所在地区</td>
                <td style="border-bottom-width: 1px;border-bottom-style: solid;border-color:#cdcdcd"><input style="width:100%;border-width:0px" placeholder="精确到区县" id="location"></td>
            </tr>
            <tr>
                <td style="width:10px"></td>
                <td style="padding:10px;width:100px;border-bottom-width: 1px;border-bottom-style: solid;border-color:#cdcdcd">详细地址</td>
                <td style="border-bottom-width: 1px;border-bottom-style: solid;border-color:#cdcdcd"><input style="width:100%;border-width:0px" placeholder="精确到街道、小区、门牌号" id="detailed_address"></td>
            </tr>
        </table>
        <div style="position:absolute;left:0px;height:50px;background-color:#EF7C38;padding:5px;text-align:center" id="dibu">
              <div style="color:#fff;margin-top:10px">保存地址</div>
          </div>
          <script src="/static/js/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                $("#dibu").click(function(){
                    if($("#addressee").val().trim()===""){
                        alert("请输入收件人姓名！");
                        return false;
                    }
                    if($("#contact_number").val().trim()===""){
                        alert("请输入联系电话！");
                        return false;
                    }
                    if($("#location").val().trim()===""){
                        alert("请输入所在地区！");
                        return false;
                    }
                    if($("#detailed_address").val().trim()===""){
                        alert("请输入详细地址！");
                        return false;
                    }
                    $.post("/music/shop/savedz",{
                        addressee:$("#addressee").val().trim(),
                        contact_number:$("#contact_number").val().trim(),
                        location:$("#location").val().trim(),
                        detailed_address:$("#detailed_address").val().trim()
                    },function(res){
                        if(res==='ok'){
                            location.href = "/music/shop/dzbj/id/<?php echo $COMMODITY_INFORMATION_ID; ?>";
                        }
                    });
                });
                var wh = $(window).height();
                var ww = $(window).width();
                $("#dibu").css("width",ww);
                $("#dibu").css("top",wh-50);
                $("#fanhui").click(function(){
                    location.href = "/music/shop/dzbj/id/<?php echo $COMMODITY_INFORMATION_ID; ?>";
                });
            });
        </script>
    </body>
</html>
