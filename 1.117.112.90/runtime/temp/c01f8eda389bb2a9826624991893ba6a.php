<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:75:"/www/wwwroot/39.99.164.250/public/../application/music/view/index/kclb.html";i:1596713742;}*/ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="stylesheet" type="text/css" href="/static/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="/static/css/loading.css?v=0.3" />
        <link rel="stylesheet" type="text/css" href="/static/css/businesslist.css" />
        <title>课程列表</title>
        <style>
            .td1{padding:5px;}
            
            .table1{margin-top: 0px;margin-bottom: 0px;background-color:#f2f3f7;table-layout:fixed;}
            .td2{color:#666;padding-right: 10px;padding-top: 10px;padding-bottom: 10px;}
            .seltab{margin-top: 0px;margin-bottom: 0px;}
            .seltd1{width:5px;background-color:#EF7C38}
            .seltd2{color:#EF7C38;color:#666;padding-right: 10px;padding-top: 10px;padding-bottom: 10px;}
        </style>
    </head>
    
    <body>
        <div style="background-color:#f2f3f7;padding:10px"><img src="/static/img/ico/fanhui.png" style="height:20px" id="fanhui"></div>
        <div style="padding:10px">
            <table width="100%">
                <tr>
                    <td><input type="text" class="form-control" id="cxtj" placeholder="查询全部课程"></td>
                    <td style="width:50px" align="center"><a href="#" id="chaxun">查询</a></td>
                </tr>
            </table>
            
        </div>
        <table width="100%">
            <tr>
                <td style="width:120px;font-size:16px" valign="top" id="fenlei">
                    <table class="seltab">
                        <tr>
                            <td class="seltd1 tdd1"></td>
                            <td style="width:10px"></td>
                            <td class="seltd2 tdd2" style="width:100px">所有分类</td>
                        </tr>
                    </table>
                </td>
                <td valign="top" id="kclb">
                    <table width="100%">
                        <tr>
                            <td class="td1">
                                <div><img src="https://ck-bkt-knowledge-payment.oss-cn-hangzhou.aliyuncs.com/1002870/resource/课程分类封面图750×500_6F8cmBKsNXx5Rb2A4ei3.jpg"  class="img-responsive img-rounded"></div>
                                <div>张峰声乐教学</div>
                            </td>
                            <td class="td1">
                                <img src="https://ck-bkt-knowledge-payment.oss-cn-hangzhou.aliyuncs.com/1002870/resource/课程分类封面图750×500_6F8cmBKsNXx5Rb2A4ei3.jpg"  class="img-responsive img-rounded">
                                <div>张峰声乐教学</div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <script src="/static/js/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                $("#fanhui").click(function(){
                    location.href = "/music/index";
                });
                $("#chaxun").click(function(){
                    $.post("/music/index/chaxun0",{
                        cxtj:$("#cxtj").val()
                    },function(res){
                        location.href = "/music/index/chaxun";
                    });
                });
                $.post("/music/index/getcourse_informationss",{},function(res){
                    var html = '<table width="100%"><tr>';
                    $.each(res,function(i,v){
                        html+='<td class="td1" COURSE_INFORMATION_ID="'+v.COURSE_INFORMATION_ID+'"><div><img src="'+v.course_pictures+'"  class="img-responsive img-rounded"></div><div>'+v.course_title+'</div></td>';
                        if(i%2===1){
                            html+='</tr></table></td><table width="100%"><tr>';
                        }
                    });
                    html+='</tr></table></td>';
                    $("#kclb").html(html);
                    $(".td1").click(function(){
                        var COURSE_INFORMATION_ID = $(this).attr("COURSE_INFORMATION_ID");
                        location.href = "/music/index/kecheng/id/"+COURSE_INFORMATION_ID;
                    });
                });
                $.post("/music/index/kcfllb",{
                    
                },function(res){
                    //console.log(res);
                    var html = "";
                    $.each(res,function(i,v){
                        html+='<table class="table1" COURSE_CLASSIFICATION_ID="'+v.COURSE_CLASSIFICATION_ID+'"><tr><td class="tdd1"></td><td style="width:10px"></td><td class="td2 tdd2" style="width:100px">'+v.classification_name+'</td></tr></table>';
                    });
                    $("#fenlei").append(html);
                    $("#fenlei>table").click(function(){
                        $("#fenlei>table").removeClass("seltab");
                        $("#fenlei>table .tdd1").removeClass("seltd1");
                        $("#fenlei>table .tdd2").removeClass("seltd2");
                        $("#fenlei>table").addClass("table1");
                        $("#fenlei>table .tdd2").addClass("td2");
                        $(this).addClass("seltab");
                        $(this).find('.tdd1').addClass("seltd1");
                        $(this).find('.tdd2').addClass("seltd2");
                        $(this).removeClass("table1");
                        $(this).find('.tdd2').removeClass("td2");
                        var COURSE_CLASSIFICATION_ID = $(this).attr("COURSE_CLASSIFICATION_ID");
                        $.post("/music/index/getcourse_informationssw",{
                            COURSE_CLASSIFICATION_ID:COURSE_CLASSIFICATION_ID
                        },function(res){
                            var html = '<table width="100%"><tr>';
                            $.each(res,function(i,v){
                                html+='<td class="td1" COURSE_INFORMATION_ID="'+v.COURSE_INFORMATION_ID+'"><div><img src="'+v.course_pictures+'"  class="img-responsive img-rounded"></div><div>'+v.course_title+'</div></td>';
                                if(i%2===1){
                                    html+='</tr></table></td><table width="100%"><tr>';
                                }
                            });
                            html+='</tr></table></td>';
                            $("#kclb").html(html);
                            $(".td1").click(function(){
                                var COURSE_INFORMATION_ID = $(this).attr("COURSE_INFORMATION_ID");
                                location.href = "/music/index/kecheng/id/"+COURSE_INFORMATION_ID;
                            });
                        });
                    });
                });
                
            });
        </script>
    </body>
</html>
