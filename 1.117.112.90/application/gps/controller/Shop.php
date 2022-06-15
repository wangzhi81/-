<?php
namespace app\music\controller;

use think\Db;
use think\Url;
use think\Log;
use think\Controller;
use think\Session;

class Shop extends Controller
{
    public function index()
    {
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        if(!$this->updateUser_($openid)){
            $this->redirect('music/index/ydgzh');
        }
        return $this->fetch();
    }
    
    public function zylb(){
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        if(!$this->updateUser_($openid)){
            $this->redirect('music/index/ydgzh');
        }
        return $this->fetch();
    }
    
    public function test3(){
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        if(!$this->updateUser_($openid)){
            $this->redirect('music/index/ydgzh');
        }
        $this->assign('openid', $openid);
        $ymtb = Db::table("operation_parameters")->where("parameter_name","ymtb")->find();
        $this->assign('ymtb', $ymtb);
        $rotate_pictures_on_home_pages = Db::table("rotate_pictures_on_home_page")->order("collation")->select();
        foreach ($rotate_pictures_on_home_pages as $key => &$value) {
            $value['picture_address'] = str_replace('http://zhangfeng2020.oss-cn-zhangjiakou.aliyuncs.com','http://admin.dzyywx.com',$value['picture_address']);
        }
        $this->assign('rotate_pictures_on_home_page0', $rotate_pictures_on_home_pages[0]);
        $this->assign('rotate_pictures_on_home_page1', $rotate_pictures_on_home_pages[1]);
        $this->assign('rotate_pictures_on_home_page2', $rotate_pictures_on_home_pages[2]);
        return $this->fetch();
    }
    
    public function test2(){
        $resobj = new \stdClass();
        $resobj->Jkid = "ZYJYXXF01";
        $resobj->Token = "12345678";
        $resobj->WriteJsonDoc = new \stdClass();
        $resobj->WriteJsonDoc->exchangeType = "31";
        $resobj->WriteJsonDoc->exchangeCode = "330101201701111113140000000112345678";
        $resobj->WriteJsonDoc->requestTime = "20170101111314";
        $resobj->WriteJsonDoc->body = new \stdClass();
        $resobj->WriteJsonDoc->body->timestamp = time();
        $resobj->WriteJsonDoc->body->fileUrl = "https://xxx/xxx/xxx.sql";
        $resobj->WriteJsonDoc->body->MD5 = "i3ABSDYbqHi_x0Yk7eYSEh09ZJ2WlNj-SeOnfgnmr5Gb1ZHrFhXv664FLKmm0w0E";
        $resobj->WriteJsonDoc->version = "1.0";
        return json($resobj);
    }
    
    public function test(){
        $resobj = new \stdClass();
        $resobj->Jkid = "ZYJYXXF01";
        $resobj->Token = "12345678";
        $resobj->WriteJsonDoc = new \stdClass();
        $resobj->WriteJsonDoc->exchangeType = "30";
        $resobj->WriteJsonDoc->exchangeCode = "330101201701111113140000000112345678";
        $resobj->WriteJsonDoc->requestTime = "20170101111314";
        $resobj->WriteJsonDoc->body = new \stdClass();
        $resobj->WriteJsonDoc->body->timestamp = time();
        $resobj->WriteJsonDoc->body->dataArea = "all";
        $resobj->WriteJsonDoc->version = "1.0";
        return json($resobj);
    }
    
    //立即下载
    public function ljxz($id){
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        if(!$this->updateUser_($openid)){
            $this->redirect('music/index/ydgzh');
        }
        $download_resources = Db::table("download_resources")->where("DOWNLOAD_RESOURCES_ID",$id)->find();
        $this->assign('download_resources', $download_resources);
        return $this->fetch();
    }
    
    //资源下载界面
    public function zyxz($id){
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        if(!$this->updateUser_($openid)){
            $this->redirect('music/index/ydgzh');
        }
        $user_list = Db::table("user_list")->where('OPENID',$openid)->find();
        $download_resources = Db::table("download_resources")->where("DOWNLOAD_RESOURCES_ID",$id)->find();
        $download_resources['resource_size'] = $this->getFilesize($download_resources['resource_size']);
        $download_resources['resource_image'] = str_replace('http://zhangfeng2020.oss-cn-zhangjiakou.aliyuncs.com','http://admin.dzyywx.com',$download_resources['resource_image']);
        $this->assign('download_resources', $download_resources);
        if($download_resources['resource_price']==0){
            return $this->fetch();
        }
        if($user_list['vip_or_not']=='是'){
            $zero1=date("y-m-d h:i:s");
            if(strtotime($zero1)<strtotime($user_list['vip_expiration_date'])){
                return $this->fetch();
            }
        }
        if(Db::table("resource_purchase_records")->where("resource_id",$id)->where("user_id",$user_list['USER_LIST_ID'])->count()>0){
            return $this->fetch();
        }else{
            $this->redirect('gmzy',['id'=>$id]);
        }
    }
    
