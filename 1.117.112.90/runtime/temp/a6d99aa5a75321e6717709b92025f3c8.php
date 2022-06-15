<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:84:"/www/wwwroot/erp.wangzhi81.com/public/../application/admin/view/towadd26/dpsjzs.html";i:1531128600;}*/ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title></title>
        <style type="text/css">
            body{
                background-color: #08304a;
            }
            .div4{
                border: 1px solid #0F0;padding: 10px;overflow:hidden;
            }
            .biaoti{
                font-size: 20px;font-weight: bold;color: #FFF;
            }
            .span1{color:#FFF;}
        </style>
    </head>
    
    <body>
        <table width="100%">
            <tr><td align="center"><span class="biaoti">2+26城市机动车遥感监测动态可视化数据分析</span></td></tr>
        </table>
        <table width="100%">
            <tr>
                <td id="td1" valign="top" class="div4" style="width:500px">
                    <table width="100%"><tr><td align="center"><span class="span1">城市连接情况</span></td></tr></table>
                    <div style="height:500px;overflow:hidden;">
                        <div id="mapdiv" style="height:550px;"></div>
                    </div>
                    <div>
                        <table style="color:#0ee;font-size:12px">
                            <tr>
                                <td><img src="/static/img/ico/yilianjie.png" style="width:12px"></td>
                                <td>已连接</td>
                                <td><img src="/static/img/ico/guzhang.png" style="width:12px"></td>
                                <td>故障</td>
                                <td><img src="/static/img/ico/weilianjie.png" style="width:12px"></td>
                                <td>未连接</td>
                                <td><img src="/static/img/ico/lixian.png" style="width:12px"></td>
                                <td>离线</td>
                            </tr>
                        </table>
                    </div>
                </td>
                <td style="width:5px"></td>
                <td valign="top">
                    <div class="div4">
                        <table width="100%"><tr><td align="center"><span class="span1">数据上报情况(万条)</span></td></tr></table>
                        <div id="sjsbqk" style="height:200px"></div>
                    </div>
                    <div style="height:10px"></div>
                    <table width="100%">
                        <tr>
                            <td class="div4" style="width:32%">
                                <table width="100%"><tr><td align="center"><span class="span1">超标车辆结构分析</span></td></tr></table>
                                <div id="cbcljgfx" class="fenxi1"></div>
                            </td>
                            <td style="width:10px"></td>
                            <td class="div4" style="width:32%">
                                <table width="100%"><tr><td align="center"><span class="span1">超标车辆生产企业分析</span></td></tr></table>
                                <div id="cbclscqyfx" class="fenxi1"></div>
                            </td>
                            <td style="width:10px"></td>
                            <td class="div4">
                                <table width="100%"><tr><td align="center"><span class="span1">超标车辆检测机构分析</span></td></tr></table>
                                <div id="cbcljcjgfx" class="fenxi1"></div>
                            </td>
                        </tr>
                    </table>
                    <div style="height:10px"></div>
                    <div class="div4">
                        <table width="100%" style="color:#0ee;font-size:12px">
                            <tr>
                                <td align="right">
                                    <table><tr>
                                        <td align="center"><img src="/static/img/ico/qichejq.png" height="40px"></td>
                                    </tr><tr>
                                        <td align="center">检测车辆</td>
                                    </tr></table>
                                </td>
                                <td style="width:5px"></td>
                                <td><span style="font-weight:bold;font-size:25px;color:rgb(255,198,3);">21372978辆次</span></td>
                                <td style="width:20px"></td>
                                <td align="right">
                                    <table><tr>
                                        <td align="center"><img src="/static/img/ico/led.png" height="40px"></td>
                                    </tr><tr>
                                        <td align="center">遥测站</td>
                                    </tr></table>
                                </td>
                                <td style="width:5px"></td>
                                <td><span style="font-weight:bold;font-size:25px;color:rgb(255,198,3);">239个</span></td>
                                <td style="width:20px"></td>
                                <td align="right">
                                    <table><tr>
                                        <td align="center"><img src="/static/img/ico/yaoceche.png" height="40px"></td>
                                    </tr><tr>
                                        <td align="center">遥测车</td>
                                    </tr></table>
                                </td>
                                <td style="width:5px"></td>
                                <td><span style="font-weight:bold;font-size:25px;color:rgb(255,198,3);">67辆</span></td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
        <script type="text/javascript" src="http://api.map.baidu.com/api?v=3.0&ak=5QUV6G5DqeH7ljQ8iGOnYOcc"></script>
        <script src="/static/js/Towadd26/echarts.min.js"></script>
        <script src="/static/js/Towadd26/bmap.js"></script>
        <script src="/static/js/jquery.min.js"></script>
        <script src="/static/js/Towadd26/dpsjzs.js?v=2"></script>
    </body>
</html>
