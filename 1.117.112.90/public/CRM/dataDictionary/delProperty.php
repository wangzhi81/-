<?php
    session_start();
    if($_SESSION['openid']==""){exit;}
//删除属性
require_once dirname(__FILE__) .'/../control/pdo.php';
$ATTRIBUTE_UUID = Q($_POST['ATTRIBUTE_UUID']);
$ENTITY_UUID = Q($_POST['ENTITY_UUID']);
$ENTITY_CODE = getOne("SELECT ENTITY_CODE FROM `entity` WHERE `ENTITY_UUID` = '".$ENTITY_UUID."'");
$FIELD_CODE = getOne("SELECT FIELD_CODE FROM `attribute` WHERE `ATTRIBUTE_UUID` = '".$value['$ATTRIBUTE_UUID']."'");
pdoexec("ALTER TABLE ".$ENTITY_CODE." DROP ".$FIELD_CODE);
pdoexec("delete from attribute where ATTRIBUTE_UUID='$ATTRIBUTE_UUID'");