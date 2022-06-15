<?php
    require_once dirname(__FILE__) .'/pdo.php';
    $strReads = $_POST['strReads'];
    $strReads = trim(mb_convert_encoding($strReads, "UTF-8", "GBK"));
    //echo $strReads;
    pdoexec("insert into MESSAGE_QUEUE(MESSAGE_QUEUE_ID,RECEIVE_TIME,MESSAGE_CONTENT) values(uuid(),now(),'".$strReads."')");