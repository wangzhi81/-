<?php
    session_start();
    if($_SESSION['openid']==""){exit;}
    //删除实体
    require_once dirname(__FILE__) .'/../control/pdo.php';
    $ENTITY_UUID = Q($_POST['ENTITY_UUID']);
    $ENTITY_CODE = getOne("select ENTITY_CODE from entity where ENTITY_UUID='$ENTITY_UUID'");
    pdoexec("DROP TABLE $ENTITY_CODE");
    pdoexec("delete from entity where ENTITY_UUID = '$ENTITY_UUID'");
    
?>