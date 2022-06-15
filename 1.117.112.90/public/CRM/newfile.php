<?php
    require_once dirname(__FILE__) .'/control/pdo.php';
    $LOGIN_VERIFICATION_NOTE_ID = getOne("select uuid()");
    print_r(json($LOGIN_VERIFICATION_NOTE_ID));