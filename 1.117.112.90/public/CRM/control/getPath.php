<?php
    require_once dirname(__FILE__) .'/pdo.php';
    $DEVICE_ID = Q($_POST['DEVICE_ID']);
    $DEVICE_TRAJECTORYs = pdoquery("select * from DEVICE_TRAJECTORY where DEVICE_ID='$DEVICE_ID' order by TRAJECTORY_TIME desc limit 50");
    echo json_encode($DEVICE_TRAJECTORYs);