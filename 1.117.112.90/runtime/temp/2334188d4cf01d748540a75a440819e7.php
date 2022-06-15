<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:75:"/www/wwwroot/39.99.164.250/public/../application/music/view/shop/index.html";i:1598869620;}*/ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="stylesheet" type="text/css" href="/static/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="/static/css/loading.css?v=0.3" />
        <link rel="stylesheet" type="text/css" href="/static/css/businesslist.css" />
        <title></title>
    </head>
    
    <body>
        <div style="background-color:#f2f3f7;padding:10px">
            <table width="100%">
                <tr>
                    <td><img src="/static/img/ico/fanhui.png" style="height:20px" id="fanhui"></td>
                    <td align="right"><a href="/music/shop/wddd" id="wddd">我的订单</a></td>
                </tr>
            </table>
        </div>
        <div style="padding:10px">
            <table width="100%">
                <tr>
                    <td><input type="text" class="form-control" id="cxtj" placeholder="查询全部商品" value=""></td>
                    <td style="width:50px" align="center"><a href="#" id="chaxun">查询</a></td>
                </tr>
            </table>
        </div>
        <table width="100%" id="sptable">
            <tr style="border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color:#cdcdcd">
                <td style="width:30%;padding:5px" valign="top">
                    <img src="/static/img/gzh.jpg" class="img-responsive">
                </td>
                <td style="padding:5px" valign="top">
                    <div style="height:40px;margin-top:5px">XXXX声乐光盘</div>
                    <div>
                        <table width="100%">
                            <tr>
                                <td>
                                    <span style="color:#EF7C38;">￥<span style="font-size:20px">199.00</span></span>
                                    <span style="text-decoration:line-through;color:#cdcdcd">￥299.00</span>
                                </td>
                                <td align="right">
                                    <span style="color:#cdcdcd">300人已购买</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
        <script src="/static/js/jquery.min.js"></script>
        <script>
            function chaxun(){
                $.post("/music/shop/getsps",{
                    cxtj:$("#cxtj").val()
                },function(res){
                    var html = "";
                    $.each(res,function(i,v){
                        html+='<tr style="border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color:#cdcdcd" class="spitme" COMMODITY_INFORMATION_ID="'+v.COMMODITY_INFORMATION_ID+'">                <td style="width:30%;padding:5px" valign="top">                    <img src="'+v.product_picture+'" class="img-responsive">                </td>                <td style="padding:5px" valign="top">                    <div style="height:40px;margin-top:5px">'+v.trade_name+'</div>                    <div>                        <table width="100%">                            <tr>                                <td>                                    <span style="color:#EF7C38;">￥<span style="font-size:20px">'+v.commodity_price+'</span></span>                                    <span style="text-decoration:line-through;color:#cdcdcd">￥'+v.original_price_of_goods+'</span>                                </td>                                <td align="right">                                    <span style="color:#cdcdcd">'+v.number_of_purchased+'人已购买</span>                                </td>                            </tr>                        </table>                    </div>                </td>            </tr>';
                    });
                    $("#sptable").html(html);
                    $(".spitme").click(function(){
                        location.href = "/music/shop/spye/id/"+$(this).attr("COMMODITY_INFORMATION_ID");
                    });
                });
            }
            $(document).ready(function() {
                $("#fanhui").click(function(){
                    location.href = "/music";
                });
                chaxun();
                $("#chaxun").click(function(){
                    chaxun();
                });
            });
        </script>
    </body>
</html>
