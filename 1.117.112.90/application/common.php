<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
use think\Config;
use Wechat\Loader;
use think\Controller;
use think\Session;
use think\Log;

/**
 * 获取微信操作对象
 * @staticvar array $wechat
 * @param type $type
 * @return WechatReceive
 */
function & load_wechat($type = '') {
    static $wechat = array();
    $index = md5(strtolower($type));
    if (!isset($wechat[$index])) {
        $config = Config::get('wechat');
        $config['cachepath'] = CACHE_PATH . 'Data/';
        $wechat[$index] = Loader::get($type, $config);
    }
    return $wechat[$index];
}

function & load_dswechat($type = '') {
    static $wechat = array();
    $index = md5(strtolower($type));
    if (!isset($wechat[$index])) {
        $config = Config::get('dishang');
        $config['cachepath'] = CACHE_PATH . 'Data/';
        $wechat[$index] = Loader::get($type, $config);
    }
    return $wechat[$index];
}

function getParameter($parameter_name){
    $ParameterSetting = \app\admin\model\ParameterSetting::get(['parameter_name' => $parameter_name]);
    return $ParameterSetting['parameter_values'];
}

//保存上传文件
function saveUploadFile($result,$serverId){
    $dateYmd = date("Y");
    $DateFolder = ROOT_PATH . 'public' . DS . 'uploads/'.$dateYmd.'/';
    if(!file_exists($DateFolder)){
        mkdir($DateFolder);
    }
    $dateYmd = $dateYmd.'/'.date("m");
    $DateFolder = ROOT_PATH . 'public' . DS . 'uploads/'.$dateYmd.'/';
    if(!file_exists($DateFolder)){
        mkdir($DateFolder);
    }
    $dateYmd = $dateYmd.'/'.date("d");
    $DateFolder = ROOT_PATH . 'public' . DS . 'uploads/'.$dateYmd.'/';
    if(!file_exists($DateFolder)){
        mkdir($DateFolder);
    }
    $FilePath = $DateFolder.$serverId.'.png';
    $HttpPath = '/uploads/'.$dateYmd.'/'.$serverId.'.png';
    file_put_contents($FilePath,$result);
    $image = \think\Image::open($DateFolder.$serverId.'.png');
    $image->thumb(150, 150)->save($DateFolder.$serverId.'_150.png');
    return $HttpPath;
}

//已缩略图的形式保存
function saveUploadFileS($temp){
    $dateYmd = date("Ymd");
    $DateFolder = ROOT_PATH . 'public' . DS . 'uploads/'.$dateYmd.'/';
    if(!file_exists($DateFolder)){
        mkdir($DateFolder);
    }
    $serverId = md5($temp.date('His'));
    move_uploaded_file($_FILES["file"]["tmp_name"],$DateFolder.$serverId.'.png');
    //Log::record($_FILES["file"]["tmp_name"]);
    $image = \think\Image::open($DateFolder.$serverId.'.png');
    $image->thumb(150, 150)->save($DateFolder.$serverId.'_150.png');
    $HttpPath = '/uploads/'.$dateYmd.'/'.$serverId.'_150.png';
    return $HttpPath;
}

//从网页保存文件
function saveUploadFileW($temp){
    $dateYmd = date("Y");
    $DateFolder = ROOT_PATH . 'public' . DS . 'uploads/'.$dateYmd.'/';
    if(!file_exists($DateFolder)){
        mkdir($DateFolder);
    }
    $dateYmd = $dateYmd.'/'.date("m");
    $DateFolder = ROOT_PATH . 'public' . DS . 'uploads/'.$dateYmd.'/';
    if(!file_exists($DateFolder)){
        mkdir($DateFolder);
    }
    $dateYmd = $dateYmd.'/'.date("d");
    $DateFolder = ROOT_PATH . 'public' . DS . 'uploads/'.$dateYmd.'/';
    if(!file_exists($DateFolder)){
        mkdir($DateFolder);
    }
    $serverId = md5($temp.date('His'));
    move_uploaded_file($_FILES["file"]["tmp_name"],$DateFolder.$serverId.'.png');
    //Log::record($_FILES["file"]["tmp_name"]);
    $image = \think\Image::open($DateFolder.$serverId.'.png');
    $image->thumb(150, 150)->save($DateFolder.$serverId.'_150.png');
    $HttpPath = '/uploads/'.$dateYmd.'/'.$serverId.'.png';
    return $HttpPath;
}

