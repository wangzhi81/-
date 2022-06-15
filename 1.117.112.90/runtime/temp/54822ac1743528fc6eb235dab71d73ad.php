<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:87:"/www/wwwroot/erp.wangzhi81.com/public/../application/index/view/erp/modifypassword.html";i:1544348860;}*/ ?>
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
                <h4>修改密码</h4>
            </div>
            <div style="height:10px"></div>
            <table width="100%">
                <tr>
                    <td style="width:50px" align="center">
                        <img src="/static/img/ico/oldkey.png" class="img-responsive" style="width:30px">
                    </td>
                    <td>
                        <input type="password" class="form-control" id="oldpassword" placeholder="请输入原密码">
                    </td>
                    <td style="width:10px"></td>
                </tr>
                <tr><td style="height:8px"></td></tr>
                <tr>
                    <td style="width:50px" align="center">
                        <img src="/static/img/ico/password.png" class="img-responsive" style="width:30px">
                    </td>
                    <td>
                        <input type="password" class="form-control" id="password" placeholder="请输入新密码">
                    </td>
                    <td style="width:10px"></td>
                </tr>
                <tr><td style="height:8px"></td></tr>
                <tr>
                    <td style="width:50px" align="center">
                        <img src="/static/img/ico/repw.png" class="img-responsive" style="width:30px">
                    </td>
                    <td>
                        <input type="password" class="form-control" id="password2" placeholder="再次输入新密码">
                    </td>
                    <td style="width:10px"></td>
                </tr>
            </table>
            <div style="height:10px"></div>
            <div style="padding:10px">
                <button class="btn btn-primary btn-lg btn-block" type="button" id="ModifyPassword">修改密码</button>
            </div>
        </div>
        <script type="text/javascript" src="/static/js/jquery.min.js"></script>
        <script type="text/javascript" src="/static/js/jquery.cookie.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#ModifyPassword").click(function(){
                    var oldpassword = $("#oldpassword").val();
                    var password = $("#password").val();
                    var password2 = $("#password2").val();
                    if(oldpassword===''){
                        alert("请输入原密码");
                        return false;
                    }
                    if(password===''){
                        alert("请输入新密码。")
                        return false;
                    }
                    if(password2!==password){
                        alert("两次输入的新密码不一致，请核对！");
                        return false;
                    }
                    $.post("/index/erp/ModifyPasswordAction",{
                        oldpassword:oldpassword,
                        password:password
                    },function(res){
                        //console.log(res);
                        if(res.info==='ok'){
                            location.href = "/index/erp";
                        }else{
                            alert(res.info);
                        }
                    },'json');
                });
            });
        </script>
    </body>
</html>
