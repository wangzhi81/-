<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:74:"/www/wwwroot/39.99.164.250/public/../application/music/view/shop/wddd.html";i:1598869590;}*/ ?>
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
        <div style="background-color:#f2f3f7;padding:10px"><img src="/static/img/ico/fanhui.png" style="height:20px" id="fanhui"></div>
        <div style="padding:10px">
            <table width="100%">
                <tr>
                    <td><input type="text" class="form-control" id="cxtj" placeholder="查询全部订单"></td>
                    <td style="width:50px" align="center"><a href="#" id="chaxun">查询</a></td>
                </tr>
            </table>
        </div>
        <div style="height:10px"></div>
        <table width="100%" id="kclb">
            
        </table>
        <script src="/static/js/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                $("#fanhui").click(function(){
                    location.href = "/music/shop";
                });
                chaxun();
                $("#chaxun").click(function(){
                    chaxun();
                });
            });
            function chaxun(){
                //if($("#cxtj").val().trim()!=''){
                    $.post("/music/shop/ddcx",{
                        cxtj:$("#cxtj").val()
                    },function(res){
                        var html = "";
                        $.each(res,function(i,v){
                            html+='<tr class="kclbclass" PURCHASE_RECORDS_ID="'+v.PURCHASE_RECORDS_ID+'"><td style="width:40%;padding:10px" valign="top"><img src="'+v.product_picture+'" class="img-responsive img-rounded"></td><td style="padding:10px" valign="top"><div style="height:30px">'+v.trade_name+'</div><div style="height:10px"></div><div style="font-size:20px;color:#EF7C38">￥'+v.commodity_amount+'</div><table width="100%"><tr><td style="width:60px"><span style="color:#aaa">状态：</span></td><td>'+v.delivery_or_not+'</td></tr><tr><td><span style="color:#aaa">收件人：</span></td><td>'+v.addressee+v.contact_number+'</td></tr><tr><td><span style="color:#aaa">地址：</span></td><td>'+v.shipping_address+'</td></tr></table></td></tr>';
                        });
                        $("#kclb").html(html);
                        $(".kclbclass").click(function(){
                            var PURCHASE_RECORDS_ID = $(this).attr("PURCHASE_RECORDS_ID");
                            location.href = "/music/shop/ddxq/id/"+PURCHASE_RECORDS_ID;
                        });
                    });
                //}
            }
        </script>
    </body>
</html>
