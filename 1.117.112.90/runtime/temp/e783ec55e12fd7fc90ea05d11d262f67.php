<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:67:"/dc/www/1.117.112.90/public/../application/gps/view/index/ycsq.html";i:1655215851;}*/ ?>
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
        <title>用车申请</title>
    </head>
    <body>
        <input type="hidden" id="task_type" value="风机维护">
        <div style="padding:10px;display:none;color:#f00;background-color:#ff0;" id="wbdts">
            您尚未绑定任何车辆，请联系管理员！
        </div>
        <table class="GridButtons table table-bordered" width="100%">
            <tr>
                <td style="vertical-align:middle">任务类型：</td>
                <td style="vertical-align:middle">
                    <p><button type="button" class="btn btn-primary" style="margin-left:10px;margin-right:10px" id="fjwh">风机维护</button>
                    <button type="button" class="btn btn-default" style="margin-left:10px;margin-right:10px" id="wfrw">外阜任务</button></p>
                </td>
            </tr>
            <tr>
                <td style="vertical-align:middle">申请车辆：</td>
                <td style="vertical-align:middle">
                    <select class="form-control" id="vehicle_id"></select>
                </td>
            </tr>
            <tr>
                <td style="vertical-align:middle">出发地：</td>
                <td style="vertical-align:middle">
                    <table width="100%">
                        <tr>
                            <td><input type="text" class="form-control" id="place_of_departure" readonly>
                            <input type="hidden" id="origin_longitude"><input type="hidden" id="origin_latitude">
                            </td>
                            <td style="width:30px;text-align:center"><a href="#" id="xzcfd">选择</a></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="vertical-align:middle">出发时间：</td>
                <td><div class="input-group date" id="planned_departure_time_div" style="width:200px">  
                            <input type="text" class="form-control QueryCriteria" id="planned_departure_time" data-date-format="yyyy-mm-dd" readonly="readonly" style="background-color:#FFF">  
                            <span class="input-group-addon">  
                                <span class="glyphicon glyphicon-calendar"></span>  
                            </span>  
                        </div></td>
            </tr>
            <tr id="mddwtr">
                <td style="vertical-align:middle">目的地：</td>
                <td style="vertical-align:middle">
                    <table width="100%">
                        <tr>
                            <td><input type="text" class="form-control" id="destination" readonly>
                            <input type="hidden" id="destination_longitude"><input type="hidden" id="destination_latitude">
                            </td>
                            <td style="width:30px;text-align:center"><a href="#" id="xzmdd">选择</a></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr id="mddftr">
                <td style="vertical-align:middle">目的地(风机)：</td>
                <td style="vertical-align:middle">
                    <table width="100%">
                        <tr>
                            <td><input type="text" class="form-control" id="fjbhmc" readonly>
                            <input type="hidden" id="destination_id">
                            </td>
                            <td style="width:30px;text-align:center"><a href="#" id="xzfj">选择</a></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="vertical-align:middle">计划到达时间：</td>
                <td><div class="input-group date" id="scheduled_arrival_time_div" style="width:200px">  
                            <input type="text" class="form-control QueryCriteria" id="scheduled_arrival_time" data-date-format="yyyy-mm-dd" readonly="readonly" style="background-color:#FFF">  
                            <span class="input-group-addon">  
                                <span class="glyphicon glyphicon-calendar"></span>  
                            </span>  
                        </div></td>
            </tr>
        </table>
        
        <div style="text-align:center">
            <button type="button" class="btn btn-success" style="width:80%;" id="tijiao">提交</button>
        </div>
        <div style="position:absolute;top:0px;left:0px;z-index:100;background-color:#fff" id="xzcfdf">
            <div style="background-color:#337ab7;padding:10px;">
                <table width="100%">
                    <tr>
                        <td style="color:#fff">请选择出发地</td>
                        <td style="text-align:right"><span class="glyphicon glyphicon-remove gbdhk" aria-hidden="true" style="color:#d9534f"></span></td>
                    </tr>
                </table>
            </div>
            <div id="cfddt">
                <iframe src="" frameborder="0" scrolling="auto" width="100%" height="100%" id="cfddtif"></iframe>
            </div>
            <div style="padding:10px">
                <table width="100%">
                    <tr>
                        <td>已选择地址：<span id="yxzdzc"></span></td><td style="text-align:right"><button type="button" class="btn btn-primary btn-sm" id="qdcfd">确认</button></td>
                    </tr>
                </table>
            </div>
        </div>
        <div style="position:absolute;top:0px;left:0px;z-index:100;display:none;background-color:#fff" id="xzmddf">
            <div style="background-color:#337ab7;padding:10px;">
                <table width="100%">
                    <tr>
                        <td style="color:#fff">请选择目的地</td>
                        <td style="text-align:right"><span class="glyphicon glyphicon-remove gbdhk" aria-hidden="true" style="color:#d9534f"></span></td>
                    </tr>
                </table>
            </div>
            <div id="mdddt">
                <iframe src="" frameborder="0" scrolling="auto" width="100%" height="100%" id="mdddtif"></iframe>
            </div>
            <div style="padding:10px">
                <table width="100%">
                    <tr>
                        <td>已选择地址：<span id="yxzdzm"></span></td><td style="text-align:right"><button type="button" class="btn btn-primary btn-sm" id="qdmdd">确认</button></td>
                    </tr>
                </table>
            </div>
        </div>
        <div style="position:absolute;top:0px;left:0px;z-index:100;display:none;background-color:#fff" id="xzmddfj">
            <div style="background-color:#337ab7;padding:10px;">
                <table width="100%">
                    <tr>
                        <td style="color:#fff">请选择目的地(风机)</td>
                        <td style="text-align:right"><span class="glyphicon glyphicon-remove gbdhk" aria-hidden="true" style="color:#d9534f"></span></td>
                    </tr>
                </table>
            </div>
            <table width="100%" style="margin-top:10px">
                <tr>
                    <td style="width:10px"></td>
                    <td><input class="form-control" id="fjcxtj" type="text"></td>
                    <td style="width:10px"></td>
                    <td style="width:50px"><button type="button" class="btn btn-primary btn-sm" id="cxfj">查询</button></td>
                </tr>
            </table>
            <div id="xzmddfjd" style="padding:10px;overflow-y:auto">
            </div>
            <div style="padding:10px">
                <table width="100%">
                    <tr>
                        <td style="text-align:center"><button type="button" class="btn btn-primary btn-sm" id="xzfjqr" style="width:100px">确认</button></td>
                    </tr>
                </table>
            </div>
        </div>
        <!--<script data-main="/static/js/BusinessList.js?v=0.5" src="/static/js/require.min.js"></script>-->
        <script src="/static/js/jquery.min.js"></script>
        <script src="/static/js/bootstrap-datetimepicker.min.js"></script>
        <script src="/static/js/bootstrap-datetimepicker.zh-CN.js?v=1"></script>
        <script data-main="/static/js/ycsq.js?v=136" src="/static/js/require.min.js"></script>
        <script>
            var lng=0,lat;
            function setsfd(res){
                console.log(res.point.lat);
                lng = res.point.lng;
                lat = res.point.lat;
                $("#yxzdzc").text(res.address+res.title);
            }
            var lng2=0,lat2;
            function setmdd(res){
                lng2 = res.point.lng;
                lat2 = res.point.lat;
                $("#yxzdzm").text(res.address+res.title);
            }
            $("#qdcfd").click(function(){
                if(lng!=0){
                    $("#place_of_departure").val($("#yxzdzc").text());
                    $("#origin_longitude").val(lng);
                    $("#origin_latitude").val(lat);
                }
                $("#xzcfdf").hide();
                $("#shadow").hide();
            });
            $("#qdmdd").click(function(){
                if(lng2!=0){
                    $("#destination_longitude").val(lng2);
                    $("#destination_latitude").val(lat2);
                }else{
                    $("#destination_longitude").val($("#origin_longitude").val());
                    $("#destination_latitude").val($("#origin_latitude").val());
                }
                $("#destination").val($("#yxzdzm").text());
                $("#xzmddf").hide();
                $("#shadow").hide();
            });
            $(function(){
                $('#planned_departure_time_div').datetimepicker({  
                    format: 'yyyy-mm-dd hh:ii',
                    language: 'zh-CN',
                    autoclose:true,
                    minView: "hour",
                    todayBtn:true
                }); 
                $('#scheduled_arrival_time_div').datetimepicker({  
                    format: 'yyyy-mm-dd hh:ii',
                    language: 'zh-CN',
                    autoclose:true,
                    minView: "hour",
                    todayBtn:true
                }); 
            });
        </script>
    </body>
</html>
