<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:75:"/www/wwwroot/39.99.164.250/public/../application/index/view/test/index.html";i:1568524024;}*/ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="stylesheet" type="text/css" href="/static/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="/static/css/loading.css?v=0.3" />
        <link rel="stylesheet" type="text/css" href="/static/css/businesslist.css" />
        <title>登录</title>
    </head>
    <body style="background:#2c3d7a">
        <div>
            <table width="100%">
                <tr><td id="td1" align="center" valign="middle" style="height:1000px">
                    <img id="img1" src="/static/img/5cb8284bd98d1.jpg" style="width:500px">
                </td></tr>
            </table>
        </div>
        <div class="panel panel-default" style="margin:10px;">
          <div class="panel-body" style="color:#3a467c">
            <span id="span1" style="font-weight:700">登录</span>
          </div>
        </div>
        <script src="/static/js/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                //alert($(window).width()/1903*512);
                $("#img1").css("width",$(window).width()/1903*512);
                $("#span1").css("font-size",$(window).width()/1903*117);
                $("#span1").css("margin-left",$(window).width()/1903*100-15);
                //alert($("#img1").height()/512*150);
                $("#td1").css("height",$("#img1").height()/512*1024);
            });
        </script>
    </body>
</html>
