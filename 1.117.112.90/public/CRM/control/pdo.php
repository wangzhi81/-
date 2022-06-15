<?php
    define('DB_HOST', '127.0.0.1'); //数据库服务器地址  
    define('DB_USER', 'root');  //数据库用户名  
    define('DB_PWD', 'c509aa1916ac5f7c');//数据库密码  
    define('DB_NAME', 'crm');  //数据库名称  
    define('DB_PORT', '3306');  //数据库端口
    define('V_DIR', '/crm');
    function pdoexec($sqlstr){
        $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME;
        $db = new PDO($dsn, DB_USER, DB_PWD);
        $db->exec("SET NAMES utf8;"); 
        $count = $db->exec($sqlstr);
        $db = null;
        return $count;
    }
    function pdoquery($sqlstr){
        $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME;
        $db = new PDO($dsn, DB_USER, DB_PWD);
        $db->exec("SET NAMES utf8;"); 
        $rs = $db->query($sqlstr);
        $result_arr = $rs->fetchAll();
        $db = null;
        return $result_arr;
    }
    
    //获取一行
    function getRow($sqlstr){
        $row = null;
        $rows = pdoquery($sqlstr);
        foreach ($rows as $key => $value) {
            $row = $value;
        }
        return $row;
    }
    
    //获取单一字段值
    function getOne($sqlstr){
        return pdoquery($sqlstr)[0][0];
    }
    //是否存在
    function isExist($table,$where){
        $sqlstr = "select count(1) from $table where $where";
        $count_ = pdoquery($sqlstr)[0][0];
        if($count_>0){
            return true;
        }else{
            return false;
        }
    }
    //清除单引号
    function Q($str){
        return str_replace("'","’",$str);
    }
    //日志
    function WritingLog($dataRes){
        //date_default_timezone_set('Asia/Shanghai'); 
        file_put_contents($_SERVER['DOCUMENT_ROOT']."/logs/log".date('Ymd').".log", date('y-m-d h:i:s')." ".json_encode($dataRes)."\n",FILE_APPEND);
    }
?>