    //对直接关注者的处理
    public function updateUser_($openid){
        $wxuser = & load_wechat('User');
        $user = \app\index\model\UserList::get(['OPENID' => $openid]);
        if($user==null){
            $user = new \app\index\model\UserList;
            $result = $wxuser->getUserInfo($openid);
            //return json($result);
            if($result===FALSE){
                return;
            }else{
                //Log::record("result:".json_encode($result),'notice');
                if(!isset($result['nickname'])){
                    return false;
                }
                $user->NICKNAME = json_encode($result['nickname']);
                $user->GENDER = $result['sex'];
                $user->PROVINCE = $result['province'];
                $user->CITY = $result['city'];
                $user->HEAD_PORTRAIT = $result['headimgurl'];
                $user->ATTENTION_TIME = date('Y-m-d H:i:s', $result['subscribe_time']);
                $user->OPENID = $openid;
                $user->superior_openid = "olz_I0qapApA3Y-qzpHMKqO9sVhE";
                $user->save();
            }
        }
        return true;
    }
    
    function getFilesize($num){
       $p = 0;
       $format='bytes';
       if($num>0 && $num<1024){
         $p = 0;
         return number_format($num).' '.$format;
       }
       if($num>=1024 && $num<pow(1024, 2)){
         $p = 1;
         $format = 'KB';
      }
      if ($num>=pow(1024, 2) && $num<pow(1024, 3)) {
        $p = 2;
        $format = 'MB';
      }
      if ($num>=pow(1024, 3) && $num<pow(1024, 4)) {
        $p = 3;
        $format = 'GB';
      }
      if ($num>=pow(1024, 4) && $num<pow(1024, 5)) {
        $p = 3;
        $format = 'TB';
      }
      $num /= pow(1024, $p);
      return number_format($num, 3).' '.$format;
    }
    
    //购买资源
    public function gmzy($id){
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        if(!$this->updateUser_($openid)){
            $this->redirect('music/index/ydgzh');
        }
        $user_list = Db::table("user_list")->where('OPENID',$openid)->find();
        $download_resources = Db::table("download_resources")->where("DOWNLOAD_RESOURCES_ID",$id)->find();
        $download_resources['resource_image'] = str_replace('http://zhangfeng2020.oss-cn-zhangjiakou.aliyuncs.com','http://admin.dzyywx.com',$download_resources['resource_image']);
        if(Db::table("resource_purchase_records")->where("resource_id",$id)->where("user_id",$user_list['USER_LIST_ID'])->count()>0){
            $this->redirect('zyxz',['id'=>$id]);
        }
        $this->assign('download_resources', $download_resources);
        return $this->fetch();
    }
    
    //已购买资源
    public function myzy(){
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        if(!$this->updateUser_($openid)){
            $this->redirect('music/index/ydgzh');
        }
        return $this->fetch();
    }
    
    //查询已购买资源
    public function getmyzy(){
        $postdata = input("post.");
        $openid = getOpenid();
        $user_list = Db::table("user_list")->where('OPENID',$openid)->find();
        $cxtj = $postdata['cxtj'];
        $download_resourcess = Db::table("download_resources")->alias('a')->join('resource_purchase_records b','a.DOWNLOAD_RESOURCES_ID = b.resource_id')->where("user_id",$user_list['USER_LIST_ID']);
        if($cxtj!=''){
            $download_resourcess = $download_resourcess->where("resource_name like '%".$cxtj."%'");
        }
        $download_resourcess = $download_resourcess->order("creation_time desc")->limit(50)->select();
        return json($download_resourcess);
    }
    
