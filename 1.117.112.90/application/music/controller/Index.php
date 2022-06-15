<?php
namespace app\music\controller;

use think\Db;
use think\Url;
use think\Log;
use think\Controller;
use think\Session;

class Index extends Controller
{
    public function index()
    {
        $openid = getOpenid();
        //Log::record("getOpenid:".json_encode($openid));
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        if(!$this->updateUser_($openid)){
            $this->redirect('music/index/ydgzh');
        }
        //return json_encode($openid);
        //$course_informations = Db::table("course_information")->order("creation_time desc")->limit(10)->select();
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
        //$this->assign('course_informations', $course_informations);
        return $this->fetch();
    }
    
    
    
    //引导关注公众号
    public function ydgzh(){
        return $this->fetch();
    }
    
    
    //连续签到判断
    public function lxqdpd($jt,$student_openid){
        $zuotian = date("Y-m-d",strtotime("-".$jt." day"));
        $qdcount = Db::table("student_sign_in")->where("student_openid",$student_openid)->where("check_in_time>='".$zuotian."'")->where("check_in_time <= '".$zuotian." 23:59:59'")->count();
        if($qdcount>0){
            return true;
        }else{
            return false;
        }
    }
    
    //连续签到几天
    public function lxqdjt(){
        $postdata = input("post.");
        $student_openid = $postdata['student_openid'];
        if($this->lxqdpd("0",$student_openid)){
            if($this->lxqdpd("1",$student_openid)){
                if($this->lxqdpd("2",$student_openid)){
                    if($this->lxqdpd("3",$student_openid)){
                        if($this->lxqdpd("4",$student_openid)){
                            if($this->lxqdpd("5",$student_openid)){
                                return "5+";
                            }else{
                                return "5";
                            }
                        }else{
                            return "4";
                        }
                    }else{
                        return "3";
                    }
                }else{
                    return "2";
                }
            }else{
                return "1";
            }
        }else{
            return "0";
        }
    }
    
    //前5天签到情况
    public function qwtqdqk(){
        $postdata = input("post.");
        $student_openid = $postdata['student_openid'];
        $jt = ['rq'=>'今天','dk'=>$this->lxqdpd("0",$student_openid)];
        $qyt = ['rq'=>date("m-d",strtotime("-1 day")),'dk'=>$this->lxqdpd("1",$student_openid)];
        $qet = ['rq'=>date("m-d",strtotime("-2 day")),'dk'=>$this->lxqdpd("2",$student_openid)];
        $qst = ['rq'=>date("m-d",strtotime("-3 day")),'dk'=>$this->lxqdpd("3",$student_openid)];
        $qsit = ['rq'=>date("m-d",strtotime("-4 day")),'dk'=>$this->lxqdpd("4",$student_openid)];
        $hyt = ['rq'=>date("m-d",strtotime("1 day"))];
        $hrt = ['rq'=>date("m-d",strtotime("2 day"))];
        $qdqk = [$jt,$qyt,$qet,$qst,$qsit,$hyt,$hrt];
        return json($qdqk);
    }
    
    //学员签到
    public function qiandao(){
        $postdata = input("post.");
        $uuid = Db::query("select uuid() as uuid_")[0]['uuid_'];
        $postdata['STUDENT_SIGN_IN_ID'] = $uuid;
        $postdata['check_in_time'] = date("Y-m-d H:i:s");
        Db::table("student_sign_in")->insert($postdata);
        $uuid = Db::query("select uuid() as uuid_")[0]['uuid_'];
        Db::table("integral_record")->insert(['INTEGRAL_RECORD_ID'=>$uuid,'student_openid'=>$postdata['student_openid'],'integral_time'=>date("Y-m-d H:i:s"),'integral_value'=>5,'points_log'=>'每日打卡积分+5']);
        $user_list = Db::table("user_list")->where("OPENID",$postdata['student_openid'])->find();
        Db::table("user_list")->where("OPENID",$postdata['student_openid'])->update(['integral'=>($user_list['integral']+5)]);
        if($this->lxqdpd("1",$postdata['student_openid'])){
            if($this->lxqdpd("2",$postdata['student_openid'])){
                
            }else{
                return "2";
            }
        }else{
            return "1";
        }
    }
    
    public function daka(){
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        if(!$this->updateUser_($openid)){
            $this->redirect('music/index/ydgzh');
        }
        $user_list = Db::table("user_list")->where("OPENID",$openid)->find();
        $this->assign('openid', $openid);
        $this->assign('user', $user_list);
        return $this->fetch();
    }
    
