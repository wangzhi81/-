<?php
    //获取基站wifi坐标，以及坐标转换
    require_once dirname(__FILE__) .'/pdo.php';
    class requestdata{}
    $BASE_STATION_DATAs = pdoquery("select * from BASE_STATION_DATA where ACQUISITION_TIME is null order by CREATION_TIME limit 1");
    foreach ($BASE_STATION_DATAs as $key => $value) {
        $BASE_STATION_DATA_ID = $value['BASE_STATION_DATA_ID'];
        $CELL_ID_ = $value['CELL_ID'];
        $LAC_ = $value['LAC'];
        $MNC_ = $value['MNC'];
        $lbsobj = getlbs($CELL_ID_,$LAC_,$MNC_);
        var_dump($lbsobj);
        if(!empty($lbsobj)){
            //WritingLog($lbsobj);
            if($lbsobj->msg=="ok"){
                $geoconv = geoconv($lbsobj->result->lng,$lbsobj->result->lat);
                //WritingLog($geoconv);
                //var_dump($geoconv);
                pdoexec("update BASE_STATION_DATA set ACQUISITION_TIME=now(),GET_RESULTS='获取成功',LONGITUDE='".$lbsobj->result->lng."',LATITUDE='".$lbsobj->result->lat."',B_LONGITUDE='".$geoconv->result[0]->x."',B_LATITUDE='".$geoconv->result[0]->y."',ADDRESS='".$lbsobj->result->addr."',ACCURACY='".$lbsobj->result->accuracy."' where BASE_STATION_DATA_ID='$BASE_STATION_DATA_ID'");
                echo $lbsobj->result->addr;
            }else if($lbsobj->status=="210"){
                pdoexec("update BASE_STATION_DATA set ACQUISITION_TIME=now(),GET_RESULTS='".$lbsobj->msg."' where BASE_STATION_DATA_ID='$BASE_STATION_DATA_ID'");
            }
            //
        }
    }
    
    $WIFI_DATA = pdoquery("select * from WIFI_DATA where ACQUISITION_TIME is null order by CREATION_TIME limit 1");
    foreach ($WIFI_DATA as $key => $value) {
        $WIFI_DATA_ID = $value['WIFI_DATA_ID'];
        $MAC_ADDRESS = $value['MAC_ADDRESS'];
        $requestdata = new requestdata;
        $requestdata->mac_address = $MAC_ADDRESS;
        $requestdata->singal_strength = 8;
        $requestdata->age = 0;
        $ra = array();
        array_push($ra,$requestdata);
        $WifiData = LocationByWifiData(json_encode($ra));
        //WritingLog($WifiData);
        $resstr = substr($WifiData,strpos($WifiData,"{"));
        $resObj = json_decode($resstr);
        if($resObj->ErrCode=="4"){
            pdoexec("update WIFI_DATA set ACQUISITION_TIME=now(),GET_RESULTS='没有查询到结果' where MAC_ADDRESS='$MAC_ADDRESS'");
        }else if($resObj->ErrCode=="0"){
            $geoconv = httpGet("http://api.map.baidu.com/geoconv/v1/?coords=".$resObj->location->longitude.",".$resObj->location->latitude."&from=3&to=5&ak=5QUV6G5DqeH7ljQ8iGOnYOcc");
            $result = json_decode($geoconv);
            echo json_encode($resObj->location->accuracy);
            pdoexec("update WIFI_DATA set ACQUISITION_TIME=now(),GET_RESULTS='获取成功',LONGITUDE='".$resObj->location->longitude."',LATITUDE='".$resObj->location->latitude."',B_LONGITUDE='".$result->result[0]->x."',B_LATITUDE='".$result->result[0]->y."',ACCURACY='".$resObj->location->accuracy."',ADDRESS='".$resObj->location->addressDescription."' where MAC_ADDRESS='$MAC_ADDRESS'");
        }
    }
    
    $BASE_STATION_DATAs = pdoquery("select * from BASE_STATION_DATA where BM_LONGITUDE ='' and B_LONGITUDE<>'' order by CREATION_TIME limit 1");
    foreach ($BASE_STATION_DATAs as $key => $value) {
        $geoconv = geoconv5to6($value['B_LONGITUDE'],$value['B_LATITUDE']);
        //echo json_encode($geoconv);
        pdoexec("update BASE_STATION_DATA set BM_LONGITUDE='".$geoconv->result[0]->x."',BM_LATITUDE='".$geoconv->result[0]->y."' where BASE_STATION_DATA_ID='".$value['BASE_STATION_DATA_ID']."'");
    }
    
    $WIFI_DATAs = pdoquery("select * from WIFI_DATA where BM_LONGITUDE ='' and B_LONGITUDE<>'' order by CREATION_TIME limit 1");
    foreach ($WIFI_DATAs as $key => $value) {
        $geoconv = geoconv5to6($value['B_LONGITUDE'],$value['B_LATITUDE']);
        echo json_encode($geoconv);
        pdoexec("update WIFI_DATA set BM_LONGITUDE='".$geoconv->result[0]->x."',BM_LATITUDE='".$geoconv->result[0]->y."' where WIFI_DATA_ID='".$value['WIFI_DATA_ID']."'");
    }
    
    
    function LocationByWifiData($querys){
        $host = "http://wifi.market.alicloudapi.com";
        $path = "/api/LocationByWifiData";
        $method = "GET";
        $appcode = "971445c3542343599b0a5d310476165e";
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $bodys = "";
        $querys ="requestdata=".urlencode($querys);
        //WritingLog($querys);
        $url = $host . $path . "?" . $querys;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        return curl_exec($curl);
    }
    
    function geoconv($longitude,$latitude){
        $geoconv = httpGet("http://api.map.baidu.com/geoconv/v1/?coords=".$longitude.",".$latitude."&from=1&to=5&ak=5QUV6G5DqeH7ljQ8iGOnYOcc");
        $result = json_decode($geoconv);
        return $result;
    }
    
    function geoconv5to6($longitude,$latitude){
        $geoconv = httpGet("http://api.map.baidu.com/geoconv/v1/?coords=".$longitude.",".$latitude."&from=5&to=6&ak=5QUV6G5DqeH7ljQ8iGOnYOcc");
        $result = json_decode($geoconv);
        return $result;
    }
    
    function WritingLog($dataRes){
        date_default_timezone_set('Asia/Shanghai'); 
        file_put_contents(dirname(__FILE__)."/logs/lbslog".date('Ymd').".log", date('Y-m-d H:i:s')." ".json_encode($dataRes)."\n",FILE_APPEND);
    }
    
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
    
    function getlbs($cell_id,$lac,$mnc){
        $host = "http://aliapi64.jisuapi.com";
        $path = "/cell/query";
        $method = "GET";
        $appcode = "971445c3542343599b0a5d310476165e";
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "cellid=$cell_id&lac=$lac&mnc=$mnc&nid=nid&sid=sid";
        $bodys = "";
        $url = $host . $path . "?" . $querys;
    
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        $lbs = curl_exec($curl);
        //WritingLog($lbs);
        $resstr = substr($lbs,strpos($lbs,"{"));
        $resobj = json_decode($resstr);
        return $resobj;
    }
?>