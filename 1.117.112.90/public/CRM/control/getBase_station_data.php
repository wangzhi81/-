<?php
    require_once dirname(__FILE__) .'/pdo.php';
    $base_station_datas = pdoquery("select * from base_station_data where GET_RESULTS='获取成功' order by CREATION_TIME desc limit 500");
    echo json_encode($base_station_datas);