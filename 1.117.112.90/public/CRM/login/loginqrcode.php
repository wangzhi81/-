<?php
error_reporting(E_ERROR);
require_once '../control/phpqrcode/phpqrcode.php';
require_once dirname(__FILE__) .'/../control/pdo.php';
$LOGIN_VERIFICATION_NOTE_ID = Q($_GET['LOGIN_VERIFICATION_NOTE_ID']);
$url = urldecode("http://yy.wangzhi81.com/CRM/login/writesession.php?LOGIN_VERIFICATION_NOTE_ID=".$LOGIN_VERIFICATION_NOTE_ID);
QRcode::png($url,false,'H',10,1);
