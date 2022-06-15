<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:71:"/dc/www/1.117.112.90/public/../application/gps/view/index/ycsqlist.html";i:1653892373;}*/ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="stylesheet" type="text/css" href="/static/css/bootstrap.min.css" />
        <link href="/static/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="/static/css/loading.css?v=0.3" />
        <link rel="stylesheet" type="text/css" href="/static/css/businesslist.css" />
        <title>用车申请列表</title>
    </head>
    
    <body>
        <div style="text-align:right;padding:10px">
            <button type="button" class="btn btn-primary btn-sm" id="tianjia">添加任务</button>
        </div>
        <div id="cclb">
        </div>
        <script src="/static/js/jquery.min.js"></script>
        <script src="/static/js/bootstrap-datetimepicker.min.js"></script>
        <script src="/static/js/bootstrap-datetimepicker.zh-CN.js?v=1"></script>
        <script>
            $(function(){
                $('<div class="modal-backdrop fade in" id="shadow" style="z-index:99">'
            		+'<div id="loading-center-absolute">'
            		+'	<div class="object" id="object_one"></div>'
            		+'	<div class="object" id="object_two"></div>'
            		+'	<div class="object" id="object_three"></div>'
            		+'	<div class="object" id="object_four"></div>'
            		+'	<div class="object" id="object_five"></div>'
            		+'	<div class="object" id="object_six"></div>'
            		+'	<div class="object" id="object_seven"></div>'
            		+'	<div class="object" id="object_eight"></div>'
            		+'</div>'
            	+'</div>').appendTo("body");
            	$("#tianjia").click(function(){
            	    location.href = "/gps/index/ycsq";
            	});
            	$.post("/gps/index/getccrwbysqr",{},function(res){
            	    var html = '';
            	    $.each(res,function(i,v){
            	        html += '<div class="panel panel-default">              <div class="panel-body">                <table width="100%">                    <tr>                        <td style="font-size:16px;font-weight:bold"><img style="width:16px" src="/static/icons/cheliang.png"><span style="margin-left:10px">'+v.license_plate_number+'</span></td>                        <td style="font-weight:bold;text-align:right">任务类型：<span>'+v.task_type+'</span></td>                    </tr>                </table>                <table width="100%" style="margin-top:10px;color:#444">                    <tr><td style="width:100px;">目的地：</td><td>'+v.destination+'</td></tr>                    <tr><td style="width:100px;">计划到达时间：</td><td>'+v.scheduled_arrival_time+'</td></tr>                    <tr><td style="width:100px;">实际到达时间：</td><td>'+v.actual_arrival_time+'</td></tr>                </table>                <table width="100%" style="margin-top:10px;color:#4caf50">                    <tr><td style="width:100px;text-align:right"><span>'+v.approval_status+'</span><span style="margin-left:10px">'+v.complete+'</span></td></tr>                </table>              </div>            </div>';
            	    });
            	    $("#cclb").html(html);
            	});
            	$("#shadow").hide();
            });
        </script>
    </body>
</html>
