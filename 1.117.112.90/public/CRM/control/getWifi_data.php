<?php
    require_once dirname(__FILE__) .'/pdo.php';
    $wifi_datas = pdoquery("select * from wifi_data where GET_RESULTS='获取成功' order by CREATION_TIME desc limit 50");
    echo json_encode($wifi_datas);