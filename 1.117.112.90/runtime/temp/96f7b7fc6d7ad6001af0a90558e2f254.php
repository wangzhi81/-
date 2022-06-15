<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:74:"/www/wwwroot/39.99.164.250/public/../application/music/view/shop/zylb.html";i:1602405280;}*/ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="stylesheet" type="text/css" href="/static/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="/static/css/loading.css?v=0.3" />
        <link rel="stylesheet" type="text/css" href="/static/css/businesslist.css" />
        <title>资源列表</title>
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
        <img src="http://admin.dzyywx.com/MultimediaFiles/20200929/95ea2456a6f07382a13b5043b390aa6f.jpg" style="height:0px">
        <div style="background-color:#f2f3f7;padding:10px"><img src="/static/img/ico/fanhui.png" style="height:20px" id="fanhui"></div>
        <div style="padding:10px">
            <table width="100%">
                <tr>
                    <td><input type="text" class="form-control" id="cxtj" placeholder="查询全部资源"></td>
                    <td style="width:50px" align="center"><a href="#" id="chaxun">查询</a></td>
                </tr>
            </table>
            
        </div>
        <table width="100%">
            <tr>
                <td style="width:120px;font-size:16px" valign="top" id="fenlei">
                    <table class="seltab" RESOURCE_CLASSIFICATION_ID="">
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
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <script src="/static/js/jquery.min.js"></script>
        <script src="http://res.wx.qq.com/open/js/jweixin-1.6.0.js"></script>
        <script>
            $(document).ready(function() {
                
                $.post("/comm/weixin/getJsSign",{
                    url:window.location.href
                },function(res){
                    //res.debug = true;
                    wx.config(res);
                    //alert(window.location.href);
                    wx.ready(function(){
                        wx.onMenuShareTimeline({
                            title: '-资源列表', // 分享标题
                            link: window.location.href, // 分享链接,将当前登录用户转为puid,以便于发展下线
                            imgUrl: 'http://admin.dzyywx.com/MultimediaFiles/20200929/95ea2456a6f07382a13b5043b390aa6f.jpg', // 分享图标
                            success: function () { 
                                // 用户确认分享后执行的回调函数
                            },
                            cancel: function () { 
                                // 用户取消分享后执行的回调函数
                            }
                        });
                        wx.updateTimelineShareData({ 
                            title: '--资源列表', // 分享标题
                            link: window.location.href, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                            imgUrl: 'http://admin.dzyywx.com/MultimediaFiles/20200929/95ea2456a6f07382a13b5043b390aa6f.jpg', // 分享图标
                            success: function () {
                              // 设置成功
                              //alert(234);
                            }
                        });
                    });
                });
                $("#fanhui").click(function(){
                    location.href = "/music/index";
                });
                $("#chaxun").click(function(){
                    $.post("/music/index/chaxun0",{
                        cxtj:$("#cxtj").val()
                    },function(res){
                        location.href = "/music/shop/ziyuan";
                    });
                });
                $.post("/music/shop/getzy",{
                    cxtj:''
                },function(res){
                    var html = '<table width="100%">';
                    $.each(res,function(i,v){
                        html+='<tr style="border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color:#cdcdcd" class="spitme" DOWNLOAD_RESOURCES_ID="'+v.DOWNLOAD_RESOURCES_ID+'">                <td style="width:30%;padding:5px" valign="top">                    <img src="'+v.resource_image+'" class="img-responsive">                </td>                <td style="padding:5px" valign="top">                    <div style="height:40px;margin-top:5px">'+v.resource_name+'</div>                    <div>                        <table width="100%">                            <tr>                                <td>                                    <span style="color:#EF7C38;">￥<span style="font-size:20px">'+v.resource_price+'</span></span>                                    <span style="text-decoration:line-through;color:#cdcdcd"></span>                                </td>                                <td align="right">                                    <span style="color:#cdcdcd"></span>                                </td>                            </tr>                        </table>                    </div>                </td>            </tr>';
                        
                    });
                    html+='</table></td>';
                    $("#kclb").html(html);
                    $(".spitme").click(function(){
                        var DOWNLOAD_RESOURCES_ID = $(this).attr("DOWNLOAD_RESOURCES_ID");
                        location.href = "/music/shop/zyxz/id/"+DOWNLOAD_RESOURCES_ID;
                    });
                });
                $.post("/music/shop/getzyfl",{
                    
                },function(res){
                    //console.log(res);
                    var html = "";
                    $.each(res,function(i,v){
                        html+='<table class="table1" RESOURCE_CLASSIFICATION_ID="'+v.RESOURCE_CLASSIFICATION_ID+'"><tr><td class="tdd1"></td><td style="width:10px"></td><td class="td2 tdd2" style="width:100px">'+v.resource_classification+'</td></tr></table>';
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
                        var RESOURCE_CLASSIFICATION_ID = $(this).attr("RESOURCE_CLASSIFICATION_ID");
                        $.post("/music/shop/getzyf",{
                            resource_classification:RESOURCE_CLASSIFICATION_ID
                        },function(res){
                            var html = '<table width="100%">';
                            $.each(res,function(i,v){
                                html+='<tr style="border-bottom-width: 1px;border-bottom-style: solid;border-bottom-color:#cdcdcd" class="spitme" DOWNLOAD_RESOURCES_ID="'+v.DOWNLOAD_RESOURCES_ID+'">                <td style="width:30%;padding:5px" valign="top">                    <img src="'+v.resource_image+'" class="img-responsive">                </td>                <td style="padding:5px" valign="top">                    <div style="height:40px;margin-top:5px">'+v.resource_name+'</div>                    <div>                        <table width="100%">                            <tr>                                <td>                                    <span style="color:#EF7C38;">￥<span style="font-size:20px">'+v.resource_price+'</span></span>                                    <span style="text-decoration:line-through;color:#cdcdcd"></span>                                </td>                                <td align="right">                                    <span style="color:#cdcdcd"></span>                                </td>                            </tr>                        </table>                    </div>                </td>            </tr>';
                            });
                            html+='</table></td>';
                            $("#kclb").html(html);
                            $(".spitme").click(function(){
                                var DOWNLOAD_RESOURCES_ID = $(this).attr("DOWNLOAD_RESOURCES_ID");
                                location.href = "/music/shop/zyxz/id/"+DOWNLOAD_RESOURCES_ID;
                            });
                        });
                    });
                });
                
            });
        </script>
    </body>
</html>
