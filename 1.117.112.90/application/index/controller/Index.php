<?php
namespace app\index\controller;

use think\Db;
use think\Url;
use think\Log;
use think\Controller;
use think\Session;

class Index extends Controller
{
    public function index()
    {
        if(session('UserInfor')!=null){
            return redirect("/admin");
        }else{
            return redirect("/admin/index/login");
        }
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
        return $this->fetch();
    }
    
    //时间轴
    public function Timeline($id){
        $openid = getOpenid();
        $this->assign('BROADBAND_ORDERS_ID', $id);
        $OperationLogs = \app\index\model\OperationLog::where('correlation_id',$id)->order('OPERATING_TIME desc')->select();
        $this->assign('OperationLogs', $OperationLogs);
        return $this->fetch();
    }
    
    //业绩明细
    public function PerformanceDetails(){
        $openid = getOpenid();
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
    
    public function BusinessList(){
        //Session::delete('openid');
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        $this->updateUser_($openid);
        $user_list = \app\index\model\UserList::get(['OPENID'=>$openid]);
        $Salesman = \app\index\model\Salesman::get(['openid'=>$openid]);
        if($Salesman==null){
            return $this->redirect('User/bindings');
        }
        if($user_list->phone_number==''){
            return $this->redirect('Registration');
            //return "想成为我们中的一员吗？";
        }
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
        return;
    }
    
    public function Login(){
        Session::clear();
        //$openid = getOpenid();
        $openid = getSnsapi_userinfo();
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
        $user_list = \app\index\model\UserList::get(['OPENID'=>$openid]);
        $this->assign('user_list', $user_list);
        return $this->fetch();
    }
    
    //保存注册信息
    public function saveRegistration(){
        $postdata = input("post.");
        $regobj = $postdata['regobj'];
        $openid = getOpenid();
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
        $BROADBAND_ORDERS_ID = session('BROADBAND_ORDERS_ID');
        $this->assign('BROADBAND_ORDERS_ID', $BROADBAND_ORDERS_ID);
        return $this->fetch();
    }
    
    //保存注册信息成功
    public function RegistrationSuccessful(){
        return $this->fetch();
    }
    
    //开户
    public function OpenAccount(){
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        return $this->fetch();
    }
    
    //再次提交
    public function Resubmit($id){
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
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
