<?php
    require_once dirname(__FILE__) .'/pdo.php';
    require_once dirname(__FILE__) .'/gpsfun.php';
    
    //$MESSAGE = pdoquery("select * from MESSAGE_QUEUE order by RECEIVE_TIME limit 1");
    //foreach ($MESSAGE as $key => $value) {
        $MESSAGE_CONTENT = "787800691709151356340701CC00410734A05A41062AD25A41072F1D5A4107349F5A41072EFF5A4106364F5A41062AF05A0D0A0359339075000861";
        if(strlen($MESSAGE_CONTENT)>5){
            if(substr($MESSAGE_CONTENT,0,3)=="*HQ"){
                WritingLog($MESSAGE_CONTENT);
                $strs = explode(",",$MESSAGE_CONTENT);
                $id = $strs[1];
                if(!isExist("DEVICE_LIST","DEVICE_ID='$id'")){
                    pdoexec("insert into DEVICE_LIST(DEVICE_LIST_ID,DEVICE_ID) values(uuid(),'$id')");
                }
                pdoexec("update DEVICE_LIST set LAST_TIME=now(),ONLINE_STATUS='在线',EQUIPMENT_TYPE='LKGPS' where DEVICE_ID='$id'");
                if($strs[2]=="V1"){
                    $LATITUDE = floor($strs[5]/100);
                    $LATITUDE += ($strs[5]-($LATITUDE*100))/60;
                    $LONGITUDE = floor($strs[7]/100);
                    $LONGITUDE += ($strs[7]-($LONGITUDE*100))/60;
                    $result = json_decode(httpGet("http://api.map.baidu.com/geoconv/v1/?coords=".$LONGITUDE.",".$LATITUDE."&from=1&to=5&ak=5QUV6G5DqeH7ljQ8iGOnYOcc"));
                    //print_r($result->result[0]->x);
                    pdoexec("update DEVICE_LIST set ELECTRICITY='".str_replace("#","",$strs[17])."',LATITUDE='$LATITUDE',LONGITUDE='$LONGITUDE',B_LONGITUDE='".$result->result[0]->x."',B_LATITUDE='".$result->result[0]->y."',POSITIONING_TIME=now() where DEVICE_ID='$id'");
                    pdoexec("insert into DEVICE_TRAJECTORY(DEVICE_TRAJECTORY_ID,DEVICE_ID,TRAJECTORY_TIME,LONGITUDE,LATITUDE,B_LONGITUDE,B_LATITUDE,POSITIONING_MODE) values(uuid(),'$id',now(),'$LONGITUDE','$LATITUDE','".$result->result[0]->x."','".$result->result[0]->y."','gps')");
                }
            }else if(substr($MESSAGE_CONTENT,0,4)=="S168"){
                WritingLog($MESSAGE_CONTENT);
                $strs = explode("#",$MESSAGE_CONTENT);
                $id = $strs[1];
                if(!isExist("DEVICE_LIST","DEVICE_ID='$id'")){
                    pdoexec("insert into DEVICE_LIST(DEVICE_LIST_ID,DEVICE_ID) values(uuid(),'$id')");
                }
                pdoexec("update DEVICE_LIST set LAST_TIME=now(),ONLINE_STATUS='在线',EQUIPMENT_TYPE='S168' where DEVICE_ID='$id'");
                if(strpos($MESSAGE_CONTENT,"CELL:")!=""){
                    addLbs($MESSAGE_CONTENT);
                    addWifi($MESSAGE_CONTENT);
                    $lbsps = lbswifiloca($MESSAGE_CONTENT);
                    $lbsp = $lbsps->points[0];
                    $ELECTRICITY = getS168Status($MESSAGE_CONTENT);
                    $lbsps->ELECTRICITY = $ELECTRICITY;
                    if(($lbsp->x."")!="NAN"){
                        if(($lbsp->x."")!=""){
                            pdoexec("update DEVICE_LIST set ELECTRICITY='".$ELECTRICITY."',B_LONGITUDE='".$lbsp->x."',B_LATITUDE='".$lbsp->y."',POSITIONING_TIME=now(),CURRENT_LOCATION_INFORMATION='".json_encode($lbsps)."' where DEVICE_ID='$id'");
                            pdoexec("insert into DEVICE_TRAJECTORY(DEVICE_TRAJECTORY_ID,DEVICE_ID,TRAJECTORY_TIME,B_LONGITUDE,B_LATITUDE,POSITIONING_MODE) values(uuid(),'$id',now(),'".$lbsp->x."','".$lbsp->y."','".$lbsps->type."')");
                        }
                    }
                    //pdoexec("insert into OPERATION_LOG(OPERATION_LOG_ID,OPENID,OPERATING_TIME,OPERATION_CONTENT,AUXILIARY_INFORMATION) values(uuid(),'sys',now(),'$MESSAGE_CONTENT','".json_encode($lbsps)."')");
                }
                //pdoexec("insert into OPERATION_LOG(OPERATION_LOG_ID,OPENID,OPERATING_TIME,OPERATION_CONTENT) values(uuid(),'sys',now(),'$MESSAGE_CONTENT')");
            }else if(substr($MESSAGE_CONTENT,0,4)=="7878"){
                WritingLog($MESSAGE_CONTENT);
                $strs = explode("0D0A",$MESSAGE_CONTENT);
                $id = substr($strs[1],1);
                if(($id!="")&(strlen($id)==15)&(substr($id,0,7)!="8780613")){
                    if(!isExist("DEVICE_LIST","DEVICE_ID='$id'")){
                        pdoexec("insert into DEVICE_LIST(DEVICE_LIST_ID,DEVICE_ID) values(uuid(),'$id')");
                    }
                    pdoexec("update DEVICE_LIST set LAST_TIME=now(),ONLINE_STATUS='在线',EQUIPMENT_TYPE='ZX' where DEVICE_ID='$id'");
                    if(substr($MESSAGE_CONTENT,6,2)=="10"){
                        $LATITUDE = hexdec(substr($MESSAGE_CONTENT,22,8))/30000/60;
                        $LONGITUDE = hexdec(substr($MESSAGE_CONTENT,30,8))/30000/60;
                        $DateStr = getDateStr($MESSAGE_CONTENT);
                        $result = json_decode(httpGet("http://api.map.baidu.com/geoconv/v1/?coords=".$LONGITUDE.",".$LATITUDE."&from=1&to=5&ak=5QUV6G5DqeH7ljQ8iGOnYOcc"));
                        //echo json_encode($result);
                        pdoexec("update DEVICE_LIST set LATITUDE='$LATITUDE',LONGITUDE='$LONGITUDE',B_LONGITUDE='".$result->result[0]->x."',B_LATITUDE='".$result->result[0]->y."',POSITIONING_TIME=now() where DEVICE_ID='$id'");
                        pdoexec("insert into DEVICE_TRAJECTORY(DEVICE_TRAJECTORY_ID,DEVICE_ID,TRAJECTORY_TIME,LONGITUDE,LATITUDE,B_LONGITUDE,B_LATITUDE,POSITIONING_MODE) values(uuid(),'$id','".$DateStr."','$LONGITUDE','$LATITUDE','".$result->result[0]->x."','".$result->result[0]->y."','gps')");
                    }else if(substr($MESSAGE_CONTENT,6,2)=="69"){
                        $lbss = ZXgetlbs($MESSAGE_CONTENT);
                        $wifis = ZXgetwifi($MESSAGE_CONTENT);
                        $time = ZXgetBCDTime($MESSAGE_CONTENT);
                        $lbsps = ZXlbswifiloca($lbss,$wifis,$time);
                        $lbsp = $lbsps->points[0];
                        if(($lbsp->x."")!="NAN"){
                            //if(($lbsp->x."")!=""){
                                pdoexec("update DEVICE_LIST set B_LONGITUDE='".$lbsp->x."',B_LATITUDE='".$lbsp->y."',POSITIONING_TIME=now(),CURRENT_LOCATION_INFORMATION='".json_encode($lbsps)."' where DEVICE_ID='$id'");
                                pdoexec("insert into DEVICE_TRAJECTORY(DEVICE_TRAJECTORY_ID,DEVICE_ID,TRAJECTORY_TIME,B_LONGITUDE,B_LATITUDE,POSITIONING_MODE) values(uuid(),'$id',now(),'".$lbsp->x."','".$lbsp->y."','".$lbsps->type."')");
                            //}
                        }
                    }else if(substr($MESSAGE_CONTENT,6,2)=="13"){
                        $ELECTRICITY = hexdec(substr($MESSAGE_CONTENT,8,2));
                        pdoexec("update DEVICE_LIST set ELECTRICITY='$ELECTRICITY' where DEVICE_ID='$id'");
                    }
                    pdoexec("insert into OPERATION_LOG(OPERATION_LOG_ID,OPENID,OPERATING_TIME,OPERATION_CONTENT,AUXILIARY_INFORMATION) values(uuid(),'sys',now(),'$MESSAGE_CONTENT','".$DateStr."')");
                }
                //pdoexec("insert into OPERATION_LOG(OPERATION_LOG_ID,OPENID,OPERATING_TIME,OPERATION_CONTENT) values(uuid(),'sys',now(),'$MESSAGE_CONTENT')");
            }else if(substr($MESSAGE_CONTENT,0,5)=="data:"){
                pdoexec("insert into OPERATION_LOG(OPERATION_LOG_ID,OPENID,OPERATING_TIME,OPERATION_CONTENT) values(uuid(),'sys',now(),'$MESSAGE_CONTENT')");
            }else if(substr($MESSAGE_CONTENT,0,4)=="sys:"){
                //pdoexec("insert into OPERATION_LOG(OPERATION_LOG_ID,OPENID,OPERATING_TIME,OPERATION_CONTENT) values(uuid(),'sys',now(),'$MESSAGE_CONTENT')");
            }
        }
        pdoexec("delete from MESSAGE_QUEUE where MESSAGE_QUEUE_ID='".$value['MESSAGE_QUEUE_ID']."'");
        echo $MESSAGE_CONTENT;
    //}
    pdoexec("update DEVICE_LIST set ONLINE_STATUS='离线' where TIMESTAMPDIFF(MINUTE,LAST_TIME,now())>10");
    echo "ok";
    