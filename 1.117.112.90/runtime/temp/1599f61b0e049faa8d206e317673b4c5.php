<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:90:"/www/wwwroot/erp.wangzhi81.com/public/../application/index/view/shippingaccount/index.html";i:1552486410;}*/ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="stylesheet" type="text/css" href="/static/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="/static/css/loading.css?v=0.3" />
        <link rel="stylesheet" type="text/css" href="/static/css/businesslist.css" />
        <title>出货管理</title>
    </head>
    
    <body>
        <div style="padding:10px">
            <table width="100%">
                <tr>
                    <td>
                        <a href="/index/erp" id="fanhui">
                            <img src="/static/img/ico/fanhui.png" style="width:10px">
                            返回
                        </a>
                    </td>
                    <td align="right">
                        <table>
                            <tr>
                                <td><button type="button" class="btn btn-primary btn-sm" id="add">出货</button></td>
                                <td style="width:10px"></td>
                                <td><button type="button" class="btn btn-primary btn-sm" id="fanhuo">返货</button></td>
                            </tr>
                        </table>
                        
                    </td>
                </tr>
            </table>
        </div>
        <div style="padding:10px">
            <table width="100%">
                <tr>
                    <td style="width:50px">客户：</td>
                    <td><input class="form-control" id="customer"></td>
                    <td style="width:10px"></td>
                    <td style="width:50px">商品：</td>
                    <td><input class="form-control" id="commodity"></td>
                </tr>
            </table>
        </div>
        <div style="padding:10px">
            <table width="100%">
                <tr>
                    <td align="right">
                        <button type="button" class="btn btn-primary" id="chaxun">查询</button>
                    </td>
                </tr>
            </table>
        </div>
        <table width="100%">
            <tr>
                <td align="right">
                    合计：<span id="zongkuan"></span>
                </td>
            </tr>
        </table>
        <div>
            <table class="table table-bordered">
                <tr>
                    <th>出货时间</th><th>出(返)货信息</th><th>单价</th><th>总价</th><th>详细</th>
                </tr>
                <tbody id="list"></tbody>
            </table>
        </div>
        
        <script type="text/javascript" src="/static/js/jquery.min.js"></script>
        <script type="text/javascript" src="/static/js/jquery.cookie.js"></script>
        <script type="text/javascript">
            
            function chaxun(){
                $.post("/index/Shippingaccount/getShippingAccount",{
                    customer:$("#customer").val().trim(),
                    commodity:$("#commodity").val().trim()
                },function(res){
                    //alert(res);
                    var str = '';
                    $.each(res.ShippingAccounts,function(i,v){
                        str += '<tr>';
                        str += '<td>'+v.shipping_time+'</td>';
                        str += '<td>客户：'+v.full_name+'<br>';
                        str += '商品：'+v.trade_name+'<br>';
                        str += v.shipment_return+'数量：'+v.quantity_shipped+'</td>';
                        str += '<td>'+v.unit_price_+'</td>';
                        str += '<td>'+v.total_price+'</td>';
                        str += '<td><a href="/index/Shippingaccount/detail/id/'+v.SHIPPING_ACCOUNT_ID+'">详细</a></td>';
                        str += '</tr>';
                    });
                    $("#list").html(str);
                    $("#zongkuan").text(res.zongkuan.toFixed(2));
                });
            }
            
            $(document).ready(function(){
                chaxun();
                $("#chaxun").click(function(){
                    chaxun();
                });
                $("#add").click(function(){
                    location.href='/index/Shippingaccount/shipment/ms/ch';
                });
                $("#fanhuo").click(function(){
                    location.href='/index/Shippingaccount/shipment/ms/fh';
                });
            });
        </script>
    </body>
</html>