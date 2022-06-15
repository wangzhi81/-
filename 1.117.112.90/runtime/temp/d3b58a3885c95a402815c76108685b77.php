<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:80:"/www/wwwroot/erp.wangzhi81.com/public/../application/admin/view/index/login.html";i:1507697954;}*/ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link href="/favicon.ico?v=0.1" rel="shortcut icon" />
        <link rel="stylesheet" type="text/css" href="/static/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="/static/css/login.css?v=0.2" />
        <link rel="stylesheet" type="text/css" href="/static/css/loading.css?v=0.2" />
        <title>微信登录</title>
    </head>
        
    <body>
        <input type="hidden" id="LOGIN_VERIFICATION_NOTE_ID" value="<?php echo $LOGIN_VERIFICATION_NOTE_ID; ?>">
        <div class="impowerBox">
            <div class="title">微信登录</div>
            <div>
                <img class="qrcode" src="<?php echo $qrCode; ?>">
            </div>
            <div class="status_browser">
                <p>请使用微信扫描二维码登录</p>
                <p>"移宽合伙人"</p>
            </div>
        </div>
        <script data-main="/static/js/login.js?v=0.6" src="/static/js/require.min.js"></script>
    </body>
</html>
