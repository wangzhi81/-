<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:74:"/www/wwwroot/39.99.164.250/public/../application/music/view/shop/dzbj.html";i:1598092486;}*/ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="stylesheet" type="text/css" href="/static/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="/static/css/loading.css?v=0.3" />
        <link rel="stylesheet" type="text/css" href="/static/css/businesslist.css" />
        <link rel="stylesheet" type="text/css" href="/static/js/swiper-5.4.5/swiper-5.4.5/package/css/swiper.min.css" />
        <title>音乐之声</title>
    </head>
    
    <body style="background-color:#f2f3f7">
        <div style="background-color:#f2f3f7;padding:10px"><img src="/static/img/ico/fanhui.png" style="height:20px" id="fanhui"></div>
        <div id="dzlb">
            <div style="padding:10px;margin:10px;background-color:#fff">
                <div><span>王智</span><span style="margin-left:10px">13889833613</span></div>
                <div style="height:10px"></div>
                <div>沈阳市沈河区万柳塘路42-2</div>
                <div style="height:10px;border-bottom-width: 1px;border-bottom-style: solid;border-color:#cdcdcd"></div>
                <div style="height:10px"></div>
                <table width="100%">
                    <tr>
                        <td style="width:30px"><img src="/static/img/ico/xuanzhong.png" style="width:20px;display:none"></td>
                        <td style="color:#EF7C38"><span style="display:none">默认地址</span></td>
                        <td></td>
                        <td style="width:30px" class="bianji"><img src="/static/img/ico/bianji.png" style="width:20px"></td>
                        <td style="color:#cdcdcd;width:60px" class="bianji">编辑</td>
                        <td style="width:30px" class="shanchu"><img src="/static/img/ico/shanchu.png" style="width:20px"></td>
                        <td style="color:#cdcdcd;width:60px" class="shanchu">删除</td>
                    </tr>
                </table>
            </div>
        </div>
        
            <div style="position:absolute;left:0px;height:50px;background-color:#EF7C38;padding:5px;text-align:center" id="dibu">
              <div style="color:#fff;margin-top:10px">+新增收货地址</div>
          </div>
        
        <script src="/static/js/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                $.post("/music/shop/getdzs",{},function(res){
                    var html = "";
                    $.each(res,function(i,v){
                        html+='<div style="padding:10px;margin:10px;background-color:#fff">            <div class="dzk" SHIPPING_ADDRESS_ID="'+v.SHIPPING_ADDRESS_ID+'"><span>'+v.addressee+'</span><span style="margin-left:10px">'+v.contact_number+'</span></div>            <div style="height:10px"></div>            <div class="dzk" SHIPPING_ADDRESS_ID="'+v.SHIPPING_ADDRESS_ID+'">'+v.location+v.detailed_address+'</div>            <div style="height:10px;border-bottom-width: 1px;border-bottom-style: solid;border-color:#cdcdcd"></div>            <div style="height:10px"></div>            <table width="100%">                <tr>                    <td style="width:30px"><img src="/static/img/ico/xuanzhong.png" style="width:20px;display:none"></td>                    <td style="color:#EF7C38"><span style="display:none">默认地址</span></td>                    <td></td>                    <td style="width:30px" class="bianji" SHIPPING_ADDRESS_ID="'+v.SHIPPING_ADDRESS_ID+'"><img src="/static/img/ico/bianji.png" style="width:20px"></td>                    <td style="color:#cdcdcd;width:60px" class="bianji" SHIPPING_ADDRESS_ID="'+v.SHIPPING_ADDRESS_ID+'">编辑</td>                    <td style="width:30px" class="shanchu" SHIPPING_ADDRESS_ID="'+v.SHIPPING_ADDRESS_ID+'"><img src="/static/img/ico/shanchu.png" style="width:20px"></td>                    <td style="color:#cdcdcd;width:60px" class="shanchu" SHIPPING_ADDRESS_ID="'+v.SHIPPING_ADDRESS_ID+'">删除</td>                </tr>            </table>        </div>';
                    });
                    $("#dzlb").html(html);
                    $(".shanchu").click(function(){
                        var SHIPPING_ADDRESS_ID = $(this).attr("SHIPPING_ADDRESS_ID");
                        if(confirm("确定删除吗？")){
                            $.post("/music/shop/scdz",{
                                SHIPPING_ADDRESS_ID:SHIPPING_ADDRESS_ID
                            },function(res){
                                if(res==='ok'){
                                    location.href = "/music/shop/dzbj";
                                }
                            });
                        }
                    });
                    $(".bianji").click(function(){
                        var SHIPPING_ADDRESS_ID = $(this).attr("SHIPPING_ADDRESS_ID");
                        location.href = "/music/shop/bjdz/id/"+SHIPPING_ADDRESS_ID+"/COMMODITY_INFORMATION_ID/<?php echo $COMMODITY_INFORMATION_ID; ?>";
                    });
                    $(".dzk").click(function(){
                        var SHIPPING_ADDRESS_ID = $(this).attr("SHIPPING_ADDRESS_ID");
                        location.href = "/music/shop/goumai/id/<?php echo $COMMODITY_INFORMATION_ID; ?>/SHIPPING_ADDRESS_ID/"+SHIPPING_ADDRESS_ID;
                    });
                });
                var wh = $(window).height();
                var ww = $(window).width();
                $("#dibu").css("width",ww);
                $("#dibu").css("top",wh-50);
                $("#fanhui").click(function(){
                    location.href = "/music/shop";
                });
                $("#dibu").click(function(){
                    location.href = "/music/shop/adddz/COMMODITY_INFORMATION_ID/<?php echo $COMMODITY_INFORMATION_ID; ?>";
                });
                
            });
        </script>
    </body>
</html>