    public function chaxun2(){
        $openid = getOpenid();
        $postdata = input("post.");
        $cxtj = $postdata['cxtj'];
        $course_informations = Db::table('course_purchase_record')->alias('a')->join('course_information b','a.course_id = b.COURSE_INFORMATION_ID')->join('user_list c','a.buyer_id = c.USER_LIST_ID')->where("c.OPENID",$openid);
        if($cxtj!=''){
            $course_informations = $course_informations->where("b.course_title like '%".$cxtj."%'");
        }
        $course_informations = $course_informations->order("purchase_time desc")->limit(50)->select();
        return json($course_informations);
        //Session::set('cxtj',$cxtj);
    }
    
    public function chaxun1(){
        $postdata = input("post.");
        $cxtj = $postdata['cxtj'];
        $course_informations = Db::table("course_information")->where("delete_time",null);
        if($cxtj!=''){
            $course_informations = $course_informations->where("course_title like '%".$cxtj."%'");
        }
        $course_informations = $course_informations->limit(50)->select();
        return json($course_informations);
        //Session::set('cxtj',$cxtj);
    }
    
    public function chaxun0(){
        $postdata = input("post.");
        $cxtj = $postdata['cxtj'];
        Session::set('cxtj',$cxtj);
    }
    
    public function chaxun(){
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
    
    public function kcfllb(){
        $course_classifications = Db::table("course_classification")->where("delete_time",null)->order("add_time")->select();
        return json($course_classifications);
    }
    
    //课程列表
    public function kclb(){
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        if(!$this->updateUser_($openid)){
            $this->redirect('music/index/ydgzh');
        }
        return $this->fetch();
    }
    
    public function getcourse_informationssw(){
        $postdata = input("post.");
        if(isset($postdata['COURSE_CLASSIFICATION_ID'])){
            $COURSE_CLASSIFICATION_ID = $postdata['COURSE_CLASSIFICATION_ID'];
            $course_informations = Db::table("course_information")->where('course_classification',$COURSE_CLASSIFICATION_ID)->where("delete_time",null)->order("collation")->order("creation_time desc")->limit(100)->select();
        }else{
            $course_informations = Db::table("course_information")->where("delete_time",null)->order("collation")->order("creation_time desc")->limit(100)->select();
        }
        return json($course_informations);
    }
    
    public function getcourse_informationss(){
        $course_informations = Db::table("course_information")->where("delete_time",null)->order("collation")->order("creation_time desc")->limit(100)->select();
        return json($course_informations);
    }
    
    public function getcourse_informations(){
        $course_informations = Db::table("course_information")->where("delete_time",null)->order("collation")->order("creation_time desc")->limit(10)->select();
        foreach ($course_informations as $key => &$value) {
            if($value['membership_course_or_not']=='是'){
                $value['membership_course_or_not']='VIP免费';
            }else{
                $value['membership_course_or_not']='';
            }
        }
        return json($course_informations);
    }
    
    public function getChat(){
        $postdata = input("post.");
        $course_id = $postdata['course_id'];
        $speaker_id = $postdata['speaker_id'];
        $chat_records = Db::table("chat_record")->where("course_id",$course_id)->order("speaking_time")->limit(10)->select();
        foreach ($chat_records as $key => &$value) {
            $value['what_to_say'] = json_decode($value['what_to_say']);
        }
        return json($chat_records);
    }
    
    public function saveChat(){
        $postdata = input("post.");
        $uuid = Db::query("select uuid() as uuid_")[0]['uuid_'];
        $postdata['CHAT_RECORD_ID'] = $uuid;
        $postdata['speaking_time'] = date('Y-m-d H:i:s');
        $postdata['what_to_say'] = json_encode($postdata['what_to_say']);
        //Log::record("chat_record:".json_encode($postdata),'notice');
        Db::table("chat_record")->insert($postdata);
        return 'ok';
    }
    
    //购买课程
    public function gmck($id){
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        if(!$this->updateUser_($openid)){
            $this->redirect('music/index/ydgzh');
        }
        $user_list = Db::table("user_list")->where('OPENID',$openid)->find();
        if(Db::table("course_purchase_record")->where('course_id',$id)->where('buyer_id',$user_list['USER_LIST_ID'])->count()>0){
           $this->redirect('kecheng',['id'=>$id]);
        }
        $course_information = Db::table("course_information")->where('COURSE_INFORMATION_ID',$id)->find();
        $course_information['course_pictures'] = str_replace('http://zhangfeng2020.oss-cn-zhangjiakou.aliyuncs.com','http://admin.dzyywx.com',$course_information['course_pictures']);
        $this->assign('course_information', $course_information);
        return $this->fetch();
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
    
    //即将上线
    public function jjsx(){
        return $this->fetch();
    }
    
    //我的课程
    public function mykecheng(){
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        if(!$this->updateUser_($openid)){
            $this->redirect('music/index/ydgzh');
        }
        $this->assign('openid', $openid);
        return $this->fetch();
    }
    
    public function notify(){
        $postdata = input("post.");
        //Log::record("notify:".json_encode($postdata['order_id']),'notice');
        Db::table("unified_order")->where("order_id",$postdata['order_id'])->update(['pay_or_not'=>'已支付']);
        $unified_order = Db::table("unified_order")->where("order_id",$postdata['order_id'])->find();
        $uuid = Db::query("select uuid() as uuid_")[0]['uuid_'];
        Db::table("course_purchase_record")->insert(['COURSE_PURCHASE_RECORD_ID'=>$uuid,'course_id'=>$unified_order['commodity_id'],'buyer_id'=>$unified_order['customer_id'],'purchase_time'=>date("Y-m-d H:i:s"),'purchase_amount'=>$postdata['pay_price']]);
    }
    
    public function getzfurl(){
        $postdata = input("post.");
        $order_id = time();    # 自己创建的本地订单号
        $price = $postdata['price']; # 从 URL 获取充值金额 price
        $commodity_id = $postdata['commodity_id'];
        $course_information = Db::table("course_information")->where("COURSE_INFORMATION_ID",$commodity_id)->find();
        $openid = getOpenid();
        $user_list = Db::table("user_list")->where('OPENID',$openid)->find();
        $uuid = Db::query("select uuid() as uuid_")[0]['uuid_'];
        Db::table("unified_order")->insert(['UNIFIED_ORDER_ID'=>$uuid,'commodity_id'=>$commodity_id,'customer_id'=>$user_list['USER_LIST_ID'],'order_id'=>$order_id]);
        $name = $course_information['course_title'];  # 订单商品名称
        //$name = "native 测试订单";
        //$pay_type = 'jsapi';     # 付款方式
        $pay_type = 'native'; 
        
        $notify_url = 'http://wx.dzyywx.com/music/index/notify';   # 回调通知地址
        
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
          'price'=>$course_information['course_price'],
          'order_id'=>$order_id,
          'notify_url'=>$notify_url,
          'sign'=>$sign,
          'openid'=>$openid,
          'return_url'=>'http://wx.dzyywx.com/music/index/mykecheng'
        );
        $res = $this->send_post($api_url, $post_data);
        //Log::record($post_data,'notice');
        //return $res;
        $obj = json_decode($res);
        return $obj->info->qr;
    }
    
    public function ysdw($id){
        
        //return json_encode($openid);
        //$openid="";
        $t_audio_book_page = Db::table("t_audio_book_page")->where('T_AUDIO_BOOK_PAGE_ID',$id)->find();
        $this->assign('t_audio_book_page', $t_audio_book_page);
        
        return $this->fetch();
    }
    
    public function kecheng($id)
    {
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        if(!$this->updateUser_($openid)){
            $this->redirect('music/index/ydgzh');
        }
        //return json_encode($openid);
        //$openid="";
        $this->assign('openid', $openid);
        $course_information = Db::table("course_information")->where('COURSE_INFORMATION_ID',$id)->find();
        $user_list = Db::table("user_list")->where('OPENID',$openid)->find();
        
        if($course_information['number_of_learners']==null){
            $course_information['number_of_learners']=0;
        }
        $course_information['number_of_learners']++;
        Db::table("course_information")->where('COURSE_INFORMATION_ID',$id)->update(['number_of_learners'=>$course_information['number_of_learners']]);
        //$this->assign('id', $id);
        $this->assign('course_information', $course_information);
        
        //判断是否是会员
        if($course_information['membership_course_or_not']=='是'){
            if($user_list['vip_or_not']=='是'){
                $zero1=date("y-m-d h:i:s");
                if(strtotime($zero1)<strtotime($user_list['vip_expiration_date'])){
                    return $this->fetch();
                }
            }
        }
        //判断是否购买了课程
        if(Db::table("course_purchase_record")->where('course_id',$id)->where('buyer_id',$user_list['USER_LIST_ID'])->count()==0){
            if($course_information['course_price']>0){
                $this->redirect('gmck',['id'=>$id]);
                //$this->redirect('shikan',['id'=>$id]);
            }
        }
        
        return $this->fetch();
    }
    
    //试看
    public function shikan($id){
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        if(!$this->updateUser_($openid)){
            $this->redirect('music/index/ydgzh');
        }
        //return json_encode($openid);
        //$openid="";
        $this->assign('openid', $openid);
        $course_information = Db::table("course_information")->where('COURSE_INFORMATION_ID',$id)->find();
        $user_list = Db::table("user_list")->where('OPENID',$openid)->find();
        
        if($course_information['number_of_learners']==null){
            $course_information['number_of_learners']=0;
        }
        $course_information['number_of_learners']++;
        Db::table("course_information")->where('COURSE_INFORMATION_ID',$id)->update(['number_of_learners'=>$course_information['number_of_learners']]);
        //$this->assign('id', $id);
        $this->assign('course_information', $course_information);
        
        //判断是否是会员
        if($course_information['membership_course_or_not']=='是'){
            if($user_list['vip_or_not']=='是'){
                $zero1=date("y-m-d h:i:s");
                if(strtotime($zero1)<strtotime($user_list['vip_expiration_date'])){
                    return $this->fetch();
                }
            }
        }
        return $this->fetch();
    }
    
    public function saveReverse_of_id_card(){
        $postdata = input("post.");
        $BROADBAND_ORDERS_ID = $postdata['BROADBAND_ORDERS_ID'];
        $serverId = $postdata['serverId'];
        $media = & load_wechat('Media');
        $result = $media->getMedia($serverId);
        $HttpPath = saveUploadFile($result,$serverId);
        Db::table("broadband_orders")->where("BROADBAND_ORDERS_ID",$BROADBAND_ORDERS_ID)->update(['reverse_of_id_card'=>$HttpPath]);
        return 'ok';
    }
    
    public function saveFront_of_id_card(){
        $postdata = input("post.");
        $BROADBAND_ORDERS_ID = $postdata['BROADBAND_ORDERS_ID'];
        $serverId = $postdata['serverId'];
        $media = & load_wechat('Media');
        $result = $media->getMedia($serverId);
        $HttpPath = saveUploadFile($result,$serverId);
        Db::table("broadband_orders")->where("BROADBAND_ORDERS_ID",$BROADBAND_ORDERS_ID)->update(['front_of_id_card'=>$HttpPath]);
        return 'ok';
    }
    
    //群发通知
    //$notification_type:通知类型
    //$notification_content：通知内容
    public function MassNotification($notification_type,$notification_content){
        $salesmans = $this->FilteredNotifiedPerson();
        foreach ($salesmans as $key => $value) {
            $uuid = Db::query("select uuid() as uuid_");
            $data = ['NOTICE_REMINDING_ID'=>$uuid[0]['uuid_'],'notified_openid'=>$value['openid'],'notification_time'=>date('Y-m-d H:i:s'),'notification_type'=>$notification_type,'notification_content'=>$notification_content];
            Db::table('notice_reminding')->insert($data);
        }
    }
    
    //被通知人筛选
    public function FilteredNotifiedPerson(){
        $salesman = Db::table('salesman')->where('serve_as_a_post','=','超级管理员')->whereOr('serve_as_a_post','=','调度')->whereOr('serve_as_a_post','=','营业厅经理')->whereOr('serve_as_a_post','=','营业厅文员')->select();
        return $salesman;
    }
    
    //行政区
    public function getAdministrativeArea(){
        $AdministrativeArea = Db::table('administrative_area')->where('delete_time',null)->order('display_order')->select();
        return json($AdministrativeArea);
    }
    
    //资源查询
    public function ResourceQuery(){
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        if(!$this->updateUser_($openid)){
            $this->redirect('music/index/ydgzh');
        }
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        return $this->fetch();
    }
    
    //资源查询结果
    public function ResourceQueryResults(){
        $postdata = input("post.");
        $address = $postdata['address'];
        //$address = '铁西';
        $BroadbandInstallationResources = \app\index\model\BroadbandInstallationResources::where('region','like','%'.$address.'%')->whereOr('street','like','%'.$address.'%')->whereOr('lane_village','like','%'.$address.'%')->whereOr('residential_quarters','like','%'.$address.'%')->whereOr('street_name','like','%'.$address.'%')->whereOr('building_number','like','%'.$address.'%')->select();
        return json($BroadbandInstallationResources);
    }
    
    public function Faq(){
        $TextInformations = \app\index\model\TextInformation::get(['text_title'=>'FAQ']);
        $this->assign('TextInformations', $TextInformations);
        return $this->fetch();
    }
    
    public function Leaflets(){
        $TextInformations = \app\index\model\TextInformation::get(['text_title'=>'宣传单']);
        $this->assign('TextInformations', $TextInformations);
        return $this->fetch();
    }
    
    //业绩查询
    public function PerformanceEnquiry(){
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        if(!$this->updateUser_($openid)){
            $this->redirect('music/index/ydgzh');
        }
        return $this->fetch();
    }
    
    //时间轴
    public function Timeline($id){
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        if(!$this->updateUser_($openid)){
            $this->redirect('music/index/ydgzh');
        }
        $this->assign('BROADBAND_ORDERS_ID', $id);
        $OperationLogs = \app\index\model\OperationLog::where('correlation_id',$id)->order('OPERATING_TIME desc')->select();
        $this->assign('OperationLogs', $OperationLogs);
        return $this->fetch();
    }
    
    //业绩明细
    public function PerformanceDetails(){
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        if(!$this->updateUser_($openid)){
            $this->redirect('music/index/ydgzh');
        }
        $StartTime = session('StartTime');
        $EndTime = session('EndTime');
        $BroadbandPerformance = \app\index\model\BroadbandPerformance::where("openid","=",$openid);
        if($StartTime!=""){
            $StartTime = str_replace('/','-',$StartTime);
            $BroadbandPerformance = $BroadbandPerformance->where('performance_time','>=',$StartTime);
        }
        if($EndTime!=""){
            $EndTime = str_replace('/','-',$EndTime).'';
            $BroadbandPerformance = $BroadbandPerformance->where('performance_time','<',$EndTime);
        }
        $BroadbandPerformance = $BroadbandPerformance->order("performance_time desc")->select();
        //return json_encode($StartTime);
        $this->assign('BroadbandPerformance', $BroadbandPerformance);
        session('StartTime', null);
        session('EndTime', null);
        return $this->fetch();
    }
    
    //业绩查询结果
    public function PerformanceQueryResults(){
        $postdata = input("post.");
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        if(!$this->updateUser_($openid)){
            $this->redirect('music/index/ydgzh');
        }
        session('StartTime', $postdata['StartTime']);
        session('EndTime', $postdata['EndTime']);
        $TotalPerformance = Db::table('broadband_performance')->where('openid','=',$openid);
        $PersonalPerformance = Db::table('broadband_performance')->where('openid','=',$openid)->where('performance_category','=','个人绩效');
        $TeamPerformance = Db::table('broadband_performance')->where('openid','=',$openid)->where(function ($query) {$query->where('performance_category', '=', '一级员工奖励')->whereOr('performance_category', '=', '二级员工奖励');});
        if($postdata['StartTime']!=''){
            $StartTime = str_replace('/','-',$postdata['StartTime']);
            $TotalPerformance = $TotalPerformance->where('performance_time','>=',$StartTime);
            $PersonalPerformance = $PersonalPerformance->where('performance_time','>=',$StartTime);
            $TeamPerformance = $TeamPerformance->where('performance_time','>=',$StartTime);
        }
        if($postdata['EndTime']!=''){
            $EndTime = str_replace('/','-',$postdata['EndTime']).' 23:59:59';
            $TotalPerformance = $TotalPerformance->where('performance_time','<=',$EndTime);
            $PersonalPerformance = $PersonalPerformance->where('performance_time','<=',$EndTime);
            $TeamPerformance = $TeamPerformance->where('performance_time','<=',$EndTime);
        }
        $TotalPerformance = $TotalPerformance->sum('achievement');
        $PersonalPerformance = $PersonalPerformance->sum('achievement');
        $TeamPerformance = $TeamPerformance->sum('achievement');
        $this->assign('TotalPerformance', $TotalPerformance);
        $this->assign('PersonalPerformance', $PersonalPerformance);
        $this->assign('TeamPerformance', $TeamPerformance);
        return $this->fetch();
    }
    
    public function PerformanceQueryResults_(){
        $postdata = input("post.");
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        if(!$this->updateUser_($openid)){
            $this->redirect('music/index/ydgzh');
        }
        $sign_of_year_and_month = date('Y-m');
        if($postdata['sign_of_year_and_month']!=''){
            $sign_of_year_and_month = $postdata['sign_of_year_and_month'];
        }
        $sign_of_year_and_month_min = $sign_of_year_and_month.'-01';
        $startdate=strtotime($sign_of_year_and_month_min); 
        $sign_of_year_and_month_max = date('Y-m-d',strtotime("+1 months",$startdate));
        session('StartTime', $sign_of_year_and_month_min);
        session('EndTime', $sign_of_year_and_month_max);
        $final_performance = Db::table('final_performance')->where('openid','=',$openid)->where('sign_of_year_and_month','=',$sign_of_year_and_month)->find();
        $original_performance = '';
        $households = '';
        $calculation_explanation = '';
        if($final_performance!=null){
            $original_performance = $final_performance['original_performance'];
            $households = $final_performance['households'];
            $calculation_explanation = $final_performance['calculation_explanation'];
        }
        $this->assign('original_performance', $original_performance);
        $this->assign('households', $households);
        $this->assign('calculation_explanation', $calculation_explanation);
        return $this->fetch();
    }
    
    //我的团队
    public function MyTeam(){
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        if(!$this->updateUser_($openid)){
            $this->redirect('music/index/ydgzh');
        }
        $Me = \app\index\model\UserList::get(['OPENID'=>$openid]);
        $Leadership = \app\index\model\UserList::get(['OPENID'=>$Me->superior_openid]);
        $LevelOnes = \app\index\model\UserList::where('superior_openid','=',$openid)->select();
        $loos = array();
        foreach ($LevelOnes as $key => $value) {
            array_push($loos,$value['OPENID']);
        }
        //Log::record("loos:".json_encode($loos));
        $LevelTows = array();
        if(count($loos)>0){
            $LevelTows = \app\index\model\UserList::where("superior_openid","in",$loos)->select();
        }
        //return json_encode($LevelOnes);
        $Number = count($LevelOnes)+count($LevelTows);
        $Position = "员工";
        if($Number>5){
            $Position = "经理";
        }
        $this->assign('Me', $Me);
        $this->assign('Leadership', $Leadership);
        $this->assign('LevelOnes', $LevelOnes);
        $this->assign('LevelTows', $LevelTows);
        $this->assign('Position', $Position);
        return $this->fetch();
    }
    
    //薇信订单查询
    public function OrderEnquiry(){
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        if(!$this->updateUser_($openid)){
            $this->redirect('music/index/ydgzh');
        }
        return $this->fetch();
    }
    
    public function OrderQueryResults(){
        $openid = getOpenid();
        $broadband_orderss = \app\index\model\BroadbandOrders::where("author_openid","=",$openid);
        $pd = input("post.");
        if(trim($pd['phone_number'])!=''){
            $broadband_orderss->where("phone_number",'like','%'.$pd['phone_number'].'%');
        }
        $broadband_orderss = $broadband_orderss->order("submission_time desc")->limit(50)->select();
        return json($broadband_orderss);
    }
    
    //业绩明细查询
    public function yejimxcx(){
        $openid = getOpenid();
        $pd = input("post.");
        $sign_of_year_and_month = $pd['sign_of_year_and_month'];
        $sign_of_year_and_month_min = $sign_of_year_and_month.'-01';
        $startdate=strtotime($sign_of_year_and_month_min); 
        $sign_of_year_and_month_max = date('Y-m-d',strtotime("+1 months",$startdate));
        $broadband_orderss = Db::table('broadband_orders')->alias('a')->join('broadband_performance b','a.BROADBAND_ORDERS_ID = b.order_id')->where('b.openid','=',$openid);
        if($sign_of_year_and_month!=''){
            $broadband_orderss = $broadband_orderss->where('b.performance_time','>=',$sign_of_year_and_month_min)->where('b.performance_time','<',$sign_of_year_and_month_max);
        }
        $broadband_orderss = $broadband_orderss->order("b.performance_time desc")->limit(50)->select();
        //return json_encode($broadband_orderss);
        return json($broadband_orderss);
    }
    
    public function QrCode(){
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        if(!$this->updateUser_($openid)){
            $this->redirect('music/index/ydgzh');
        }
        $Extend = & load_wechat('Extends');
        $res = $Extend->getQRCode($openid,1);
        $ticket = $res['ticket'];
        $QRUrl = $Extend->getQRUrl($ticket);
        $ShortUrl = $Extend->getShortUrl($QRUrl);
        $this->assign('ShortUrl', $ShortUrl);
        return $this->fetch();
    }
    
    public function getMenuList()
    {
        $MenuLists = \app\index\model\MenuList::where('menu_list_id','<>','')->page(1,10)->select();
        return json($MenuLists);
    }
    
    //风机经纬度定位
    public function gpsfj(){
        $openid = getOpenid();
        //$wxuser = & load_wechat('User');
        //$UserInfo = $wxuser->getUserInfo($openid);
        //Log::record("UserInfo:".json_encode($UserInfo),'notice');
        $this->assign('openid', $openid);
        return $this->fetch();
    }
    
    public function BusinessList(){
        //Session::delete('openid');
        $openid = getOpenid();
        /*if(json_encode($openid)=='{}'){
            return $openid;
        }
        if(!$this->updateUser_($openid)){
            $this->redirect('music/index/ydgzh');
        }
        $user_list = \app\index\model\UserList::get(['OPENID'=>$openid]);
        $Salesman = \app\index\model\Salesman::get(['openid'=>$openid]);
        if($Salesman==null){
            return $this->redirect('User/bindings');
        }
        if($user_list->phone_number==''){
            return $this->redirect('Registration');
            //return "想成为我们中的一员吗？";
        }*/
        $this->assign('openid', $openid);
        return $this->fetch();
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
    
    public function Login(){
        Session::clear();
        //$openid = getOpenid();
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        if(!$this->updateUser_($openid)){
            $this->redirect('music/index/ydgzh');
        }
        //Log::record('20180217：'.json_encode($openid));
        if(json_encode($openid)=='{}'){
            //$openid = getSnsapi_userinfo();
            return $openid;
        }
        $this->assign('openid', $openid);
        $this->assign('LOGIN_VERIFICATION_NOTE_ID',input('LOGIN_VERIFICATION_NOTE_ID'));
        return $this->fetch();
    }
    
    public function Registration(){
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        if(!$this->updateUser_($openid)){
            $this->redirect('music/index/ydgzh');
        }
        $user_list = \app\index\model\UserList::get(['OPENID'=>$openid]);
        $this->assign('user_list', $user_list);
        return $this->fetch();
    }
    
    //保存注册信息
    public function saveRegistration(){
        $postdata = input("post.");
        $regobj = $postdata['regobj'];
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        if(!$this->updateUser_($openid)){
            $this->redirect('music/index/ydgzh');
        }
        $user_list = \app\index\model\UserList::get(['OPENID'=>$openid]);
        $user_list->save($regobj);
        //$user_list->save();
        return "ok";
    }
    
    //删除订单
    public function delBroadbandOrders(){
        $postdata = input("post.");
        $id = $postdata['BROADBAND_ORDERS_ID'];
        $broadband_orders = Db::table('broadband_orders')->where('BROADBAND_ORDERS_ID','=',$id)->find();
        if($broadband_orders['business_state']=='已下单'){
            Db::table('broadband_orders')->where('BROADBAND_ORDERS_ID','=',$id)->update(['delete_time'=>time()]);
            return 'ok';
        }else{
            return 'error';
        }
    }
    
    //保存订单信息
    public function saveBroadbandOrders(){
        $openid = getOpenid();
        $postdata = input("post.");
        $media = & load_wechat('Media');
        $isIdPhotos = $postdata['isIdPhotos'];
        //return json_encode($IdImgServers);
        $BroadbandOrders = $postdata['BroadbandOrders'];
        $access_mode = $postdata['access_mode'];
        
        if($isIdPhotos!='no'){
            $IdImgServers = $postdata['IdImgServers'];
            foreach ($IdImgServers as $key => $value) {
                $result = $media->getMedia($value['serverId']);
                //Log::record($result);
                $HttpPath = saveUploadFile($result,$value['serverId']);
                $BroadbandOrders[$value['id']] = $HttpPath;
            }
        }
        $BroadbandPackageDB = new \app\index\model\BroadbandOrders($BroadbandOrders);
        $BroadbandPackageDB->submission_time = date('Y-m-d H-i-s');
        $BroadbandPackageDB->author_openid = $openid;
        $BroadbandPackageDB->access_mode = $access_mode;
        $BroadbandPackageDB->save();
        session('BROADBAND_ORDERS_ID',$BroadbandPackageDB->BROADBAND_ORDERS_ID);
        $user_list = \app\index\model\UserList::get(['OPENID'=>$openid]);
        $OperationLog = new \app\index\model\OperationLog();
        $OperationLog->OPENID = $openid;
        $OperationLog->OPERATING_TIME = $BroadbandPackageDB->submission_time;
        $OperationLog->OPERATION_CONTENT = '['.$user_list['full_name'].']提交订单。';
        $OperationLog->correlation_id = $BroadbandPackageDB->BROADBAND_ORDERS_ID;
        $OperationLog->save();
        $this->MassNotification('新单提醒',"新订单：".$BroadbandPackageDB->package_name.$BroadbandPackageDB->phone_number);
        return 'ok';
    }
    
    public function SuccessfullySaved(){
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        if(!$this->updateUser_($openid)){
            $this->redirect('music/index/ydgzh');
        }
        $BROADBAND_ORDERS_ID = session('BROADBAND_ORDERS_ID');
        $this->assign('BROADBAND_ORDERS_ID', $BROADBAND_ORDERS_ID);
        return $this->fetch();
    }
    
    //保存注册信息成功
    public function RegistrationSuccessful(){
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        if(!$this->updateUser_($openid)){
            $this->redirect('music/index/ydgzh');
        }
        return $this->fetch();
    }
    
    //开户
    public function OpenAccount(){
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        if(!$this->updateUser_($openid)){
            $this->redirect('music/index/ydgzh');
        }
        return $this->fetch();
    }
    
    //再次提交
    public function Resubmit($id){
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        if(!$this->updateUser_($openid)){
            $this->redirect('music/index/ydgzh');
        }
        $BroadbandOrder = \app\index\model\BroadbandOrders::get($id);
        //Log::record("OrderDetailsResubmit".$BroadbandOrder['business_state']);
        $this->assign('Order', $BroadbandOrder);
        return $this->fetch();
    }
    
    //订单详情
    public function OrderDetails($id){
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        if(!$this->updateUser_($openid)){
            $this->redirect('music/index/ydgzh');
        }
        $BroadbandOrder = \app\index\model\BroadbandOrders::get($id);
        if($BroadbandOrder['business_state']=='退回'){
            //Log::record("OrderDetailsbusiness_state".$BroadbandOrder['business_state']);
            return $this->redirect('Resubmit',['id' => $id]);
        }
        $this->assign('Order', $BroadbandOrder);
        return $this->fetch();
    }
    
    public function saveResubmit(){
        $openid = getOpenid();
        $postdata = input("post.");
        $media = & load_wechat('Media');
        $IdImgServers = $postdata['IdImgServers'];
        $BroadbandOrders = $postdata['BroadbandOrders'];
        $access_mode = $postdata['access_mode'];
        //Log::record("saveResubmitIdImgServers".json_encode($IdImgServers));
        foreach ($IdImgServers as $key => $value) {
            $result = $media->getMedia($value['serverId']);
            //Log::record($result);
            if($result!=''){
                $HttpPath = saveUploadFile($result,$value['serverId']);
                $BroadbandOrders[$value['id']] = $HttpPath;
            }
        }
        
        $BroadbandPackageDB = \app\index\model\BroadbandOrders::get($BroadbandOrders['BROADBAND_ORDERS_ID']);
        $BroadbandPackageDB->data($BroadbandOrders);
        $BroadbandPackageDB->submission_time = date('Y-m-d H-i-s');
        $BroadbandPackageDB->author_openid = $openid;
        $BroadbandPackageDB->business_state = '已下单';
        $BroadbandPackageDB->access_mode = $access_mode;
        //Log::record("saveResubmitIdImgServers6".json_encode($BroadbandPackageDB));
        $BroadbandPackageDB->save();
        //Log::record("saveResubmitIdImgServers5");
        session('BROADBAND_ORDERS_ID',$BroadbandPackageDB->BROADBAND_ORDERS_ID);
        $user_list = \app\index\model\UserList::get(['OPENID'=>$openid]);
        $OperationLog = new \app\index\model\OperationLog();
        $OperationLog->OPENID = $openid;
        $OperationLog->OPERATING_TIME = $BroadbandPackageDB->submission_time;
        $OperationLog->OPERATION_CONTENT = '['.$user_list['full_name'].']再次提交订单。';
        $OperationLog->correlation_id = $BroadbandPackageDB->BROADBAND_ORDERS_ID;
        $OperationLog->save();
        return 'ok';
    }
    
    public function getBroadbandPackage(){
        $pd = input('post.');
        $package_name = $pd['package_name'];
        $BroadbandPackage = \app\index\model\BroadbandPackage::get(['package_name' => $package_name]);
        return json($BroadbandPackage);
    }
    
    public function test(){
        return getOpenid();
    }
}
