<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:89:"/www/wwwroot/erp.wangzhi81.com/public/../application/admin/view/towadd26/tongjifenxi.html";i:1534411554;}*/ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title></title>
        <link rel="stylesheet" type="text/css" href="/static/css/bootstrap.min.css" />
        <style type="text/css">
            body{
                background-color: #08304a;padding: 10px;
            }
            .span1{color:#0ee;font-size:16px;font-weight:bold;}
        </style>
    </head>
    
    <body>
        <table width="100%">
            <tr>
                <td style="width:500px" valign="top">
                    <table width="100%"><tr><td align="center"><span class="span1">监测点位数量排名分析</span></td></tr></table>
                    <div id="dwslpm" style="height:2000px"></div>
                </td>
                <td style="width:10px"></td>
                <td valign="top">
                    <table width="100%"><tr><td align="center"><span class="span1">设备类型分布统计</span></td></tr></table>
                    <div id="sblxfbfx" style="height:300px"></div>
                    <div style="height:10px"></div>
                    <table width="100%"><tr><td align="center"><span class="span1">各地区尾气遥感建设情况</span></td></tr></table>
                    <div id="wqygjsqk" style="height:300px"></div>
                </td>
            </tr>
        </table>
        <script type="text/javascript" src="http://api.map.baidu.com/api?v=3.0&ak=5QUV6G5DqeH7ljQ8iGOnYOcc"></script>
        <script src="/static/js/Towadd26/echarts.min.js"></script>
        <script src="/static/js/Towadd26/bmap.js"></script>
        <script src="/static/js/jquery.min.js"></script>
        <script src="/static/js/Towadd26/tongjifenxi.js?v=3"></script>
        <script src="/static/js/Towadd26/sblxfbfx.js?v=2"></script>
        <script src="/static/js/Towadd26/wqygjsqk.js?v=2"></script>
    </body>
</html>
