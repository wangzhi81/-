<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:74:"/www/wwwroot/39.99.164.250/public/../application/music/view/shop/ljxz.html";i:1600163402;}*/ ?>
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
        <title>立即下载</title>
    </head>
    
    <body style="background-color:#cdcdcd">
        <div class="panel panel-default">
          <div class="panel-body">
            <table width="100%">
                <tr>
                    <td>
                        <div style="font-size:20px">温馨提示</div>
                        <div>点击右上角的<img src="/static/img/ico/shd.png" style="height:20px">选择在浏览器打开即可下载</div>
                    </td>
                    <td align="right">
                        <img src="/static/img/ico/jt2.png" style="width:48px">
                    </td>
                    <td style="width:10px"></td>
                </tr>
            </table>
          </div>
        </div>
        <div><?php echo $download_resources['download_path']; ?></div>
        <a href="http://admin.dzyywx.com<?php echo $download_resources['download_path']; ?>"><p id="exe">压缩包</p></a>
        <script src="/static/js/jquery.min.js"></script>
<script>
 $("#exe").click();
</script>
    </body>
</html>
