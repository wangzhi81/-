<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:84:"/www/wwwroot/erp.wangzhi81.com/public/../application/admin/view/towadd26/jtllxc.html";i:1531115504;}*/ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title></title>
        <link rel="stylesheet" type="text/css" href="/static/css/bootstrap.min.css" />
        <style type="text/css">
            body{
                padding: 10px;
            }
            .span1{color:#0ee;font-size:16px;font-weight:bold;}
            .biaotidiv{color:#6E747B;font-size:12px;}
            .ziti1{font-weight:700;font-size:12px;}
            .anniu1{background-color:#1fb1ea;padding:3px;width:35px;text-align:center;height:35px;}
            .tulidiv{position: absolute;top:500px;left:100px;background-color:rgba(0,0,0,0.5);padding:10px;color:#FFF;font-size:12px;}
        </style>
    </head>
    
    <body>
        <div class="biaotidiv">交通流程查询</div>
        <hr style="border:0px;border-top:1px solid #DEE1E3;margin-top:10px;margin-bottom:10px">
        <table width="100%">
            <tr><td align="right">
                <table>
                    <tr>
                        <td class="ziti1">高级查询</td>
                        <td style="width:10px"></td>
                        <td><input style="width:350px;height:35px;"></td>
                        <td class="anniu1"><img src="/static/img/ico/chaxun.png" style="width:20px"></td>
                    </tr>
                </table>
            </td></tr>
        </table>
        <div style="height:10px"></div>
        <table class="table table-bordered" style="font-size:12px">
            <tr>
                <th></th>
                <th align="center">点位编号</th>
                <th align="center">所属道路</th>
                <th align="center">流量分类</th>
                <th align="center">统计时长</th>
                <th align="center">采集时段</th>
                <th align="center">统计日期</th>
                <th align="center">车道序号</th>
                <th align="center">微小型客车数</th>
                <th align="center">中型客车数</th>
                <th align="center">大型客车数</th>
                <th align="center">小型货车数</th>
                <th align="center">中型货车数</th>
                <th align="center">重型货车数</th>
                <th align="center">通行车辆数</th>
                <th align="center">平均速度</th>
                <th align="center">平均排队长度</th>
            </tr>
            <tbody id="tbody1">
                
            </tbody>
        </table>
        <script src="/static/js/jquery.min.js"></script>
        <script src="/static/js/Towadd26/jtllxc.js?v=2"></script>
    </body>
</html>
