<?php

include $_SERVER['DOCUMENT_ROOT'].'/UIUE/weixin/comm/weixin.qy.class.php';

$jssdk = new weixinTool();

$data = '{
    "button": [
                {
                    "type": "view",
                    "name": "移动执法",
                    "url": "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx6cef84f58fcf615d&redirect_uri=http%3A%2F%2Fneu.wangzhi81.com%2FUIUE%2Fweixin%2FyidongQy%2Flingdao%2Flingdao.php&response_type=code&scope=snsapi_base&state=STATE#wechat_redirect"
                }
        }';



echo $jssdk->deleteMenu();

//echo $jssdk->createMenu($data);

//echo $jssdk->getMenu();

?>