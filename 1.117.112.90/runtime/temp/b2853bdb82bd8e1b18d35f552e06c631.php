<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:84:"/www/wwwroot/erp.wangzhi81.com/public/../application/index/view/commodity/index.html";i:1549723081;}*/ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="stylesheet" type="text/css" href="/static/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="/static/css/loading.css?v=0.3" />
        <link rel="stylesheet" type="text/css" href="/static/css/businesslist.css" />
        <title>商品管理</title>
    </head>
    
    <body>
        <div style="padding:10px">
            <table width="100%">
                <tr>
                    <td>
                        <a href="/index/erp" id="fanhui">
                            <img src="/static/img/ico/fanhui.png" style="width:10px">
                            返回
                        </a>
                    </td>
                    <td align="right">
                        <a href="#" id="add">添加</a>
                    </td>
                </tr>
            </table>
        </div>
        <div id="list"></div>
        
        <script type="text/javascript" src="/static/js/jquery.min.js"></script>
        <script type="text/javascript" src="/static/js/jquery.cookie.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $.post("/index/Commodity/getCommoditys",{},function(res){
                    //console.log(res);
                    $("#list").html(res);
                });
                $("#add").click(function(){
                    location.href='/index/Commodity/add';
                });
            });
        </script>
    </body>
</html>