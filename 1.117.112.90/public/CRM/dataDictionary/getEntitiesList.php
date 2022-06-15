<?php
    session_start();
    if($_SESSION['openid']==""){exit;}
    //保存实体
    require_once dirname(__FILE__) .'/../control/pdo.php';
    echo json_encode(pdoquery("SELECT * FROM `entity` order by MODIFICATION_TIME desc LIMIT 500"));
?>