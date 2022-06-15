<?php
    //require_once $_SERVER['DOCUMENT_ROOT'].'/UIUE/weixin/comm/log.php';
    class weixinTool {
        public $appid = 'wx02061dad6befc4b1';
        public $secret = 'e5ee15eba9fac558040b96bf8482aae4';
        public function __construct() {
          	date_default_timezone_set('Asia/Shanghai'); 
            //$logHandler= new CLogFileHandler($_SERVER['DOCUMENT_ROOT']."/logs/".date('Y-m-d').'.log');
            //$log = Log::Init($logHandler, 15);
          	session_start();
          	if(!isset($_SESSION['openid'])){
              //Log::DEBUG("weixinClass:openid没有被设定");
              $_SESSION['openid'] = $this->GetOpenid();                            
            }
            if(!isset($_SESSION['UserInfor'])){
              //Log::DEBUG("weixinClass:UserInfor没有被设定");
              if(isset($_SESSION['openid'])){
                if($_SESSION['openid']!=""){
                  $Infor = $this->getUserInfor($_SESSION['openid']);
                  $_SESSION['UserInfor'] = $Infor;
                  //Log::DEBUG("weixinClass:UserInfor被设定");
                }
              }
            }                      	
        }
      	
      
        //判断是否在微信中
        private function is_weixin(){  
            if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {  
                    return true;  
            }    
            return false;  
        }
        
        private function ToUrlParams($urlObj)
        {
            $buff = "";
            foreach ($urlObj as $k => $v)
            {
                if($k != "sign"){
                    $buff .= $k . "=" . $v . "&";
                }
            }

            $buff = trim($buff, "&");
            return $buff;
        }
      	private function __CreateOauthUrlForCode($redirectUrl)
        {
            $urlObj["appid"] = $this->appid;
            $urlObj["redirect_uri"] = "$redirectUrl";
            $urlObj["response_type"] = "code";
            $urlObj["scope"] = "snsapi_base";
            $urlObj["state"] = "STATE"."#wechat_redirect";
            $bizString = $this->ToUrlParams($urlObj);
            return "https://open.weixin.qq.com/connect/oauth2/authorize?".$bizString;
        }
        private function __CreateOauthUrlForOpenid($code)
        {
            $urlObj["appid"] = $this->appid;
            $urlObj["secret"] = $this->secret;
            $urlObj["code"] = $code;
            $urlObj["grant_type"] = "authorization_code";
            $bizString = $this->ToUrlParams($urlObj);
            return "https://api.weixin.qq.com/sns/oauth2/access_token?".$bizString;
        }
        public function GetOpenidFromMp($code)
        {
            $url = $this->__CreateOauthUrlForOpenid($code);
            //初始化curl
            $ch = curl_init();
            //设置超时
            curl_setopt($ch, CURLOPT_TIMEOUT, 10000);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,FALSE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            //if(WxPayConfig::CURL_PROXY_HOST != "0.0.0.0" 
            //	&& WxPayConfig::CURL_PROXY_PORT != 0){
            //	curl_setopt($ch,CURLOPT_PROXY, WxPayConfig::CURL_PROXY_HOST);
            //	curl_setopt($ch,CURLOPT_PROXYPORT, WxPayConfig::CURL_PROXY_PORT);
            //}
            //运行curl，结果以jason形式返回
            $res = curl_exec($ch);
            curl_close($ch);
            //取出openid
            $data = json_decode($res,true);
            //$this->data = $data;
            if(isset($data['openid'])){
                $openid = $data['openid'];
            }else{
                $openid = "";  
            }
            return $openid;
        }
        public function GetOpenid()
        {
            if(!$this->is_weixin()){
              return "";
            }
          	//通过code获得openid
            if (!isset($_GET['code'])){
                //触发微信返回code码
                $baseUrl = urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].$_SERVER['QUERY_STRING']);
                $url = $this->__CreateOauthUrlForCode($baseUrl);
                Header("Location: $url");
                exit();
            } else {
                //获取code码，以获取openid
                $code = $_GET['code'];
                $openid = $this->getOpenidFromMp($code);
              	//Log::DEBUG("weixinClass:获取openid：" . $openid);
                return $openid;
            }
        }
        //http请求
        public function httpGet($url) {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_TIMEOUT, 500);
            // 为保证第三方服务器与微信服务器之间数据传输的安全性，所有微信接口采用https方式调用，必须使用下面2行代码打开ssl安全校验。
            // 如果在部署过程中代码在此处验证失败，请到 http://curl.haxx.se/ca/cacert.pem 下载新的证书判别文件。
            //curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
            //curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_URL, $url);
            
            $res = curl_exec($curl);
            curl_close($curl);
            
            return $res;
        }
        //建立菜单
        public function createMenu($data){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$this->getAccessTocken());
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $tmpInfo = curl_exec($ch);
            if (curl_errno($ch)) {
              return curl_error($ch);
            }
            
            curl_close($ch);
            return $tmpInfo;
            
            }
            
        //获取菜单
        public function getMenu(){
            
        return $this->httpGet("https://api.weixin.qq.com/cgi-bin/menu/get?access_token=".$this->getAccessTocken());
        }
        
        //删除菜单
        public function deleteMenu(){
        return $this->httpGet("https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=".$this->getAccessTocken());
        }
        
        //获取access_token
        public function getAccessTocken(){
            $access_token = "";
            $data = json_decode($this->get_php_file($_SERVER['DOCUMENT_ROOT']."/CRM/control/access_token.php"));
            if ($data->getTime < time()) {
                $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$this->appid."&secret=".$this->secret;
                $res = json_decode($this->httpGet($url));
                $res -> getTime = time() + 7000;
                $access_token = $res->access_token;
                $this->set_php_file($_SERVER['DOCUMENT_ROOT']."/CRM/control/access_token.php", json_encode($res));
                //Log::DEBUG("weixinClass:获取Tocken：" . $access_token);
            }else{
                $access_token = $data -> access_token;
            }
            return $access_token;
        }
        
        //获取js票据
        public function getJsApiTicket(){
            $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=".$this->getAccessTocken();
            $res = json_decode($this->httpGet($url));
            $ticket = $res->ticket;
            return $ticket;
        }
      
      	//获取用户信息
        public function getUserInfor($openid){
            $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$this->getAccessTocken()."&openid=".$openid;
          	$res = $this->httpGet($url);
          	//Log::DEBUG("weixinClass:获取UserInfor：" . $res);
            $Infor = json_decode($res);
            return $Infor;
        }
        
        //随机字符串
        private function createNonceStr($length = 16) {
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $str = "";
            for ($i = 0; $i < $length; $i++) {
              $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
            }
            return $str;
        }
      
      	//获取OPENID
        public function getUerOpenid(){
			
        }
        
        //获取SignPackage
        public function getSignPackage() {
            date_default_timezone_set('Asia/Shanghai');
            $jsapiTicket = $this->getJsApiTicket();
        
            // 注意 URL 一定要动态获取，不能 hardcode.
            $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
            $url = $protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        
            $timestamp = time();
            $nonceStr = $this->createNonceStr();
        
            // 这里参数的顺序要按照 key 值 ASCII 码升序排序
            $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";
        
            $signature = sha1($string);
        
            $signPackage = array(
              "appId"     => $this->appid,
              "nonceStr"  => $nonceStr,
              "timestamp" => $timestamp,
              "url"       => $url,
              "signature" => $signature,
              "rawString" => $string,
              "jsapiTicket" => $jsapiTicket
            );
            return $signPackage; 
        }
        public function get_php_file($filename) {
            return trim(substr(file_get_contents($filename), 15));
        }
        private function set_php_file($filename, $content) {
            $fp = fopen($filename, "w");
            fwrite($fp, "<?php exit();?>" . $content);
            fclose($fp);
        }
        //日志
        function WritingLog($dataRes){
            //date_default_timezone_set('Asia/Shanghai'); 
            file_put_contents($_SERVER['DOCUMENT_ROOT']."/logs/log".date('Ymd').".log", date('y-m-d h:i:s')." ".json_encode($dataRes),FILE_APPEND);
        }
    }
?>