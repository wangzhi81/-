<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:80:"/www/wwwroot/39.99.164.250/public/../application/music/view/shop/viphuiyuan.html";i:1598860099;}*/ ?>
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
        <div style="height:10px"></div>
        <div class="panel panel-default" style="margin-left: 10px;margin-right: 10px;">
          <div class="panel-body">
            <div><?php echo $user_list['membership_type']; ?></div>
            <div>有效期至：<?php echo $user_list['vip_expiration_date']; ?></div>
          </div>
        </div>
        
        <script src="/static/js/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                $("#fanhui").click(function(){
                    location.href = "/music/";
                });
            });
        </script>
    </body>
</html>