    //购买资源回调通知
    public function zynotify(){
        $postdata = input("post.");
        //Log::record("notify:".json_encode($postdata['order_id']),'notice');
        Db::table("unified_order")->where("order_id",$postdata['order_id'])->update(['pay_or_not'=>'已支付']);
        $unified_order = Db::table("unified_order")->where("order_id",$postdata['order_id'])->find();
        $uuid = Db::query("select uuid() as uuid_")[0]['uuid_'];
        Db::table("resource_purchase_records")->insert(['RESOURCE_PURCHASE_RECORDS_ID'=>$uuid,'resource_id'=>$unified_order['commodity_id'],'user_id'=>$unified_order['customer_id'],'purchase_time'=>date("Y-m-d H:i:s"),'purchase_price'=>$postdata['pay_price']]);
    }
    
    //购买资源支付
    public function getzfurl(){
        $postdata = input("post.");
        $order_id = time();    # 自己创建的本地订单号
        $price = $postdata['price']; # 从 URL 获取充值金额 price
        $commodity_id = $postdata['commodity_id'];
        $course_information = Db::table("download_resources")->where("DOWNLOAD_RESOURCES_ID",$commodity_id)->find();
        $openid = getOpenid();
        $user_list = Db::table("user_list")->where('OPENID',$openid)->find();
        $uuid = Db::query("select uuid() as uuid_")[0]['uuid_'];
        Db::table("unified_order")->insert(['UNIFIED_ORDER_ID'=>$uuid,'commodity_id'=>$commodity_id,'customer_id'=>$user_list['USER_LIST_ID'],'order_id'=>$order_id]);
        $name = $course_information['resource_name'];  # 订单商品名称
        //$name = "native 测试订单";
        //$pay_type = 'jsapi';     # 付款方式
        $pay_type = 'native'; 
        
        $notify_url = 'http://wx.dzyywx.com/music/shop/zynotify';   # 回调通知地址
        
        $secret = '40a658ab0bfd4db6b257443379aba84f';     # app secret, 在个人中心配置页面查看
        $api_url = 'https://xorpay.com/api/pay/15627';   # 付款请求接口，在个人中心配置页面查看
        //$api_url = 'https://xorpay.com/api/cashier/15627';http://wx.dzyywx.com/music/index/mykecheng
    
        function sign($data_arr) {
            return md5(join('',$data_arr));
        };
    
        $sign = sign(array($name, $pay_type, $price, $order_id, $notify_url, $secret));
        
        //使用方法
        $post_data = array(
          'name' => $name,
          'pay_type' => $pay_type,
          'price'=>$course_information['resource_price'],
          'order_id'=>$order_id,
          'notify_url'=>$notify_url,
          'sign'=>$sign,
          'openid'=>$openid,
          'return_url'=>'http://wx.dzyywx.com/music/shop/myzy'
        );
        $res = $this->send_post($api_url, $post_data);
        //Log::record($post_data,'notice');
        //return $res;
        $obj = json_decode($res);
        return $obj->info->qr;
    }
    
    //获取资源分类
    public function getzyfl(){
        $resource_classifications = Db::table("resource_classification")->where('delete_time',null)->order("collation")->select();
        return json($resource_classifications);
    }
    
    //按分类获取资源列表
    public function getzyf(){
        $postdata = input("post.");
        $resource_classification = $postdata['resource_classification'];
        $download_resourcess = Db::table("download_resources")->where("delete_time",null);
        if($resource_classification!=''){
            $download_resourcess = $download_resourcess->where("resource_classification",$resource_classification);
        }
        $download_resourcess = $download_resourcess->order("creation_time desc")->limit(50)->select();
        return json($download_resourcess);
    }
    
    
    //获取资源列表
    public function getzy(){
        $postdata = input("post.");
        $cxtj = $postdata['cxtj'];
        $download_resourcess = Db::table("download_resources")->alias('a')->join('resource_classification b','a.resource_classification = b.RESOURCE_CLASSIFICATION_ID')->where("a.delete_time",null);
        if($cxtj!=''){
            $download_resourcess = $download_resourcess->where("resource_name like '%".$cxtj."%'");
        }
        $download_resourcess = $download_resourcess->order("b.collation,a.creation_time desc")->limit(50)->select();
        return json($download_resourcess);
    }
    
    //资源首页
    public function ziyuan(){
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        if(!$this->updateUser_($openid)){
            $this->redirect('music/index/ydgzh');
        }
        $cxtj = Session::get('cxtj');
        $this->assign('cxtj', $cxtj);
        return $this->fetch();
    }
    
