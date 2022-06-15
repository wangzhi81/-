<?php
    class requestdata{}
    class yuan{}
    class Point{}
    class Grid{}
    class obj{}
    
    //删除集合中较远的点位
    function delFarPoint(&$arr){
        for($i=0;$i<count($arr);$i++){
            $arr[$i]->Distances = 0;
            for($ii=0;$ii<count($arr);$ii++){
                $arr[$i]->Distances += sqrt(pow($arr[$i]->x-$arr[$ii]->x,2)+pow($arr[$i]->y-$arr[$ii]->y,2));
            }
        }
        $max_d = 0;
        $max_i = 0;
        for($i=0;$i<count($arr);$i++){
            if($max_d<$arr[$i]->Distances){
                $max_d = $arr[$i]->Distances;
                $max_i = $i;
            }
        }
        array_remove($arr,$max_i);
    }
    
    //补充wifi
    function addWifi($MESSAGE_CONTENT){
        $wifis = explode("WIFI",$MESSAGE_CONTENT);
        $wifiss = explode(",",str_replace('$','',$wifis[1]));
        for ($i= 1;$i< count($wifiss); $i++){
            if(($i%2)==1){
                if(!isExist("WIFI_DATA","MAC_ADDRESS='".$wifiss[$i]."'")){
                    pdoexec("insert into WIFI_DATA(WIFI_DATA_ID,MAC_ADDRESS,CREATION_TIME) values(uuid(),'".$wifiss[$i]."',now())");
                }
            }
        }
    }
    
    //取状态位
    function getS168Status($str){
        $STATUS = explode("STATUS:",$str);
        $STATUS = explode(";",$STATUS[1]);
        $STATUS = explode(",",$STATUS[0]);
        return $STATUS[0];
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
                $yuan->strength = $WIFIs[$i+1];
                array_push($yuans,$yuan);
            }
        }
        return $yuans;
    }
    
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
            $SIGNAL_INTENSITY = pow(10,((100-$SIGNAL_INTENSITY)/(10*3.25)));
            $BASE_STATION_DATAs = pdoquery("select * from BASE_STATION_DATA where CELL_ID='$CELL_ID' and LAC='$LAC' and MNC='$MNC' and GET_RESULTS='获取成功'");
            foreach ($BASE_STATION_DATAs as $key => $value) {
                $ge = geoconv5to6($value['B_LONGITUDE'],$value['B_LATITUDE']);
                $yuan = new yuan;
                $yuan->B_LONGITUDE =  $value['B_LONGITUDE'];
                $yuan->B_LATITUDE =  $value['B_LATITUDE'];
                $yuan->x = $ge->result[0]->x;
                $yuan->y = $ge->result[0]->y;
                $yuan->Distance = $SIGNAL_INTENSITY;
                $yuan->strength = hexdec($STATUS[$i+2]);
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
        if($pp->x==null){
            if(count($yuans)>=3){
                $p = GetPiontByThree($yuans[0],$yuans[1],$yuans[2]);
                $pg = geoconv6to5($p->x,$p->y);
                $pp = $pg->result[0];
            }
        }
        $pp->lbs=$yuans;
        $pp->wifi=$wifiys;
        $pp->time_ = date("Y-m-d H:i:s");
        return $pp;
    }
    
    function array_remove(&$arr, $offset)
    {
        array_splice($arr, $offset, 1);
    }
    
    function GetPiontByThree($p1,$p2,$p3){
        $A = $p1->x - $p3->x;  
        $B = $p1->y - $p3->y;  
        $C = pow($p1->x, 2) - pow($p3->x, 2) + pow($p1->y, 2) - pow($p3->y, 2) + pow($p3->Distance, 2) - pow($p1->Distance, 2);  
        $D = $p2->x - $p3->x;  
        $E = $p2->y - $p3->y;  
        $F = pow($p2->x, 2) - pow($p3->x, 2) + pow($p2->y, 2) - pow($p3->y, 2) + pow($p3->Distance, 2) - pow($p2->Distance, 2);  

        $x = ($B * $F - $E * $C) / (2 * $B * $D - 2 * $A * $E);  
        $y = ($A * $F - $D * $C) / (2 * $A * $E - 2 * $B * $D);  

        $p = new yuan;  
        $p->x = $x;
        $p->y = $y;
        return $p;  
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
    
    //补充基站库
    function addLbs($str){
        $STATUS = explode("CELL:",$str);
        $STATUS = explode(";",$STATUS[1]);
        $STATUS = explode(",",$STATUS[0]);
        for($i=3;$i<count($STATUS);$i+=3){
            $CELL_ID = hexdec($STATUS[$i+1]);
            $LAC = hexdec($STATUS[$i]);
            $MNC = hexdec($STATUS[2]);
            if(!isExist("BASE_STATION_DATA","CELL_ID='$CELL_ID' and LAC='$LAC' and MNC='$MNC'")){
                pdoexec("insert into BASE_STATION_DATA(BASE_STATION_DATA_ID,CELL_ID,LAC,MNC,CREATION_TIME) values(uuid(),'$CELL_ID','$LAC','$MNC',now())");
            }
        }
    }
    
    //S168获取电池电量
    function getSTATUS($str){
        $STATUS = explode("STATUS:",$str);
        $STATUS = explode(";",$STATUS[1]);
        $STATUS = explode(",",$STATUS[0]);
        return $STATUS[0];
    }
    
    function WritingLog($dataRes){
        date_default_timezone_set('Asia/Shanghai'); 
        file_put_contents(dirname(__FILE__)."/logs/log".date('Ymd').".log", date('Y-m-d H:i:s')." ".json_encode($dataRes)."\n",FILE_APPEND);
    }
    
    function lbswifiloca($MESSAGE_CONTENT){
        $lbss = getLbs($MESSAGE_CONTENT);
        $wifis = getwifi($MESSAGE_CONTENT);
        $Points = array();
        if(count($lbss)>0){
            foreach ($lbss as $key => $value) {
                $value->type = "lbs";
                array_push($Points,$value);
            }
        }
        
        foreach ($wifis as $key => $value) {
            $value->type = "wifi";
            array_push($Points,$value);
        }
        $res = new obj;
        $res->points = calculation($Points);
        
        $res->lbss = $lbss;
        $res->wifis = $wifis;
        if(count($wifis)>2){
            $res->type = "wifi";
        }else{
            $res->type = "lbs";
        }
        $res->time_ = date("Y-m-d H:i:s");
        
        return $res;
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
    
    //计算可能的点位
    function calculation($Points){
        if(count($Points)>0){
            $gminx = 1.8e308;
            $gmaxx = -1.8e308;
            $gminy = 1.8e308;
            $gmaxy = -1.8e308;
            foreach ($Points as $key => $value) {
                if($value->type=="lbs"){
                    if($gminx>$value->x-$value->d){$gminx=$value->x-$value->d;}
                    if($gmaxx<$value->x+$value->d+50){$gmaxx=$value->x+$value->d+50;}
                    if($gminy>$value->y-$value->d){$gminy=$value->y-$value->d;}
                    if($gmaxy<$value->y+$value->d+50){$gmaxy=$value->y+$value->d+50;}
                }
            }
            //echo json_encode($Points);
            if($gmaxx-$gminx>40000){return;}
            if($gmaxy-$gminy>40000){return;}
            
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
            
            foreach ($Gridss as $key => $value) {
                if($value->w==$maxw){
                    array_push($resGrids,$value);
                }
            }
            
            //取质心
            $sumx = 0;
            $sumy = 0;
            foreach ($resGrids as $key => $value) {
                $sumx += $value->x;
                $sumy += $value->y;
            }
            $avgx = $sumx/count($resGrids);
            $avgy = $sumy/count($resGrids);
            $resGrids[0]->x = $avgx;
            $resGrids[0]->y = $avgy;
            
            //转换坐标
            $coords = "";
            $i = 0;
            foreach ($resGrids as $key => $value) {
                if($i==0){
                    $coords .= $value->x.",".$value->y;
                }else{
                    $coords .= ";".$value->x.",".$value->y;
                }
                $i++;
                if($i>=100){break;}
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
            //$SIGNAL_INTENSITY = 1700-(30*$SIGNAL_INTENSITY);
            $SIGNAL_INTENSITY = 1719.4-(28.899*$SIGNAL_INTENSITY);
            $BASE_STATION_DATAs = pdoquery("select * from BASE_STATION_DATA where CELL_ID='$CELL_ID' and LAC='$LAC' and MNC='$MNC' and GET_RESULTS='获取成功'");
            foreach ($BASE_STATION_DATAs as $key => $value) {
                $Point = new Point;
                $Point->x = $value['BM_LONGITUDE'];
                $Point->y = $value['BM_LATITUDE'];
                $Point->B_LONGITUDE = $value['B_LONGITUDE'];
                $Point->B_LATITUDE = $value['B_LATITUDE'];
                $Point->strength = hexdec($STATUS[$i+2]);
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
                $Point->B_LONGITUDE = $value['B_LONGITUDE'];
                $Point->B_LATITUDE = $value['B_LATITUDE'];
                $Point->strength = $WIFIs[$i+1];
                $Point->MAC_ADDRESS = $WIFIs[$i];
                $Point->d = 60;
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
    
    //中讯定位时间字符转转换
    function getDateStr($str){
        $restr = "20".hexdec(substr($str,8,2)).'-';
        $restr .= hexdec(substr($str,10,2)).'-';
        $restr .= hexdec(substr($str,12,2)).' ';
        $restr .= hexdec(substr($str,14,2)).':';
        $restr .= hexdec(substr($str,16,2)).':';
        $restr .= hexdec(substr($str,18,2));
        return toTimeZone($restr,"Etc/GMT");
    }
    
    function toTimeZone($src, $from_tz = 'America/Denver', $to_tz = 'Asia/Shanghai', $fm = 'Y-m-d H:i:s') {
        $datetime = new DateTime($src, new DateTimeZone($from_tz));
        $datetime->setTimezone(new DateTimeZone($to_tz));
        return $datetime->format($fm);
    }
    
    function getZXmc($str){
        $restr = substr($str,0,2).'-';
        $restr .= substr($str,2,2).'-';
        $restr .= substr($str,4,2).'-';
        $restr .= substr($str,6,2).'-';
        $restr .= substr($str,8,2).'-';
        $restr .= substr($str,10,2);
        return $restr;
    }
    
    function ZXlbswifiloca($lbss,$wifis,$time){
        
        $Points = array();
        if(count($lbss)>2){
            foreach ($lbss as $key => $value) {
                $value->type = "lbs";
                array_push($Points,$value);
            }
        }
        
        foreach ($wifis as $key => $value) {
            $value->type = "wifi";
            array_push($Points,$value);
        }
        $res = new obj;
        $res->points = calculation($Points);
        
        $res->lbss = $lbss;
        $res->wifis = $wifis;
        if(count($wifis)>2){
            $res->type = "wifi";
        }else{
            $res->type = "lbs";
        }
        $res->time_ = $time;
        
        return $res;
    }
    
    //中讯获取lbs数据
    function ZXgetlbs($str){
        $Points = array();
        $wifilen = hexdec(substr($str,4,2));
        $lbslen = hexdec(substr($str,$wifilen*14+20,2));
        $MNC = hexdec(substr($str,$wifilen*14+26,2));
        $lbsstar = $wifilen*14+28;
        for($i=0;$i<$lbslen;$i++){
            $LAC = hexdec(substr($str,$lbsstar+($i*10),4));
            $CELL_ID =  hexdec(substr($str,$lbsstar+($i*10)+4,4));
            $strength = hexdec(substr($str,$lbsstar+($i*10)+8,2));
            ZXaddlbs($CELL_ID,$LAC,$MNC);
            //$SIGNAL_INTENSITY = 17.143*$strength - 585.71;
            $SIGNAL_INTENSITY = 25*$strength - 1150;
            //$SIGNAL_INTENSITY = 800;
            //$SIGNAL_INTENSITY = pow(10,$strength/(10*3.25));
            //$SIGNAL_INTENSITY = (-1*$strength+113)/2;
            //$SIGNAL_INTENSITY = 1719.4-(28.899*$SIGNAL_INTENSITY);
            //$SIGNAL_INTENSITY = pow($strength,3.4284)*0.000291;
            $BASE_STATION_DATAs = pdoquery("select * from BASE_STATION_DATA where CELL_ID='$CELL_ID' and LAC='$LAC' and MNC='$MNC' and GET_RESULTS='获取成功'");
            foreach ($BASE_STATION_DATAs as $key => $value) {
                $Point = new Point;
                $Point->x = $value['BM_LONGITUDE'];
                $Point->y = $value['BM_LATITUDE'];
                $Point->B_LONGITUDE = $value['B_LONGITUDE'];
                $Point->B_LATITUDE = $value['B_LATITUDE'];
                $Point->strength = $strength;
                $Point->d = $SIGNAL_INTENSITY;
                array_push($Points,$Point);
            }
        }
        return $Points;
    }
    
    //中讯wifi获取
    function ZXgetwifi($str){
        $Points = array();
        $wifilen = hexdec(substr($str,4,2));
        for($i=0;$i<$wifilen;$i++){
            $wifimc = substr($str,$i*14+20,12);
            $mac = getZXmc(strtolower($wifimc));
            ZXaddwifi($mac);
            $WIFI_DATAs = pdoquery("select * from WIFI_DATA where MAC_ADDRESS='".$mac."' and GET_RESULTS='获取成功'");
            foreach ($WIFI_DATAs as $key => $value) {
                $Points = new obj;
                $Points->x = $value['BM_LONGITUDE'];
                $Points->y = $value['BM_LATITUDE'];
                $Points->B_LONGITUDE = $value['B_LONGITUDE'];
                $Points->B_LATITUDE = $value['B_LATITUDE'];
                $Points->strength = substr($str,$i*14+32,2);
                $Points->MAC_ADDRESS = $mac;
                $Points->d = 60;
                array_push($Points,$Point);
            }
        }
        return $Points;
    }
    
    //BCD时间格式转换
    function ZXgetBCDTime($str){
        $restr = "20".(substr($str,8,2)).'-';
        $restr .= (substr($str,10,2)).'-';
        $restr .= (substr($str,12,2)).' ';
        $restr .= (substr($str,14,2)).':';
        $restr .= (substr($str,16,2)).':';
        $restr .= (substr($str,18,2));
        return toTimeZone($restr,"Etc/GMT");
    }
    
    //中讯wifi库补充
    function ZXaddwifi($wifimc){
        if(!isExist("WIFI_DATA","MAC_ADDRESS='".$wifimc."'")){
            pdoexec("insert into WIFI_DATA(WIFI_DATA_ID,MAC_ADDRESS,CREATION_TIME) values(uuid(),'".$wifimc."',now())");
        }
    }
    
    //中讯基站库补充
    function ZXaddlbs($CELL_ID,$LAC,$MNC){
        if(!isExist("BASE_STATION_DATA","CELL_ID='$CELL_ID' and LAC='$LAC' and MNC='$MNC'")){
            pdoexec("insert into BASE_STATION_DATA(BASE_STATION_DATA_ID,CELL_ID,LAC,MNC,CREATION_TIME) values(uuid(),'$CELL_ID','$LAC','$MNC',now())");
        }
    }