function getOpenid(){
    //Session::delete('openid');
    if(Session::has('openid')){
        //Log::record("if(Session::has('openid')){");
        return Session::get('openid');
    }else{
        $oauth = & load_wechat('Oauth');
        if(!isset($_GET['code'])){
            $callback = input('server.REQUEST_SCHEME')."://".input('server.HTTP_HOST').input('server.REQUEST_URI');
            $result = $oauth->getOauthRedirect($callback,"","snsapi_base");
            //Log::record('$result1：'.json_encode($result));
            if($result===FALSE){
                return false;
            }else{
                return redirect($result);
            }
        }else{
            $result = $oauth->getOauthAccessToken();
            Log::record('getOpenid$result：'.json_encode($result));
            if($result===FALSE){
                return false;
            }else{
                Session::set('openid',$result['openid']);
                //Log::record('写Session，openid：'.json_encode(input('session.')));
            	return $result['openid'];
            }
        }
    }
}

function getDsOpenid(){
    //Session::delete('openid');
    if(Session::has('openid')){
        //Log::record("if(Session::has('openid')){");
        return Session::get('openid');
    }else{
        $oauth = & load_dswechat('Oauth');
        if(!isset($_GET['code'])){
            $callback = input('server.REQUEST_SCHEME')."://".input('server.HTTP_HOST').input('server.REQUEST_URI');
            $result = $oauth->getOauthRedirect($callback,"","snsapi_base");
            //Log::record('$result1：'.json_encode($result));
            if($result===FALSE){
                return false;
            }else{
                return redirect($result);
            }
        }else{
            $result = $oauth->getOauthAccessToken();
            Log::record('getOpenid$result：'.json_encode($result));
            if($result===FALSE){
                return false;
            }else{
                Session::set('openid',$result['openid']);
                //Log::record('写Session，openid：'.json_encode(input('session.')));
            	return $result['openid'];
            }
        }
    }
}

function getSnsapi_userinfo(){
    if(Session::has('openid')){
        //Log::record("if(Session::has('openid')){");
        return Session::get('openid');
    }else{
        $oauth = & load_wechat('Oauth');
        if(!isset($_GET['code'])){
            $callback = input('server.REQUEST_SCHEME')."://".input('server.HTTP_HOST').input('server.REQUEST_URI');
            $result = $oauth->getOauthRedirect($callback,"","snsapi_userinfo");
            if($result===FALSE){
                return false;
            }else{
                return redirect($result);
            }
        }else{
            $result = $oauth->getOauthAccessToken();
            if($result===FALSE){
                return false;
            }else{
                //Log::record(json_encode($result),'201802171417');
                $OauthUserinfo = $oauth->getOauthUserinfo($result['access_token'], $result['openid']);
                Session::set('openid',$result['openid']);
                Session::set('OauthUserinfo',$OauthUserinfo);
                //Log::record(json_encode($OauthUserinfo),'201802171417');
            	return $result['openid'];
            }
        }
    }
}

//将内容进行UNICODE编码，编码后的内容格式：\u56fe\u7247 （原始：图片）  
function unicode_encode($name)  
{  
    $name = iconv('UTF-8', 'UCS-2', $name);  
    $len = strlen($name);  
    $str = '';  
    for ($i = 0; $i < $len - 1; $i = $i + 2)  
    {  
        $c = $name[$i];  
        $c2 = $name[$i + 1];  
        if (ord($c) > 0)  
        {    // 两个字节的文字  
            $str .= '\u'.base_convert(ord($c), 10, 16).base_convert(ord($c2), 10, 16);  
        }  
        else  
        {  
            $str .= $c2;  
        }  
    }  
    return $str;  
}  
  
// 将UNICODE编码后的内容进行解码，编码后的内容格式：\u56fe\u7247 （原始：图片）  
function unicode_decode($name)  
{  
    // 转换编码，将Unicode编码转换成可以浏览的utf-8编码  
    $pattern = '/([\w]+)|(\\\u([\w]{4}))/i';  
    preg_match_all($pattern, $name, $matches);  
    if (!empty($matches))  
    {  
        $name = '';  
        for ($j = 0; $j < count($matches[0]); $j++)  
        {  
            $str = $matches[0][$j];  
            if (strpos($str, '\\u') === 0)  
            {  
                $code = base_convert(substr($str, 2, 2), 16, 10);  
                $code2 = base_convert(substr($str, 4), 16, 10);  
                $c = chr($code).chr($code2);  
                $c = iconv('UCS-2', 'UTF-8', $c);  
                $name .= $c;  
            }  
            else  
            {  
                $name .= $str;  
            }  
        }  
    }  
    return $name;  
}  