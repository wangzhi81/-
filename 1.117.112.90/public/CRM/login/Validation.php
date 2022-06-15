<?php
//验证登录信息
session_start();
require_once dirname(__FILE__) .'/../control/pdo.php';
include '../control/weixin.class.php';
$LOGIN_VERIFICATION_NOTE_ID = Q($_POST['LOGIN_VERIFICATION_NOTE_ID']);
$USER_WECHAT_ID = getOne("select USER_WECHAT_ID from LOGIN_VERIFICATION_NOTE where LOGIN_VERIFICATION_NOTE_ID='$LOGIN_VERIFICATION_NOTE_ID'");
if($USER_WECHAT_ID!=""){
    $_SESSION['think']['OPENID'] = $USER_WECHAT_ID;
    $_SESSION["openid"] = $USER_WECHAT_ID;
    $wxtool = new weixinTool();
    //$userid = $wxtool->getUseridByOpenid($USER_WECHAT_ID);
    //$userinfo = $wxtool->getUserInfoByUserid($userid);
    $userinfo = $wxtool->getUserInfor($_SESSION['openid']);
    //WritingLog($userinfo);
    pdoexec("delete from LOGIN_VERIFICATION_NOTE where USER_WECHAT_ID='$USER_WECHAT_ID'");
    pdoexec("insert into OPERATION_LOG(OPERATION_LOG_ID,OPENID,OPERATING_TIME,OPERATION_CONTENT) values(uuid(),'$USER_WECHAT_ID',now(),'[".$userinfo->nickname."]登录成功')");
    if(!isExist("LOGIN_INFORMATION","WECHAT_ID='".$_SESSION['openid']."'")){
        pdoexec("insert into LOGIN_INFORMATION(LOGIN_INFORMATION_ID,WECHAT_ID) values(uuid(),'".$_SESSION['openid']."')");
    }
    
    echo "ok";
}else{
    $_SESSION['think']['OPENID'] = "123";
    $_SESSION["openid"] = "123";
    echo "ok";
}