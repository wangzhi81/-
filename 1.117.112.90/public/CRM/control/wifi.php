<?php
    $wifis = explode("WIFI",$MESSAGE_CONTENT);
                    $wifiss = explode(",",str_replace('$','',$wifis[1]));
                    $ra = array();
                    for ($i= 0;$i< count($wifiss); $i++){
                        if(($i%2)==1){
                            $requestdata = new requestdata;
                            $requestdata->mac_address = $wifiss[$i];
                            //$requestdata->singal_strength = floor(($wifiss[$i+1]+113)/2);
                            $requestdata->singal_strength = 8;
                            $requestdata->age = 0;
                            array_push($ra,$requestdata);
                        }
                    }
                    //WritingLog($ra);
                    $resstr = LocationByWifiData(json_encode($ra));
                    $resstr = substr($resstr,strpos($resstr,"{"));
                    $resObj = json_decode($resstr);
                    //WritingLog($resObj->location->longitude);
                    $geoconv = httpGet("http://api.map.baidu.com/geoconv/v1/?coords=".$resObj->location->longitude.",".$resObj->location->latitude."&from=1&to=5&ak=5QUV6G5DqeH7ljQ8iGOnYOcc");
                    //WritingLog($geoconv);
                    $result = json_decode($geoconv);
                    if($result->result[0]->x!=""){
                        pdoexec("update DEVICE_LIST set ELECTRICITY='".getSTATUS($MESSAGE_CONTENT)."',LATITUDE='".$resObj->location->latitude."',LONGITUDE='".$resObj->location->longitude."',B_LONGITUDE='".$result->result[0]->x."',B_LATITUDE='".$result->result[0]->y."' where DEVICE_ID='$id'");
                        pdoexec("insert into DEVICE_TRAJECTORY(DEVICE_TRAJECTORY_ID,DEVICE_ID,TRAJECTORY_TIME,LONGITUDE,LATITUDE,B_LONGITUDE,B_LATITUDE) values(uuid(),'$id',now(),'".$resObj->location->longitude."','".$resObj->location->latitude."','".$result->result[0]->x."','".$result->result[0]->y."')");
                    }