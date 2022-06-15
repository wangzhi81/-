<?php
    //获取消息列表
    session_start();
    if($_SESSION['openid']==""){exit;}
    require_once dirname(__FILE__) .'/../control/pdo.php';
    $pageSize = Q($_POST["pageSize"]);
    $pageNow = Q($_POST["pageNow"]);
    $count_ = getOne("SELECT count(1) FROM `ORDER_LIST`");
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
    $ORDER_LISTs = pdoquery("SELECT * FROM `ORDER_LIST` order by ORDER_DATE desc LIMIT $start,$pageSize");
    $ro = new resobj();
    $ro->list_ = $ORDER_LISTs;
    
    $ro->count_ = $count_;
    $ro->pageSize = $pageSize;
    $ro->pageNow = $pageNow;
    $ro->maxpage = $maxpage;
    $ro->idf = "ORDER_LIST_ID";
    echo json_encode($ro);