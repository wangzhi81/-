<?php
    //获取消息数量
    session_start();
    if($_SESSION['openid']==""){exit;}
    require_once dirname(__FILE__) .'/../control/pdo.php';
    $count_ = getOne("SELECT count(1) FROM `NOTIFICATION_MESSAGE` where OPENID='".$_SESSION['openid']."' and WHETHER_READ='未读'");
    echo $count_;