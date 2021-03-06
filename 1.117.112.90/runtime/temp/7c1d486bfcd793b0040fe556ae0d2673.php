<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:80:"/www/wwwroot/erp.wangzhi81.com/public/../application/index/view/index/login.html";i:1518847648;}*/ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="stylesheet" type="text/css" href="/static/css/bootstrap.min.css?v=0.1" />
        <link rel="stylesheet" type="text/css" href="/static/css/loading.css?v=0.3" />
        <link rel="stylesheet" type="text/css" href="/static/css/weixin/login.css?v=0.5" />
        <title>微信登录</title>
    </head>
    <body>
        <input type="hidden" id="LOGIN_VERIFICATION_NOTE_ID" value="<?php echo $LOGIN_VERIFICATION_NOTE_ID; ?>">
        <div id="Loading" class="text-center">
            <p>正在读取……</p>
        </div>
        <div class="MainDiv" id="MainDiv">
            <div class="logoImgDiv">
                <img id="logoImg" class="center-block" width="200px" src="/static/img/Partner.png?v=0.1">
            </div>
            <div class="text-center">
                <p>移宽合伙人</p>
                <hr>
            </div>
            <div class="Tips">
                <p class="Bold">即将登陆移宽合伙人，请确认是本人操作</p>
                <ul>
                    <li>使用你的账号登录</li>
                </ul>
            </div>
            <div class="Buttons" id="Buttons">
                <button type="button" class="btn btn-success btn-lg btn-block" id="ConfirmLogin">确认登录</button>
                <button type="button" class="btn btn-default btn-lg btn-block" id="Cancel">取消</button>
            </div>
        </div>
        <script data-main="/static/js/weixin/login.js?v=2" src="/static/js/require.min.js"></script>
    </body>
</html>