    //会员支付通知
    public function hyzftz(){
        $postdata = input("post.");
        //Log::record("notify:".json_encode($postdata['order_id']),'notice');
        $cs = Db::table("purchase_records")->where("order_number",$postdata['order_id'])->count();
        if($cs==0){
            Db::table("unified_order")->where("order_id",$postdata['order_id'])->update(['pay_or_not'=>'已支付']);
            $unified_order = Db::table("unified_order")->where("order_id",$postdata['order_id'])->find();
            if($unified_order['product_description']=='月VIP'){
                Db::table("user_list")->where('USER_LIST_ID',$unified_order['customer_id'])->update(['vip_or_not'=>'是','vip_expiration_date'=>date("Y-m-d",strtotime("+1 month")),'membership_type'=>$unified_order['product_description']]);
            }else if($unified_order['product_description']=='季度VIP'){
                Db::table("user_list")->where('USER_LIST_ID',$unified_order['customer_id'])->update(['vip_or_not'=>'是','vip_expiration_date'=>date("Y-m-d",strtotime("+3 month")),'membership_type'=>$unified_order['product_description']]);
            }else if($unified_order['product_description']=='半年VIP'){
                Db::table("user_list")->where('USER_LIST_ID',$unified_order['customer_id'])->update(['vip_or_not'=>'是','vip_expiration_date'=>date("Y-m-d",strtotime("+6 month")),'membership_type'=>$unified_order['product_description']]);
            }else if($unified_order['product_description']=='年VIP'){
                Db::table("user_list")->where('USER_LIST_ID',$unified_order['customer_id'])->update(['vip_or_not'=>'是','vip_expiration_date'=>date("Y-m-d",strtotime("+1 year")),'membership_type'=>$unified_order['product_description']]);
            }
            $uuid = Db::query("select uuid() as uuid_")[0]['uuid_'];
            Db::table("member_purchase_record")->insert(['MEMBER_PURCHASE_RECORD_ID'=>$uuid,'membership_type'=>$unified_order['product_description'],'buyer_id'=>$unified_order['customer_id'],'purchase_amount'=>$unified_order['commodity_amount'],'purchase_time'=>date("Y-m-d")]);
        }
    }
    
    //支付会员
    public function zfhy(){
        $openid = getOpenid();
        $pay_type = 'native'; 
        $postdata = input("post.");
        $name = $postdata['name'];
        $price = $postdata['price'];
        $order_id = time();
        $notify_url = "http://wx.dzyywx.com/music/shop/hyzftz";
        $return_url = "http://wx.dzyywx.com/music";
        $user_list = Db::table("user_list")->where('OPENID',$openid)->find();
        $uuid = Db::query("select uuid() as uuid_")[0]['uuid_'];
        $customer_id = $user_list['USER_LIST_ID'];
        Db::table("unified_order")->insert(['UNIFIED_ORDER_ID'=>$uuid,'customer_id'=>$customer_id,'product_description'=>$name,'order_id'=>$order_id,'commodity_amount'=>$price]);
        return $this->getxorpay($name, $pay_type, $price, $order_id, $notify_url, $openid,$return_url);
    }
    
    //已经是vip
    public function viphuiyuan(){
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        if(!$this->updateUser_($openid)){
            $this->redirect('music/index/ydgzh');
        }
        $user_list = Db::table("user_list")->where('OPENID',$openid)->find();
        $user_list['NICKNAME'] = json_decode($user_list['NICKNAME']);
        if($user_list['vip_expiration_date']!=null){
            $user_list['vip_expiration_date'] = substr($user_list['vip_expiration_date'],0,10);
        }else{
            $user_list['vip_expiration_date'] = '';
        }
        $this->assign('user_list', $user_list);
        return $this->fetch();
    }
    
