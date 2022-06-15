<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:74:"/www/wwwroot/39.99.164.250/public/../application/music/view/shop/ddxq.html";i:1598869458;}*/ ?>
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
        <img src="/static/img/jycg.png" class="img-responsive">
        <div style="height:10px"></div>
        <table width="100%">
            <tr>
                <td style="width:10px"></td>
                <td style="width:50px;padding:10px">
                    <img src="/static/img/ico/huoche.png" class="img-circle" style="width:40px;background-color:#5b9bd5;padding:5px">
                </td>
                <td>
                    <div><?php echo $purchase_records['delivery_or_not']; ?></div>
                    <div style="font-size:12px;color:#cdcdcd"><?php echo $purchase_records['delivery_time']; ?></div>
                    <div style="font-size:12px;color:#cdcdcd"><?php echo $purchase_records['logistics_name']; ?><?php echo $purchase_records['logistics_order_no']; ?></div>
                </td>
            </tr>
            <tr>
                <td style="width:10px"></td>
                <td style="width:50px;padding:10px">
                    <img src="/static/img/ico/dizhi.png" class="img-circle" style="width:40px;background-color:rgb(237, 125, 49);padding:10px">
                </td>
                <td>
                    <div><span><?php echo $purchase_records['addressee']; ?></span><span><?php echo $purchase_records['contact_number']; ?></span></div>
                    <div><?php echo $purchase_records['shipping_address']; ?></div>
                </td>
            </tr>
        </table>
        <div style="height:10px"></div>
        <div style="height:20px;background-color:#eee"></div>
        <table>
            <tr>
                <td style="width:10px"></td>
                <td style="padding:10px"><img src="/static/img/ico/kecheng.png" style="width:30px"></td>
                <td>商品信息</td>
            </tr>
        </table>
        <table width="100%">
            <tr>
                <td style="width:10px"></td>
                <td style="width:150px;padding:10px" valign="top">
                    <img src="<?php echo $purchase_records['product_picture']; ?>" class="img-responsive" >
                </td>
                <td style="padding:10px" valign="top">
                    <table width="100%">
                        <tr>
                            <td><?php echo $purchase_records['trade_name']; ?></td>
                            <td align="right" style="font-size:16px">￥<?php echo $purchase_records['commodity_amount']; ?></td>
                        </tr>
                        <tr>
                            <td align="right" style="color:#aaa">数量：</td>
                            <td style="color:#aaa">×<?php echo $purchase_records['purchase_quantity']; ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <script src="/static/js/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                $("#fanhui").click(function(){
                    location.href = "/music/shop/wddd";
                });
            });
        </script>    
    </body>
</html>
