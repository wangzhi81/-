<?php
    session_start();
    if($_SESSION['openid']==""){exit;}
    //保存实体
    require_once dirname(__FILE__) .'/../control/pdo.php';
    $stmc = Q($_POST['stmc']);
    $stsm = Q($_POST['stsm']);
    $stdm = Q($_POST['stdm']);
    pdoexec("insert into entity(ENTITY_UUID,ENTITY_NAME,ENTITY_CODE,ENTITY_DESCRIPTION,MODIFICATION_TIME) values(uuid(),'$stmc','$stdm','$stsm',now())");
    pdoexec("CREATE TABLE `$stdm` (
  `".$stdm."_ID` varchar(50) NOT NULL DEFAULT '',
  `delete_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`".$stdm."_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=gbk COMMENT='$stsm';");
    //echo $stmc;
?>