    //会员
    public function huiyuan(){
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        if(!$this->updateUser_($openid)){
            $this->redirect('music/index/ydgzh');
        }
        $user_list = Db::table("user_list")->where('OPENID',$openid)->find();
        if($user_list['vip_or_not']=='是'){
            $zero1=date("y-m-d h:i:s");
            if(strtotime($zero1)<strtotime($user_list['vip_expiration_date'])){
                $this->redirect('music/shop/viphuiyuan');
            }
        }
        $user_list['NICKNAME'] = json_decode($user_list['NICKNAME']);
        if($user_list['membership_type']==null){
            $user_list['membership_type'] = '普通会员';
        }
        if($user_list['vip_expiration_date']!=null){
            $user_list['vip_expiration_date'] = substr($user_list['vip_expiration_date'],0,10);
        }else{
            $user_list['vip_expiration_date'] = '';
        }
        $membership_settings = Db::table("membership_settings")->order("collation")->select();
        $this->assign('membership_settings0', $membership_settings[0]);
        $this->assign('membership_settings1', $membership_settings[1]);
        $this->assign('membership_settings2', $membership_settings[2]);
        $this->assign('membership_settings3', $membership_settings[3]);
        $this->assign('user_list', $user_list);
        return $this->fetch();
    }
    
    public function notify(){
        $postdata = input("post.");
        //Log::record("notify:".json_encode($postdata['order_id']),'notice');
        $cs = Db::table("purchase_records")->where("order_number",$postdata['order_id'])->count();
        if($cs==0){
            Db::table("unified_order")->where("order_id",$postdata['order_id'])->update(['pay_or_not'=>'已支付']);
            $unified_order = Db::table("unified_order")->where("order_id",$postdata['order_id'])->find();
            $uuid = Db::query("select uuid() as uuid_")[0]['uuid_'];
            Db::table("purchase_records")->insert(['PURCHASE_RECORDS_ID'=>$uuid,'commodity_id'=>$unified_order['commodity_id'],'buyer_id'=>$unified_order['customer_id'],'payment_time'=>date("Y-m-d H:i:s"),'commodity_amount'=>$unified_order['commodity_amount'],'freight_amount'=>$unified_order['freight_amount'],'buyer_message'=>$unified_order['buyer_message'],'purchase_quantity'=>$unified_order['quantity_of_goods'],'shipping_address'=>$unified_order['shipping_address'],'order_number'=>$unified_order['order_id'],'addressee'=>$unified_order['consignee'],'contact_number'=>$unified_order['contact_number']]);
            $commodity_information = Db::table('commodity_information')->where("COMMODITY_INFORMATION_ID",$unified_order['commodity_id'])->find();
            $number_of_purchased = $commodity_information['number_of_purchased'];
            $number_of_purchased = $number_of_purchased+1;
            Db::table('commodity_information')->where("COMMODITY_INFORMATION_ID",$unified_order['commodity_id'])->update(['number_of_purchased'=>$number_of_purchased]);
        }
    }
    
    function send_post($url, $post_data) {
     
      $postdata = http_build_query($post_data);
      $options = array(
        'http' => array(
          'method' => 'POST',
          'header' => 'Content-type:application/x-www-form-urlencoded',
          'content' => $postdata,
          'timeout' => 15 * 60 // 超时时间（单位:s）
        )
      );
      $context = stream_context_create($options);
      $result = file_get_contents($url, false, $context);
     
      return $result;
    }
    
    //提交订单
    public function djdd(){
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        $user_list = Db::table("user_list")->where('OPENID',$openid)->find();
        $postdata = input("post.");
        $uuid = Db::query("select uuid() as uuid_")[0]['uuid_'];
        $commodity_id = $postdata['commodity_id'];
        $commodity_information = Db::table("commodity_information")->where("COMMODITY_INFORMATION_ID",$commodity_id)->find();
        $customer_id = $user_list['USER_LIST_ID'];
        $order_id = time();
        $buyer_message = $postdata['buyer_message'];
        $quantity_of_goods = $postdata['quantity_of_goods'];
        $commodity_amount = $postdata['commodity_amount'];
        $freight_amount = $postdata['freight_amount'];
        $shipping_address = $postdata['shipping_address'];
        $consignee = $postdata['consignee'];
        $contact_number = $postdata['contact_number'];
        Db::table("unified_order")->insert(['UNIFIED_ORDER_ID'=>$uuid,'commodity_id'=>$commodity_id,'customer_id'=>$customer_id,'order_id'=>$order_id,'buyer_message'=>$buyer_message,'quantity_of_goods'=>$quantity_of_goods,'commodity_amount'=>$commodity_amount,'freight_amount'=>$freight_amount,'shipping_address'=>$shipping_address,'consignee'=>$consignee,'contact_number'=>$contact_number]);
        $name = $commodity_information['trade_name'];  # 订单商品名称
        //$name = "native 测试订单";
        //$pay_type = 'jsapi';     # 付款方式
        $pay_type = 'native'; 
        
        $notify_url = 'http://wx.dzyywx.com/music/shop/notify';   # 回调通知地址
        
        
        //$api_url = 'https://xorpay.com/api/cashier/15627';
    
        
        $price = $commodity_amount+$freight_amount;
        $return_url = 'http://wx.dzyywx.com/music/shop/wddd';
        return $this->getxorpay($name, $pay_type, $price, $order_id, $notify_url, $openid,$return_url);
    }
    
