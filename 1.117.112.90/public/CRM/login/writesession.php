 
<?php
session_start();
require_once dirname(__FILE__) .'/../control/pdo.php';
$LOGIN_VERIFICATION_NOTE_ID = Q($_GET['LOGIN_VERIFICATION_NOTE_ID']);
$_SESSION["LOGIN_VERIFICATION_NOTE_ID"]=$LOGIN_VERIFICATION_NOTE_ID;
//echo $LOGIN_VERIFICATION_NOTE_ID;
header("Location:weixinlogin.php");
exit;