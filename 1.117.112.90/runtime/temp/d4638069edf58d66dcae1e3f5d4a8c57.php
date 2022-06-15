<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:84:"/www/wwwroot/erp.wangzhi81.com/public/../application/admin/view/towadd26/ztqkfx.html";i:1531053830;}*/ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title></title>
        <style type="text/css">
            body{
                background-color: #08304a;padding: 10px;
            }
            .span1{color:#0ee;font-size:16px;font-weight:bold;}
            .tulidiv{position: absolute;top:500px;left:100px;background-color:rgba(0,0,0,0.5);padding:10px;color:#FFF;font-size:12px;}
        </style>
    </head>
    
    <body>
        <table width="100%"><tr><td align="center"><span class="span1">全国各省各地区超标率分析</span></td></tr></table>
        <div style="padding:10px;border: 1px solid #0F0;">
            <div style="height:700px;overflow:hidden">
                <div id="mapchar" style="height:760px;"></div>
            </div>
        </div>
        <div style="height:10px"></div>
        <table width="100%">
            <tr>
                <td style="width:50%">
                    <div id="main" style="height:330px;"></div>
                </td>
                <td>
                    <div id="main2" style="height:330px;"></div>
                </td>
            </tr>
            <tr>
                <td>
                    <div id="main3" style="height:330px;"></div>
                </td>
                <td>
                    <div id="main4" style="height:330px;"></div>
                </td>
            </tr>
            <tr>
                <td>
                    <div id="main7" style="height:330px;"></div>
                </td>
                <td>
                    <div id="main8" style="height:330px;"></div>
                </td>
            </tr>
        </table>
        <div class="tulidiv">
            <table width="100%">
                <tr><td align="center">超标率</td></tr>
                <tr><td style="height:10px"></td></tr>
                <tr>
                    <td>
                        <table width="100%">
                            <tr><td align="right"><div style="width:80px;height:20px;background-color:rgba(51,122,39,0.8)"></div></td><td style="width:10px"></td><td>0%~20%</td></tr>
                            <tr><td align="right"><div style="width:80px;height:20px;background-color:rgba(102,122,39,0.8)"></div></td><td style="width:10px"></td><td>20%~40%</td></tr>
                            <tr><td align="right"><div style="width:80px;height:20px;background-color:rgba(153,122,39,0.8)"></div></td><td style="width:10px"></td><td>40%~60%</td></tr>
                            <tr><td align="right"><div style="width:80px;height:20px;background-color:rgba(204,122,39,0.8)"></div></td><td style="width:10px"></td><td>60%~80%</td></tr>
                            <tr><td align="right"><div style="width:80px;height:20px;background-color:rgba(255,122,39,0.8)"></div></td><td style="width:10px"></td><td>80%~100%</td></tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        <script type="text/javascript" src="http://api.map.baidu.com/api?v=3.0&ak=5QUV6G5DqeH7ljQ8iGOnYOcc"></script>
        <script src="/static/js/Towadd26/echarts.min.js"></script>
        <script src="/static/js/Towadd26/bmap.js"></script>
        <script src="/static/js/jquery.min.js"></script>
        <script src="/static/js/Towadd26/ztqkfx.js?v=2"></script>
        <script src="/static/js/Towadd26/quqkmapchar.js?v=2"></script>
    </body>
</html>
