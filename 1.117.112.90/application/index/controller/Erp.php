<?php
namespace app\index\controller;

use think\Db;
use think\Url;
use think\Log;
use think\Controller;
use think\Session;

class Erp extends Controller
{
    public function index()
    {
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        return $this->fetch();
    }
    
    //关注公众号
    public function guanzhu(){
        return $this->fetch();
    }
    
    public function getOpenid(){
        $openid = getOpenid();
        $uc = Db::table('login_information')->where("WECHAT_ID",$openid)->count();
        if($uc==0){
            $uuid = Db::query("select uuid() as uuid_")[0]['uuid_'];
            Db::table('login_information')->insert(['LOGIN_INFORMATION_ID'=>$uuid,'WECHAT_ID'=>$openid,'registration_time'=>date('Y-m-d H:i:s')]);
            Session::set('login_information',$uuid);
            return $uuid;
        }else{
            $login_information = Db::table('login_information')->where("WECHAT_ID",$openid)->find();
            Session::set('login_information',$login_information['LOGIN_INFORMATION_ID']);
            return $login_information['LOGIN_INFORMATION_ID'];
        }
        return $openid;
    }
    
    public function login()
    {
        Session::delete('login_information');
        return $this->fetch();
    }
    
    //修改密码
    public function ModifyPassword(){
        $login_information = Session::get('login_information');
        $this->assign('login_information', $login_information);
        return $this->fetch();
    }
    
    public function ModifyPasswordAction(){
        $login_information = Session::get('login_information');
        $robj = new \stdClass();
        $postdata = input("post.");
        $oldpassword = md5($postdata['oldpassword']);
        $password = md5($postdata['password']);
        if($oldpassword==$login_information['PASSWORD']){
            Db::table('login_information')->where('LOGIN_INFORMATION_ID',$login_information['LOGIN_INFORMATION_ID'])->update(['PASSWORD'=>$password]);
            $uuid = Db::query("select uuid() as uuid_")[0]['uuid_'];
            Db::table('operation_log')->insert(['OPERATION_LOG_ID'=>$uuid,'OPERATING_TIME'=>date('Y-m-d H:i:s'),'OPERATION_CONTENT'=>'用户：【'.$login_information['USER_NAME'].'】修改密码成功']);
            $robj->info = "ok";
        }else{
            $robj->info = "原密码错误";
        }
        return json($robj);
    }
    
    public function islogin(){
        $robj = new \stdClass();
        $postdata = input("post.");
        $LogInfo = $postdata['LogInfo'];
        $uc = Db::table('login_information')->where("LOGIN_INFORMATION_ID",$LogInfo)->count();
        if($uc>0){
            $login_information = Db::table('login_information')->where("LOGIN_INFORMATION_ID",$LogInfo)->find();
            Session::set('login_information',$login_information);
            $robj->info="ok";
        }else{
            $robj->info="没有用户信息";
        }
        return $robj;
    }
    
    public function loginaction(){
        $robj = new \stdClass();
        $postdata = input("post.");
        $username = $postdata['username'];
        $password = md5($postdata['password']);
        $uc = Db::table('login_information')->where("USER_NAME",$username)->where("PASSWORD",$password)->count();
        $uuid = Db::query("select uuid() as uuid_")[0]['uuid_'];
        if($uc>0){
            Db::table('operation_log')->insert(['OPERATION_LOG_ID'=>$uuid,'OPERATING_TIME'=>date('Y-m-d H:i:s'),'OPERATION_CONTENT'=>'用户：【'.$username.'】登录成功']);
            $login_information = Db::table('login_information')->where("USER_NAME",$username)->where("PASSWORD",$password)->find();
            Session::set('login_information',$login_information);
            $robj->uuid = $login_information['LOGIN_INFORMATION_ID'];
            $robj->info = 'ok';
        }else{
            Db::table('operation_log')->insert(['OPERATION_LOG_ID'=>$uuid,'OPERATING_TIME'=>date('Y-m-d H:i:s'),'OPERATION_CONTENT'=>'用户：【'.$username.'】尝试登录失败']);
            $robj->info = '用户名或密码错误';
        }
        return json($robj);
    }
    
    public function register(){
        return $this->fetch();
    }
    
    public function registeraction(){
        $robj = new \stdClass();
        $postdata = input("post.");
        $username = $postdata['username'];
        $password = md5($postdata['password']);
        $uc = Db::table('login_information')->where("USER_NAME",$username)->count();
        $robj->uc = $uc;
        if($uc==0){
            $uuid = Db::query("select uuid() as uuid_")[0]['uuid_'];
            $robj->uuid = $uuid;
            Db::table('login_information')->insert(['LOGIN_INFORMATION_ID'=>$uuid,'WECHAT_ID'=>Session::get('openid'),'USER_NAME'=>$username,'PASSWORD'=>$password,'registration_time'=>date('Y-m-d H:i:s')]);
            $login_information = Db::table('login_information')->where("LOGIN_INFORMATION_ID",$uuid)->find();
            Session::set('login_information',$login_information);
            Db::table('operation_log')->insert(['OPERATION_LOG_ID'=>$uuid,'OPERATING_TIME'=>date('Y-m-d H:i:s'),'OPERATION_CONTENT'=>'用户：【'.$username.'】注册成功']);
            $robj->info = 'ok';
        }else{
            $robj->info = '已存在用户名';
        }
        return json($robj);
    }
}
