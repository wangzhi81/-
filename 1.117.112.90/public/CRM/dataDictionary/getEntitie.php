<?php
    session_start();
    if($_SESSION['openid']==""){exit;}
    //保存实体
    require_once dirname(__FILE__) .'/../control/pdo.php';
    $ENTITY_UUID = Q($_POST['ENTITY_UUID']);
    echo json_encode(pdoquery("SELECT * FROM `entity` where ENTITY_UUID='$ENTITY_UUID'"));
?>