<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:77:"/www/wwwroot/39.99.164.250/public/../application/music/view/shop/huiyuan.html";i:1600131885;}*/ ?>
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
            .sel{border-color:#EF7C38}
        </style>
        <title>音乐之声</title>
    </head>
    
    <body>
        <div style="background-color:#f2f3f7;padding:10px"><img src="/static/img/ico/fanhui.png" style="height:20px" id="fanhui"></div>
        <div style="height:100px;background-color:#444">
            <table>
                <tr>
                    <td style="width:20px"></td>
                    <td style="height:100px"><img class="img-circle" style="width:80px" src="<?php echo $user_list['HEAD_PORTRAIT']; ?>"></td>
                    <td style="width:20px"></td>
                    <td style="color:#fff">
                        <div style="font-size:20px"><?php echo $user_list['NICKNAME']; ?></div>
                        <div><?php echo $user_list['membership_type']; ?>~<?php echo $user_list['vip_expiration_date']; ?></div>
                    </td>
                </tr>
            </table>
        </div>
        <table width="100%" id="hytb">
            <tr>
                <td style="padding:5px;width:25%">
                    <div class="panel panel-default sel" style="">
                      <div class="panel-body" style="padding:5px">
                        <div style="font-size:12px" class="hym">月VIP</div>
                        <div>￥<span style="font-size:16px;color:#EF7C38" class="price"><?php echo $membership_settings0['member_price']; ?></span></div>
                      </div>
                    </div>
                </td>
                <td style="padding:5px;width:25%">
                    <div class="panel panel-default">
                      <div class="panel-body" style="padding:5px">
                        <div style="font-size:12px" class="hym">季度VIP</div>
                        <div>￥<span style="font-size:16px;color:#EF7C38" class="price"><?php echo $membership_settings1['member_price']; ?></span></div>
                      </div>
                    </div>
                </td>
                <td style="padding:5px;width:25%">
                    <div class="panel panel-default">
                      <div class="panel-body" style="padding:5px">
                        <div style="font-size:12px" class="hym">半年VIP</div>
                        <div>￥<span style="font-size:16px;color:#EF7C38" class="price"><?php echo $membership_settings2['member_price']; ?></span></div>
                      </div>
                    </div>
                </td>
                <td style="padding:5px;width:25%">
                    <div class="panel panel-default">
                      <div class="panel-body" style="padding:5px">
                        <div style="font-size:12px" class="hym">年VIP</div>
                        <div>￥<span style="font-size:16px;color:#EF7C38" class="price"><?php echo $membership_settings3['member_price']; ?></span></div>
                      </div>
                    </div>
                </td>
            </tr>
        </table>
        <div class="panel panel-default" style="margin-left: 10px;margin-right: 10px;">
            <div class="panel-heading">支付方式</div>
          <div class="panel-body">
            <table width="100%">
                <tr>
                    <td style="width:50px"><img src="/static/img/ico/wxzf.png" style="width:30px"></td>
                    <td>微信支付</td>
                    <td align="right"><img src="/static/img/ico/dui.png" style="width:20px"></td>
                </tr>
            </table>
            <hr>
            <button type="button" class="btn btn-success btn-block" id="ljzf">立即支付</button>
          </div>
        </div>
        <div style="margin-right:20px;margin-left:20px">注：如果已支付，请等待几分钟，并重新进入本页面。</div>
        <script src="/static/js/jquery.min.js"></script>
        <script>
            var hym = "月VIP";
            var price;
            $(document).ready(function() {
                price = $("#hytb .sel .price").text();
                $("#hytb .panel").click(function(){
                    $("#hytb .panel").removeClass("sel");
                    $(this).addClass("sel");
                    hym = $(this).find(".hym").text();
                    price = $(this).find(".price").text();
                    
                });
                $("#ljzf").click(function(){
                    //alert(price);
                    $.post("/music/shop/zfhy",{
                        name:hym,
                        price:price
                    },function(res){
                        location.href = res;
                    });
                });
                $("#fanhui").click(function(){
                    location.href = "/music/";
                });
            });
        </script>
    </body>
</html>
