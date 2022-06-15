<?php
    //lbs+wifi定位算法
    require_once dirname(__FILE__) .'/pdo.php';
    class Point{}
    class Grid{}
    $MESSAGE_CONTENT = "S168#561118010016494#15f4#011d#LOCA:W;CELL:6,1cc,0,4106,364f,c,4107,2eff,10,4107,34a0,12,4107,2f1e,15,4107,2f1d,18,4107,349f,1a;GDATA:V,0,170909001912,0.000000,0.000000,0,0,0;ALERT:0000;STATUS:96,100;WIFI:5,00-34-fe-53-3c-94,-95,dc-fe-18-d5-ac-1a,-90,fc-d7-33-a9-3a-28,-88,d0-fa-1d-bd-da-27,-88,d0-fa-1d-c5-11-96,-44$";
    
    $Points = getLbs($MESSAGE_CONTENT);
    $wifis = getwifi($MESSAGE_CONTENT);
    foreach ($wifis as $key => $value) {
        array_push($Points,$value);
    }
    
    echo json_encode(calculation($Points));
    
    //计算可能的点位
    function calculation($Points){
        if(count($Points)>0){
            $Origin = new Point;
            $Origin = $Points[0];
            $gminx = $Origin->x-$Origin->d;
            $gmaxx = $Origin->x+$Origin->d;
            $gminy = $Origin->y-$Origin->d;
            $gmaxy = $Origin->y+$Origin->d;
            $Gridss = array();
            $maxw = 0;
            for($i=$gminx;$i<$gmaxx;$i+=50){
                for($ii=$gminy;$ii<$gmaxy;$ii+=50){
                    $Grid = new Grid;
                    $Grid->x = $i;
                    $Grid->y = $ii;
                    $Grid->w = 0;
                    foreach ($Points as $key => $value) {
                        $Distances = sqrt(pow($value->x-$Grid->x,2)+pow($value->y-$Grid->y,2));
                        if($Distances<=$value->d){
                            $Grid->w++;
                        }
                    }
                    if($maxw<$Grid->w){
                        $maxw = $Grid->w;
                    }
                    array_push($Gridss,$Grid);
                }
            }
            $resGrids = array();
            $coords = "";
            $i = 0;
            foreach ($Gridss as $key => $value) {
                if($value->w==$maxw){
                    array_push($resGrids,$value);
                    if($i==0){
                        $coords .= $value->x.",".$value->y;
                    }else{
                        $coords .= ";".$value->x.",".$value->y;
                    }
                    $i++;
                }
            }
            $geoc = geoconv6to5s($coords);
            return $geoc->result;
        }
    }
    
    //解析基站数据
    function getLbs($str){
        $STATUS = explode("CELL:",$str);
        $STATUS = explode(";",$STATUS[1]);
        $STATUS = explode(",",$STATUS[0]);
        $MNC = hexdec($STATUS[2]);
        $Points = array();
        for($i=3;$i<count($STATUS);$i+=3){
            $CELL_ID = hexdec($STATUS[$i+1]);
            $LAC = hexdec($STATUS[$i]);
            $SIGNAL_INTENSITY = hexdec($STATUS[$i+2]);
            $SIGNAL_INTENSITY = 1700-(30*$SIGNAL_INTENSITY);
            $BASE_STATION_DATAs = pdoquery("select * from BASE_STATION_DATA where CELL_ID='$CELL_ID' and LAC='$LAC' and MNC='$MNC' and GET_RESULTS='获取成功'");
            foreach ($BASE_STATION_DATAs as $key => $value) {
                $Point = new Point;
                $Point->x = $value['BM_LONGITUDE'];
                $Point->y = $value['BM_LATITUDE'];
                $Point->d = $SIGNAL_INTENSITY;
                array_push($Points,$Point);
            }
        }
        return $Points;
    }
    
    function getwifi($str){
        $WIFIs = explode("WIFI:",str_replace('$','',$str));
        $WIFIs = explode(";",$WIFIs[1]);
        $WIFIs = explode(",",$WIFIs[0]);
        $Points = array();
        for($i=1;$i<count($WIFIs);$i+=2){
            $WIFI_DATAs = pdoquery("select * from WIFI_DATA where MAC_ADDRESS='".$WIFIs[$i]."' and GET_RESULTS='获取成功'");
            foreach ($WIFI_DATAs as $key => $value) {
                $Point = new Point;
                $Point->x = $value['BM_LONGITUDE'];
                $Point->y = $value['BM_LATITUDE'];
                $Point->d = 50;
                array_push($Points,$Point);
            }
        }
        return $Points;
    }
    
    function geoconv6to5s($coords){
        $geoconv = httpGet("http://api.map.baidu.com/geoconv/v1/?coords=".$coords."&from=6&to=5&ak=5QUV6G5DqeH7ljQ8iGOnYOcc");
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