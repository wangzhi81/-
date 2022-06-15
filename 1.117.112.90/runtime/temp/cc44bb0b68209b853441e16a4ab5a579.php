<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:78:"/www/wwwroot/erp.wangzhi81.com/public/../application/index/view/erp/login.html";i:1544453298;}*/ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="stylesheet" type="text/css" href="/static/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="/static/css/loading.css?v=0.3" />
        <link rel="stylesheet" type="text/css" href="/static/css/businesslist.css" />
        <title>批零企业微库存管理</title>
    </head>
    
    <body>
        <div style="padding:10px">
            <div style="height:10px"></div>
            <div style="text-align:center">
                <h4>用户登录</h4>
            </div>
            <div style="height:10px"></div>
            <table width="100%">
                <tr>
                    <td style="width:50px">
                        <img src="/static/img/ico/user.png" class="img-responsive">
                    </td>
                    <td>
                        <input type="text" class="form-control" id="username" placeholder="请输入用户名">
                    </td>
                    <td style="width:10px"></td>
                </tr>
                <tr>
                    <td style="width:50px" align="center">
                        <img src="/static/img/ico/password.png" class="img-responsive" style="width:30px">
                    </td>
                    <td>
                        <input type="password" class="form-control" id="password" placeholder="请输入密码">
                    </td>
                    <td style="width:10px"></td>
                </tr>
            </table>
            
            <div style="text-align:right;padding:10px">
                <a href="/index/erp/register" style="text-decoration:underline">注册新用户</a>
            </div>
            <div style="padding:10px">
                <button class="btn btn-primary btn-lg btn-block" type="button" id="login">登录</button>
            </div>
            <div id="liulanqi"></div>
        </div>
        <script type="text/javascript" src="/static/js/jquery.min.js"></script>
        <script type="text/javascript" src="/static/js/jquery.cookie.js"></script>
        <script type="text/javascript">
            
            function isWeiXin() { 
                var ua = window.navigator.userAgent.toLowerCase(); 
                if (ua.match(/MicroMessenger/i) == 'micromessenger') { 
                    return true; 
                } else { 
                    return false; 
                } 
            }
            
            $(document).ready(function(){
                
                if(isWeiXin()){
                    $.post("/index/erp/getOpenid",{},function(res){
                        
                    });
                }
                
                $("#login").click(function(){
                    var username = $("#username").val().trim();
                    var password = $("#password").val();
                    if(username===''){
                        alert("请输入用户名，不能包含空格。");
                        return false;
                    }
                    if(password===''){
                        alert("请输入密码。")
                        return false;
                    }
                    $.post("/index/erp/loginaction",{
                        username:username,
                        password:password
                    },function(res){
                        //console.log(res);
                        if(res.info==='ok'){
                            $.cookie('LogInfo',res.uuid,{ expires: 365 , path: '/'})
                            location.href="/index/erp";
                        }else{
                            alert(res.info);
                        }
                    },'json');
                });
                //console.log(window.navigator.connection);
                $("#liulanqi").text(window.navigator.userAgent);
            });
        </script>
    </body>
</html>
