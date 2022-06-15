<?php
    session_start();
    if($_SESSION['openid']==""){exit;}
    //更新实体
    require_once dirname(__FILE__) .'/../control/pdo.php';
    $ENTITY_UUID = Q($_POST['ENTITY_UUID']);
    $ENTITY_NAME = Q($_POST['ENTITY_NAME']);
    $ENTITY_CODE = Q($_POST['ENTITY_CODE']);
    $ENTITY_DESCRIPTION = Q($_POST['ENTITY_DESCRIPTION']);
    pdoquery("update entity set ENTITY_NAME='$ENTITY_NAME',ENTITY_CODE='$ENTITY_CODE',ENTITY_DESCRIPTION='$ENTITY_DESCRIPTION',MODIFICATION_TIME=now() where ENTITY_UUID='$ENTITY_UUID'");
?>