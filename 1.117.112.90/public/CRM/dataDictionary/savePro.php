<?php
    session_start();
    if($_SESSION['openid']==""){exit;}
//保存属性

require_once dirname(__FILE__) .'/../control/pdo.php';
$addPropertys = $_POST['addPropertys'];

//echo json_encode($addPropertys);
if($addPropertys!=null){
    foreach ($addPropertys as $key => $value) {
        $ENTITY_CODE = getOne("SELECT ENTITY_CODE FROM `entity` WHERE `ENTITY_UUID` = '".$value['ENTITY_UUID']."'");
        if($value['DATA_TYPE']=='datetime'){
            pdoexec("alter table ".$ENTITY_CODE." add ".$value['FIELD_CODE']." ".$value['DATA_TYPE']." COMMENT '".$value['NOTES']."'");
        }else if($value['DATA_TYPE']=='decimal(10,2)'||$value['DATA_TYPE']=='int(11)'){
            $DEFAULT_VALUE_ = 'null';
            if($value['DEFAULT_VALUE_']!=""){$DEFAULT_VALUE_=$value['DEFAULT_VALUE_'];}
            //echo "alter table ".$ENTITY_CODE." add ".$value['FIELD_CODE']." ".$value['DATA_TYPE']." DEFAULT ".$DEFAULT_VALUE_." COMMENT '".$value['NOTES']."'";
            pdoexec("alter table ".$ENTITY_CODE." add ".$value['FIELD_CODE']." ".$value['DATA_TYPE']." DEFAULT ".$DEFAULT_VALUE_." COMMENT '".$value['NOTES']."'");
        }else if($value['DATA_TYPE']=='text'){
            pdoexec("alter table ".$ENTITY_CODE." add ".$value['FIELD_CODE']." ".$value['DATA_TYPE']." COMMENT '".$value['NOTES']."'");
        }else{
            try{
                //echo "alter table ".$ENTITY_CODE." add ".$value['FIELD_CODE']." ".$value['DATA_TYPE']." DEFAULT '".$value['DEFAULT_VALUE_']."' COMMENT '".$value['NOTES']."'";
                pdoexec("alter table ".$ENTITY_CODE." add ".$value['FIELD_CODE']." ".$value['DATA_TYPE']." DEFAULT '".$value['DEFAULT_VALUE_']."' COMMENT '".$value['NOTES']."'");
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }
        //echo "insert into attribute(ATTRIBUTE_UUID,ENTITY_UUID,FIELD_NAME,FIELD_CODE,DATA_TYPE,NOTES,SerialNumber,DEFAULT_VALUE_) values(uuid(),'".$value['ENTITY_UUID']."','".$value['FIELD_NAME']."','".$value['FIELD_CODE']."','".$value['DATA_TYPE']."','".$value['NOTES']."','".$value['SerialNumber']."','".$value['DEFAULT_VALUE_']."')";
        pdoexec("insert into attribute(ATTRIBUTE_UUID,ENTITY_UUID,FIELD_NAME,FIELD_CODE,DATA_TYPE,NOTES,SerialNumber,DEFAULT_VALUE_) values(uuid(),'".$value['ENTITY_UUID']."','".$value['FIELD_NAME']."','".$value['FIELD_CODE']."','".$value['DATA_TYPE']."','".$value['NOTES']."','".$value['SerialNumber']."','".$value['DEFAULT_VALUE_']."')");
        
    }
}

$Propertys = $_POST['Propertys'];
if($Propertys!=null){
    foreach ($Propertys as $key => $value) {
        $ENTITY_CODE = getOne("SELECT ENTITY_CODE FROM `entity` WHERE `ENTITY_UUID` = '".$value['ENTITY_UUID']."'");
        if($value['DATA_TYPE']=='datetime'){
            pdoexec("alter table ".$ENTITY_CODE." change  ".$value['oldFIELD_CODE']." ".$value['FIELD_CODE']." ".$value['DATA_TYPE']." COMMENT '".$value['NOTES']."'");
        }else if($value['DATA_TYPE']=='decimal(10,2)'||$value['DATA_TYPE']=='int(11)'){
            $DEFAULT_VALUE_ = 'null';
            if($value['DEFAULT_VALUE_']!=""){$DEFAULT_VALUE_=$value['DEFAULT_VALUE_'];}
            //echo "alter table ".$ENTITY_CODE." change ".$value['oldFIELD_CODE']." ".$value['FIELD_CODE']." ".$value['DATA_TYPE']." DEFAULT ".$DEFAULT_VALUE_." COMMENT '".$value['NOTES']."'";
            pdoexec("alter table ".$ENTITY_CODE." change ".$value['oldFIELD_CODE']." ".$value['FIELD_CODE']." ".$value['DATA_TYPE']." DEFAULT ".$DEFAULT_VALUE_." COMMENT '".$value['NOTES']."'");
        }else if($value['DATA_TYPE']=='text'){
            pdoexec("alter table ".$ENTITY_CODE." change  ".$value['oldFIELD_CODE']." ".$value['FIELD_CODE']." ".$value['DATA_TYPE']." COMMENT '".$value['NOTES']."'");
        }else{
            try{
                pdoexec("alter table ".$ENTITY_CODE." change ".$value['oldFIELD_CODE']." ".$value['FIELD_CODE']." ".$value['DATA_TYPE']." DEFAULT '".$value['DEFAULT_VALUE_']."' COMMENT '".$value['NOTES']."'");
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }
        pdoexec("update attribute set FIELD_NAME='".$value['FIELD_NAME']."',FIELD_CODE='".$value['FIELD_CODE']."',DATA_TYPE='".$value['DATA_TYPE']."',NOTES='".$value['NOTES']."',SerialNumber='".$value['SerialNumber']."',DEFAULT_VALUE_='".$value['DEFAULT_VALUE_']."' where ATTRIBUTE_UUID='".$value['ATTRIBUTE_UUID']."'");
    }
}

$delATTRIBUTE_UUIDs = $_POST['delATTRIBUTE_UUIDs'];
$ENTITY_UUID = Q($_POST['ENTITY_UUID']);
if($delATTRIBUTE_UUIDs!=null){
    foreach ($delATTRIBUTE_UUIDs as $key => $value) {
        $ENTITY_CODE = getOne("SELECT ENTITY_CODE FROM `entity` WHERE `ENTITY_UUID` = '".$ENTITY_UUID."'");
        $FIELD_CODE = getOne("SELECT FIELD_CODE FROM `attribute` WHERE `ATTRIBUTE_UUID` = '".$value."'");
        pdoexec("ALTER TABLE ".$ENTITY_CODE." DROP ".$FIELD_CODE);
        pdoexec("delete from attribute where ATTRIBUTE_UUID='$value'");
    }
}
pdoexec("update entity set MODIFICATION_TIME=now() where ENTITY_UUID='$ENTITY_UUID'");