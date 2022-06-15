<?php
    $x = $_POST['x'];
    $y = $_POST['y'];
    $result = json_decode(httpGet("http://api.map.baidu.com/geoconv/v1/?coords=".$x.",".$y."&from=1&to=5&ak=5QUV6G5DqeH7ljQ8iGOnYOcc"));
    echo json_encode($result->result[0]);
    function httpGet($url) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_URL, $url);
        $res = curl_exec($curl);
        curl_close($curl);
        return $res;
    }