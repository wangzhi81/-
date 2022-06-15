<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Db;
use think\Log;
use think\Session;

class Test extends Controller
{
    public function index()
    {
        //QRcode::png($url,false,4,8,1);
        return $this->fetch();
    }
    
    public function login()
    {
        //QRcode::png($url,false,4,8,1);
        return $this->fetch();
    }
    
    //登录验证
    
    
    public function register()
    {
        //QRcode::png($url,false,4,8,1);
        return $this->fetch();
    }
    
    //注册成功
    public function registera(){
        $postdata = input("post.");
        $VERIFICATION_CODE = $postdata['VERIFICATION_CODE'];
        $MOBILE_PHONE = $postdata['MOBILE_PHONE'];
        $USER_NAME = $postdata['USER_NAME'];
        $PASSWORD = $postdata['PASSWORD'];
        $invitation_code = $postdata['invitation_code'];
        $lic = Db::table('login_information')->where('MOBILE_PHONE',$MOBILE_PHONE)->where('VERIFICATION_CODE',$VERIFICATION_CODE)->count();
        if($lic>0){
            $lic = Db::table('login_information')->where('MOBILE_PHONE',$MOBILE_PHONE)->where('VERIFICATION_CODE',$VERIFICATION_CODE)->update(['USER_NAME'=>$USER_NAME,'PASSWORD'=>md5($PASSWORD),'invitation_code'=>$invitation_code,'registration_time'=>date('Y-m-d H:i:s')]);
        }
        return 'ok';
    }
    
    //验证验证码
    public function verify(){
        $postdata = input("post.");
        $VERIFICATION_CODE = $postdata['VERIFICATION_CODE'];
        $MOBILE_PHONE = $postdata['MOBILE_PHONE'];
        $lic = Db::table('login_information')->where('MOBILE_PHONE',$MOBILE_PHONE)->where('VERIFICATION_CODE',$VERIFICATION_CODE)->count();
        if($lic>0){
            return 'yes';
        }else{
            return 'on';
        }
    }
    
    //用户是否存在
    public function isexistuser(){
        $postdata = input("post.");
        $USER_NAME = $postdata['USER_NAME'];
        if(Db::table('login_information')->where('USER_NAME',$USER_NAME)->count()==0){
            return 'no';
        }else{
            return 'yes';
        }
    }
    
    //生成验证码
    public function getRandChar($length){
       $str = null;
       $strPol = "0123456789";
       $max = strlen($strPol)-1;
       for($i=0;$i<$length;$i++){
        $str.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
       }
       return $str;
      }
      
    //发送验证码
    public function sendvcode(){
        $postdata = input("post.");
        //$content = $postdata['content'];
        $phone = $postdata['phone'];
        $vcode = $this->getRandChar(6);
        $lic = Db::table('login_information')->where('MOBILE_PHONE',$phone)->count();
        if($lic==0){
            $uuid = Db::query("select uuid() as uuid_")[0]['uuid_'];
            Db::table('login_information')->insert(['LOGIN_INFORMATION_ID'=>$uuid,'MOBILE_PHONE'=>$phone]);
        }
        Db::table('login_information')->where('MOBILE_PHONE',$phone)->update(['VERIFICATION_CODE'=>$vcode]);
        $content = "验证码：".$vcode;
        //$statusStr = $this->sendsms($content,$phone);
        return $statusStr;
    }
    
    //发送短信
    public function sendsms($content,$phone){
        //$postdata = input("post.");
        //$content = $postdata['content'];
        //$phone = $postdata['phone'];
        $statusStr = array(
        "0" => "短信发送成功",
        "-1" => "参数不全",
        "-2" => "服务器空间不支持,请确认支持curl或者fsocket，联系您的空间商解决或者更换空间！",
        "30" => "密码错误",
        "40" => "账号不存在",
        "41" => "余额不足",
        "42" => "帐户已过期",
        "43" => "IP地址限制",
        "50" => "内容含有敏感词"
        );
        $smsapi = "http://api.smsbao.com/";
        $user = "13006666128"; //短信平台帐号
        $pass = md5("lyzs666888"); //短信平台密码
        //$content="短信内容";//要发送的短信内容
        //$phone = "*****";//要发送短信的手机号码
        $sendurl = $smsapi."sms?u=".$user."&p=".$pass."&m=".$phone."&c=".urlencode($content);
        $result =file_get_contents($sendurl) ;
        return json($statusStr[$result]);
    }
}