    public function sign($data_arr) {
            return md5(join('',$data_arr));
        }
    
    //获取支付地址
    public function getxorpay($name, $pay_type, $price, $order_id, $notify_url, $openid,$return_url){
        $secret = '40a658ab0bfd4db6b257443379aba84f';     # app secret, 在个人中心配置页面查看
        $api_url = 'https://xorpay.com/api/pay/15627';   # 付款请求接口，在个人中心配置页面查看
        $sign = $this->sign(array($name, $pay_type, $price, $order_id, $notify_url, $secret));
        
        //使用方法
        $post_data = array(
          'name' => $name,
          'pay_type' => $pay_type,
          'price'=>$price,
          'order_id'=>$order_id,
          'notify_url'=>$notify_url,
          'sign'=>$sign,
          'openid'=>$openid,
          //'return_url'=>'http://wx.dzyywx.com/music/shop/wddd'
          'return_url'=>$return_url
        );
        $res = $this->send_post($api_url, $post_data);
        Log::record(json_encode($post_data),'notice');
        //return $res;
        $obj = json_decode($res);
        return $obj->info->qr;
    }
    
    //编辑地址
    public function bjdz($id,$COMMODITY_INFORMATION_ID){
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        if(!$this->updateUser_($openid)){
            $this->redirect('music/index/ydgzh');
        }
        $shipping_address = Db::table('shipping_address')->where("SHIPPING_ADDRESS_ID",$id)->find();
        $this->assign('shipping_address', $shipping_address);
        $this->assign('COMMODITY_INFORMATION_ID', $COMMODITY_INFORMATION_ID);
        return $this->fetch();
    }
    
    //订单详情
    public function ddxq($id){
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        if(!$this->updateUser_($openid)){
            $this->redirect('music/index/ydgzh');
        }
        $purchase_records = Db::table('purchase_records')->alias('a')->join('commodity_information b','a.commodity_id = b.COMMODITY_INFORMATION_ID')->where("PURCHASE_RECORDS_ID",$id)->find();
        $purchase_records['delivery_time'] = substr($purchase_records['delivery_time'],0,10);
        $this->assign('purchase_records', $purchase_records);
        return $this->fetch();
    }
    
    //订单查询
    public function ddcx(){
        $postdata = input("post.");
        $cxtj = $postdata['cxtj'];
        $openid = getOpenid();
        $user_list = Db::table("user_list")->where('OPENID',$openid)->find();
        $purchase_records = Db::table('purchase_records')->alias('a')->join('commodity_information b','a.commodity_id = b.COMMODITY_INFORMATION_ID')->field('COMMODITY_INFORMATION_ID,trade_name,commodity_price,original_price_of_goods,number_of_purchased,add_time,is_it_on_the_shelf,product_picture,collation,commodity_specifications,place_of_delivery,freight,commodity_attributes,a.*')->where("buyer_id",$user_list['USER_LIST_ID']);
        if($cxtj!=''){
            $purchase_records = $purchase_records->where("trade_name like '%".$cxtj."%'");
        }
        $purchase_records = $purchase_records->order("payment_time desc")->limit(50)->select();
        return json($purchase_records);
    }
    
    //我的订单
    public function wddd(){
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        if(!$this->updateUser_($openid)){
            $this->redirect('music/index/ydgzh');
        }
        return $this->fetch();
    }
    
    //删除地址
    public function scdz(){
        $postdata = input("post.");
        $SHIPPING_ADDRESS_ID = $postdata['SHIPPING_ADDRESS_ID'];
        Db::table('shipping_address')->where("SHIPPING_ADDRESS_ID",$SHIPPING_ADDRESS_ID)->update(['delete_time'=>time()]);
        return 'ok';
    }
    
    //获取地址
    public function getdz($id){
        $shipping_address = Db::table('shipping_address')->where("SHIPPING_ADDRESS_ID",$id)->find();
        return json($shipping_address);
    }
    
