<?php
    session_start();
    include '../control/weixin.qy.class.php';
    require_once dirname(__FILE__) .'/../control/pdo.php';
    $wxtool = new weixinTool();
    $userid = $wxtool->getUseridByOpenid($_SESSION['openid']);
    $userinfo = $wxtool->getUserInfoByUserid($userid);
    if($userinfo['name']!=""){
        echo "ok";
    };
?>