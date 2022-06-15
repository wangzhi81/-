<?php
    session_start();
    include '../control/weixin.class.php';
    require_once dirname(__FILE__) .'/../control/pdo.php';
    $wxtool = new weixinTool();
    //$signPackage = $wxtool->getSignPackage();
    $openid = $wxtool->GetOpenid();
    if($openid==""){
        header("Location:Unauthorized.php");
    }
    $_SESSION["openid"] = $openid;
?>
<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>登录</title>
    <link rel="stylesheet" href="../css/weui.min.css"/>
    <link rel="stylesheet" href="../css/example.css"/>
</head>
<body ontouchstart>
    <div class="page msg_success js_show">
        <div class="weui-msg">
            <div class="weui-msg__icon-area"><i class="weui-icon-info weui-icon_msg"></i></div>
            <div class="weui-msg__text-area">
                <h2 class="weui-msg__title">登录</h2>
                <p class="weui-msg__desc">是否要登录到IT解决方案行业CRM管理系统？</a></p>
                <p class="weui-msg__desc"><?php echo $_SESSION["LOGIN_VERIFICATION_NOTE_ID"];?></a></p>
            </div>
            <div class="weui-msg__opr-area">
                <p class="weui-btn-area">
                    <a href="javascript:history.back();" class="weui-btn weui-btn_primary" id="Confirmlogin">确认登录</a>
                </p>
            </div>
            <div class="weui-msg__extra-area">
                <div class="weui-footer">
                    <p class="weui-footer__links">
                        <a href="javascript:void(0);" class="weui-footer__link">东软环保团队</a>
                    </p>
                    <p class="weui-footer__text">Copyright © 2008-2017 NET</p>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/zepto.min.js"></script>
    <script type="text/javascript" src="../js/jweixin-1.0.0.js"></script>
    <script src="../js/weui.min.js"></script>
    <script type="text/javascript">
        
        $(function(){
            $("#Confirmlogin").click(function(){
                $.post("loginaction.php",{
                    
                },function(data){
                    if(data!=""){
                        alert(data);
                    }else{
                        location.href="Sentsuccessfully.php";
                    }
                });
            });
        });
    </script>
</body>
</html>