    //获取地址列表
    public function getdzs(){
        $openid = getOpenid();
        $shipping_address = Db::table('shipping_address')->where("delete_time",null)->where("openid",$openid)->order("add_time desc")->select();
        return json($shipping_address);
    }
    
    //修改地址
    public function updatedz(){
        $postdata = input("post.");
        Db::table('shipping_address')->where("SHIPPING_ADDRESS_ID",$postdata['SHIPPING_ADDRESS_ID'])->update($postdata);
        return 'ok';
    }
    
    //保存地址
    public function savedz(){
        $postdata = input("post.");
        $openid = getOpenid();
        $uuid = Db::query("select uuid() as uuid_")[0]['uuid_'];
        $postdata['SHIPPING_ADDRESS_ID'] = $uuid;
        $postdata['openid'] = $openid;
        $postdata['add_time'] = date('Y-m-d H:i:s');
        Db::table('shipping_address')->insert($postdata);
        return 'ok';
    }
    
    //添加地址
    public function adddz($COMMODITY_INFORMATION_ID){
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        if(!$this->updateUser_($openid)){
            $this->redirect('music/index/ydgzh');
        }
        $this->assign('COMMODITY_INFORMATION_ID', $COMMODITY_INFORMATION_ID);
        return $this->fetch();
    }
    
    //地址编辑
    public function dzbj($id){
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        if(!$this->updateUser_($openid)){
            $this->redirect('music/index/ydgzh');
        }
        $COMMODITY_INFORMATION_ID = $id;
        $this->assign('COMMODITY_INFORMATION_ID', $COMMODITY_INFORMATION_ID);
        return $this->fetch();
    }
    
    public function goumai($id,$SHIPPING_ADDRESS_ID=''){
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        if(!$this->updateUser_($openid)){
            $this->redirect('music/index/ydgzh');
        }
        $user_list = Db::table("user_list")->where('OPENID',$openid)->find();
        
        $commodity_information = Db::table('commodity_information')->where("COMMODITY_INFORMATION_ID",$id)->find();
        
        //如果是会员写入折扣信息
        $user_list['zk'] = 1;
        if($user_list['vip_or_not']=='是'){
            $zero1=date("y-m-d h:i:s");
            if(strtotime($zero1)<strtotime($user_list['vip_expiration_date'])){
                $user_list['zk'] = $commodity_information['member_discount'];
            }
        }
        $commodity_information['member_discount'] = $commodity_information['member_discount']*10;
        $this->assign('commodity_information', $commodity_information);
        $this->assign('SHIPPING_ADDRESS_ID',$SHIPPING_ADDRESS_ID);
        $this->assign('user_list',$user_list);
        return $this->fetch();
    }
    
    public function getsps(){
        $postdata = input("post.");
        $cxtj = $postdata['cxtj'];
        $commodity_informations = Db::table('commodity_information')->field('COMMODITY_INFORMATION_ID,trade_name,commodity_price,original_price_of_goods,number_of_purchased,add_time,is_it_on_the_shelf,product_picture,collation,commodity_specifications,place_of_delivery,freight,commodity_attributes')->where("delete_time",null)->where("is_it_on_the_shelf","是");
        if($cxtj!=''){
            $commodity_informations=$commodity_informations->where("trade_name like '%".$cxtj."%'");
        }
        $commodity_informations = $commodity_informations->order("collation,add_time desc")->limit(500)->select();
        return json($commodity_informations);
    }
    
    //商品页
    public function spye($id){
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        if(!$this->updateUser_($openid)){
            $this->redirect('music/index/ydgzh');
        }
        $commodity_information = Db::table('commodity_information')->where("COMMODITY_INFORMATION_ID",$id)->find();
        $product_pictures = Db::table('product_picture')->where("delete_time",null)->where('commodity_id',$id)->order("display_order")->select();
        $commodity_information['product_pictures'] = $product_pictures;
        $this->assign('commodity_information', $commodity_information);
        $slt = str_replace('http://zhangfeng2020.oss-cn-zhangjiakou.aliyuncs.com','http://admin.dzyywx.com',$product_pictures[0]['product_picture']);
        //$stl = "http://admin.dzyywx.com/MultimediaFiles/20200811/3acf11486f4645890c89f630ce31d5ab.png";
        $this->assign('slt',$slt);
        return $this->fetch();
    }
}