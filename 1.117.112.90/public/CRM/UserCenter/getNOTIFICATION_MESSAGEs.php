<?php
    //获取消息列表
    session_start();
    if($_SESSION['openid']==""){exit;}
    require_once dirname(__FILE__) .'/../control/pdo.php';
    $pageSize = Q($_POST["pageSize"]);
    $pageNow = Q($_POST["pageNow"]);
    $count_ = getOne("SELECT count(1) FROM `NOTIFICATION_MESSAGE` where OPENID='".$_SESSION['openid']."'");
    if($count_=='0'){
        $maxpage = 1;
    }else{
        $maxpage = ceil($count_/$pageSize);
    }
    if($pageNow>$maxpage){
        $pageNow = $maxpage;
    }
    $start=($pageNow-1)*$pageSize;
    class resobj{}
    $NOTIFICATION_MESSAGEs = pdoquery("SELECT * FROM `NOTIFICATION_MESSAGE` where OPENID='".$_SESSION['openid']."' order by NOTIFICATION_TIME desc LIMIT $start,$pageSize");
    $ro = new resobj();
    $ro->list_ = $NOTIFICATION_MESSAGEs;
    
    $ro->count_ = $count_;
    $ro->pageSize = $pageSize;
    $ro->pageNow = $pageNow;
    $ro->maxpage = $maxpage;
    $ro->idf = "NOTIFICATION_MESSAGE_ID";
    echo json_encode($ro);