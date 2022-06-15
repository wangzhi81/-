<?php
session_start();
require_once dirname(__FILE__) .'/../control/pdo.php';
WritingLog("update LOGIN_VERIFICATION_NOTE set THE_USE_OF_TIME__=now(),USER_WECHAT_ID='".$_SESSION["openid"]."' where LOGIN_VERIFICATION_NOTE_ID='".$_SESSION["LOGIN_VERIFICATION_NOTE_ID"]."'");
pdoexec("update LOGIN_VERIFICATION_NOTE set THE_USE_OF_TIME__=now(),USER_WECHAT_ID='".$_SESSION["openid"]."' where LOGIN_VERIFICATION_NOTE_ID='".$_SESSION["LOGIN_VERIFICATION_NOTE_ID"]."'");