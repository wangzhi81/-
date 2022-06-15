<?php
    include '../control/weixin.qy.class.php';
    $wxtool = new weixinTool();
    $signPackage = $wxtool->getSignPackage();
?>
<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>发送登录请求成功</title>
    <link rel="stylesheet" href="../css/weui.min.css"/>
    <link rel="stylesheet" href="../css/example.css"/>
</head>
<body ontouchstart>
    <div class="page msg_success js_show">
        <div class="weui-msg">
            <div class="weui-msg__icon-area"><i class="weui-icon-success weui-icon_msg"></i></div>
            <div class="weui-msg__text-area">
                <h2 class="weui-msg__title">发送登录请求成功</h2>
                <p class="weui-msg__desc">请在系统中操作</a></p>
            </div>
            <div class="weui-msg__opr-area">
                <p class="weui-btn-area">
                    <a href="#" class="weui-btn weui-btn_primary" style="display:none" id="Shutdown">关闭</a>
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
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script src="../js/weui.min.js"></script>
    <script type="text/javascript">
        var appId= '<?php echo $signPackage["appId"];?>';
        var timestamp= <?php echo $signPackage["timestamp"];?>;
        var nonceStr='<?php echo $signPackage["nonceStr"];?>';
        var signature= '<?php echo $signPackage["signature"];?>';
        wx.config({
            debug: false,
            appId: appId,
            timestamp: timestamp,
            nonceStr: nonceStr,
            signature: signature,
            jsApiList: [
            // 所有要调用的 API 都要加到这个列表中
            'closeWindow'
            ]
        });
        wx.ready(function(){
            $('#Shutdown').click(function(){
                wx.closeWindow();
            });
            $("#Shutdown").show();
        });
        $(function(){
        });
    </script>
</body>
</html>