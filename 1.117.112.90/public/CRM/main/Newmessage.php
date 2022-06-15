<?php
    //新消息数量查询
    session_start();
    if($_SESSION['openid']==""){exit;}
    require_once dirname(__FILE__) .'/../control/pdo.php';
    echo getOne("SELECT count(1) FROM `NOTIFICATION_MESSAGE` where OPENID='".$_SESSION['openid']."'");