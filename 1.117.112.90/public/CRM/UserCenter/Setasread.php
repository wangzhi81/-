<?php
    //设置为已读
    session_start();
    if($_SESSION['openid']==""){exit;}
    require_once dirname(__FILE__) .'/../control/pdo.php';
    $NOTIFICATION_MESSAGE_ID = Q($_POST['NOTIFICATION_MESSAGE_ID']);
    pdoexec("update NOTIFICATION_MESSAGE set WHETHER_READ='已读' where NOTIFICATION_MESSAGE_ID='$NOTIFICATION_MESSAGE_ID'");