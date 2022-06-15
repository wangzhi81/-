<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:76:"/www/wwwroot/39.99.164.250/public/../application/music/view/index/gpsfj.html";i:1650369923;}*/ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="stylesheet" type="text/css" href="/static/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="/static/css/loading.css?v=0.3" />
        <link rel="stylesheet" type="text/css" href="/static/css/businesslist.css" />
        <title>风机定位</title>
    </head>
    <body>
        <table class="GridButtons table table-bordered" width="100%">
            <tr>
                <td>经度：<span id="jingdu"></span></td>
                <td>维度：<span id="weidu"></span></td>
            </tr>
            <tr>
                <td colspan="2">
                    位置精度：<span id="wzjd"></span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    定位时间：<span id="dwsj"></span>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="height:100px" id="ditu">
                    <iframe src="/map/map.html" frameborder="0" scrolling="auto" width="100%" height="100%" id="leftFrame"></iframe>
                </td>
            </tr>
        </table>
        <!--<script data-main="/static/js/BusinessList.js?v=0.5" src="/static/js/require.min.js"></script>-->
        <script data-main="/static/js/gpsfj.js?v=19" src="/static/js/require.min.js"></script>
    </body>
</html>
