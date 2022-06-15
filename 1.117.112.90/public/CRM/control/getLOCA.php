<?php
    require_once dirname(__FILE__) .'/pdo.php';
    
    class requestdata{}
    class yuan{}
    class Grid{}
    
    $MESSAGE_CONTENT = "S168#561118010016494#16f4#00ea#LOCA:W;CELL:4,1cc,0,4106,2ad2,5,4106,9edf,5,4106,2af0,b,4106,2757,14;GDATA:V,0,170909041614,0.000000,0.000000,0,0,0;ALERT:0000;STATUS:66,83;WIFI:4,c4-36-55-00-84-3c,-92,08-10-79-a6-97-fe,-88,f4-ee-14-37-21-76,-88,24-69-68-d9-2d-e4,-42$";
    
    echo json_encode(lbsLoca($MESSAGE_CONTENT));
    
    function lbsLoca($str){
        $STATUS = explode("CELL:",$str);
        $STATUS = explode(";",$STATUS[1]);
        $STATUS = explode(",",$STATUS[0]);
        $MNC = hexdec($STATUS[2]);
        
        $yuans = array();
        for($i=3;$i<count($STATUS);$i+=3){
            $CELL_ID = hexdec($STATUS[$i+1]);
            $LAC = hexdec($STATUS[$i]);
            $SIGNAL_INTENSITY = hexdec($STATUS[$i+2]);
            $SIGNAL_INTENSITY = 1700-(30*$SIGNAL_INTENSITY);
            $BASE_STATION_DATAs = pdoquery("select * from BASE_STATION_DATA where CELL_ID='$CELL_ID' and LAC='$LAC' and MNC='$MNC' and GET_RESULTS='获取成功'");
            foreach ($BASE_STATION_DATAs as $key => $value) {
                $ge = geoconv5to6($value['B_LONGITUDE'],$value['B_LATITUDE']);
                $yuan = new yuan;
                $yuan->B_LONGITUDE =  $value['B_LONGITUDE'];
                $yuan->B_LATITUDE =  $value['B_LATITUDE'];
                $yuan->x = $ge->result[0]->x;
                $yuan->y = $ge->result[0]->y;
                $yuan->Distance = $SIGNAL_INTENSITY;
                array_push($yuans,$yuan);
            }
        }
        //delFarPoint($yuans);
        
        $wifiys  = wifiLoca($str);
        for($i=0;$i<count($wifiys);$i++){
            $wifiys[$i]->d = 0;
            for($ii=0;$ii<count($yuans);$ii++){
                $wifiys[$i]->d += sqrt(pow($wifiys[$i]->x-$yuans[$ii]->x,2)+pow($wifiys[$i]->y-$yuans[$ii]->y,2));
            }
        }
        $wifi_min_i = 0;
        $wifi_min_d = $wifiys[0]->d;
        if(count($wifiys)>=2){
            for($i=1;$i<count($wifiys);$i++){
                if($wifi_min_d>$wifiys[$i]->d){
                    $wifi_min_d = $wifiys[$i]->d;
                    $wifi_min_i = $i;
                }
            }
        }
        //$pp = geoconv6to5($wifiys[$wifi_min_i]->x,$wifiys[$wifi_min_i]->y);
        //echo json_encode($pp);
        //return $pp->result[0];
        $pp = new yuan;
        $pp->x = $wifiys[$wifi_min_i]->B_LONGITUDE;
        $pp->y = $wifiys[$wifi_min_i]->B_LATITUDE;
        $pp->lbs = $yuans;
        $pp->wifi = $wifiys;
        
        $Gridss = array();
        $gminx = $yuans[0]->x-$yuans[0]->Distance;
        $gmaxx = $yuans[0]->x+$yuans[0]->Distance;
        $gminy = $yuans[0]->y-$yuans[0]->Distance;
        $gmaxy = $yuans[0]->y+$yuans[0]->Distance;
        for($i=$gminx;$i<$gmaxx;$i+=50){
            for($ii=$gminy;$ii<$gmaxy;$ii+=50){
                $Grid = new Grid;
                $Grid->x = $i;
                $Grid->y = $ii;
                $Grid->Weight = 0;
                foreach ($yuans as $key => $value) {
                    $Distances = sqrt(pow($value->x-$Grid->x,2)+pow($value->y-$Grid->y,2));
                    if($Distances<=$value->Distance){
                        $Grid->Weight++;
                    }
                }
                array_push($Gridss,$Grid);
            }
        }
        $gwmax = 0;
        foreach ($Gridss as $key => $value) {
            if($gwmax<$value->Weight){
                $gwmax = $value->Weight;
            }
        }
        $Grids = array();
        foreach ($Gridss as $key => $value) {
            if($value->Weight==$gwmax){
                $ge = geoconv6to5($value->x,$value->y);
                $value->x = $ge->result[0]->x;
                $value->y = $ge->result[0]->y;
                array_push($Grids,$value);
            }
        }
        $pp->Grids = $Grids;
        return $pp;
    }
    
    function wifiLoca($str){
        $WIFIs = explode("WIFI:",str_replace('$','',$str));
        $WIFIs = explode(";",$WIFIs[1]);
        $WIFIs = explode(",",$WIFIs[0]);
        $yuans = array();
        for($i=1;$i<count($WIFIs);$i+=2){
            //echo $WIFIs[$i];
            $yuan = new yuan;
            $WIFI_DATA = getRow("select * from WIFI_DATA where MAC_ADDRESS='".$WIFIs[$i]."'");
            $ge = geoconv5to6($WIFI_DATA['B_LONGITUDE'],$WIFI_DATA['B_LATITUDE']);
            $yuan->B_LONGITUDE =  $WIFI_DATA['B_LONGITUDE'];
            $yuan->B_LATITUDE =  $WIFI_DATA['B_LATITUDE'];
            if($ge->result[0]->x != null){
                $yuan->x = $ge->result[0]->x;
                $yuan->y = $ge->result[0]->y;
                $yuan->d = $WIFIs[$i+1];
                array_push($yuans,$yuan);
            }
        }
        return $yuans;
    }
    
    function geoconv5to6($longitude,$latitude){
        $geoconv = httpGet("http://api.map.baidu.com/geoconv/v1/?coords=".$longitude.",".$latitude."&from=5&to=6&ak=5QUV6G5DqeH7ljQ8iGOnYOcc");
        $result = json_decode($geoconv);
        return $result;
    }
    
    function geoconv6to5($longitude,$latitude){
        $geoconv = httpGet("http://api.map.baidu.com/geoconv/v1/?coords=".$longitude.",".$latitude."&from=6&to=5&ak=5QUV6G5DqeH7ljQ8iGOnYOcc");
        $result = json_decode($geoconv);
        return $result;
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