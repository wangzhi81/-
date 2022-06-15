<?php

include $_SERVER['DOCUMENT_ROOT'].'/UIUE/weixin/comm/weixin.class.php';

$jssdk = new weixinTool();

$data = '{
    "button": [
                {
                    "type": "view",
                    "name": "业务办理",
                    "url": "http://neu.wangzhi81.com/UIUE/weixin/home.php"
                },
                {
                    "name": "危废转移",
                    "sub_button": [
                        {
                            "type": "view",
                            "name": "转运处理",
                            "url": "http://neu.wangzhi81.com/UIUE/weixin/SingleScanReg.php"
                        },
                        {
                            "type": "view",
                            "name": "转运跟踪",
                            "url": "http://neu.wangzhi81.com/UIUE/weixin/SingleQuery.php"
                        }
                    ]
                },
                {
                    "type": "view",
                    "name": "个人中心",
                    "url": "http://neu.wangzhi81.com/UIUE/weixin/"
                }
            ]
        }';



echo $jssdk->deleteMenu();

echo $jssdk->createMenu($data);

echo $jssdk->getMenu();

?>