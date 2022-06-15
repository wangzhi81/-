<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Log;
use think\Session;
use think\Cookie;
use \think\Request;

class Database extends Controller
{
    public function index()
    {
        return "Database";
    }
    
    //导出数据结构
    public function daochu(){
        //$py = new Pinyin();
        $entity = Db::table("entity")->order("MODIFICATION_TIME desc")->limit(50)->select();
        foreach ($entity as $key => &$value) {
            //$value['ENTITY_CODE_'] = strtolower($value['ENTITY_CODE']);
            //$value['ENTITY_CODE_'] = $value['ENTITY_CODE'];
            //$value['ENTITY_CODE_'] = strtoupper($py->getFirstPY($value['ENTITY_NAME']));
            $value['attribute'] = Db::table("attribute")->where("ENTITY_UUID",$value['ENTITY_UUID'])->order("SerialNumber")->select();
            foreach ($value['attribute'] as $key2 => &$value2) {
                //$value2['FIELD_CODE'] = strtoupper($py->getFirstPY($value2['FIELD_NAME']));
                $value2['SerialNumber'] = sprintf("%02d",$value2['SerialNumber']+1);
                $number = $value2['DATA_TYPE'];
                $value2['DATA_LENGTH'] = substr(substr($number,strripos($number,"(")+1),0,strrpos(substr($number,strripos($number,"(")+1),")"));
                if(strrpos($number,"(")>0){
                    $value2['DATA_TYPE'] = substr($number,0,strrpos($number,"("));
                }
            }
        }
        $this->assign('entity', $entity);
        return $this->fetch();
    }
    
    //操作日志
    public function operation_log(){
        $operation_log = Db::table("operation_log")->order("OPERATING_TIME desc")->limit(50)->select();
        $this->assign('operation_log', $operation_log);
        return $this->fetch();
    }
    
    public function operation_log_byemployee_id(){
        $employee_id = input("post.employee_id");
        $operation_log = Db::table("operation_log")->where("employee_id",$employee_id)->order("OPERATING_TIME desc")->limit(50)->select();
        return json($operation_log);
    }
}