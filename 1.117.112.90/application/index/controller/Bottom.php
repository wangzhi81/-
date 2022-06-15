<?php

/*
    底商开发
*/

namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Db;
use think\Log;
use think\Session;

class Bottom extends Controller
{
    public function index()
    {
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        $salesman = Db::table('salesman')->where('delete_time',null)->where("openid",$openid)->find();
        if($salesman['bottom_open_code']==''){
            $Extend = & load_dswechat('Extends');
            $res = $Extend->getQRCode($openid,1);
            $ticket = $res['ticket'];
            $QRUrl = $Extend->getQRUrl($ticket);
            $ShortUrl = $Extend->getShortUrl($QRUrl);
            $salesman['bottom_open_code'] = $ShortUrl;
            Db::table('salesman')->where('delete_time',null)->where("openid",$openid)->update(['bottom_open_code'=>$ShortUrl]);
        }
        //$url = urldecode('http://kod.syjs.net.cn/index/Bottom/zhuce/ygid/'.$openid);
        $this->assign('qrcodeurl', $salesman['bottom_open_code']);
        return $this->fetch();
    }
    
    public function test(){
        $pay = & load_dswechat('Pay');
        $result = $pay->sendRedPack('olz_I0m1-Mu5jz_PTpap2-3quh-g','100', date('YmdHis'), '合伙人', '恭喜', '奖励活动', '备注');
        if($result === FALSE){
        	// 返回失败的处理结果
            return json($pay);
        }else{
        	// 返回成功的处理结果
        }
        return json($result);
    }
    
    public function test2(){
        $menu = & load_dswechat('menu');
        $result = $menu->deleteMenu();
        if($result===FALSE){
            // 接口失败的处理
            return $menu->errMsg;
        }else{
            // 接口成功的处理
            return json($result);
        }
    }
    
    public function test3(){
        $Index = new \app\index\controller\Index();
        return json($n->FilteredNotifiedPerson());
    }
    
    //底商下单
    public function xiadan($id){
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        $business_set_meals = Db::table('business_set_meal')->where('delete_time',null)->limit(3)->select();
        $business_set_meals2 = Db::table('business_set_meal')->where('delete_time',null)->limit('3,3')->select();
        $this->assign('business_set_meals', $business_set_meals);
        $this->assign('business_set_meals2', $business_set_meals2);
        $package_description = $business_set_meals[0]['package_description'];
        $this->assign('package_description', $package_description);
        $this->assign('openid', $openid);
        $this->assign('the_underlying_business_id', $id);
        return $this->fetch();
    }
    
    public function savedingdan(){
        $posdata = input("post.");
        //return json_encode($posdata);
        $openid = getOpenid();
        $phone_number = $posdata['phone_number'];
        $full_name = $posdata['full_name'];
        $address = $posdata['address'];
        $the_underlying_business_id = $posdata['the_underlying_business_id'];
        $package_information = $posdata['package_information'];
        $deshang_information = Db::table('deshang_information')->where('delete_time',null)->where('DESHANG_INFORMATION_ID',$the_underlying_business_id)->find();
        $uuid = Db::query("select uuid() as uuid_");
        $data = ['MERCHANT_ORDER_ID' => $uuid[0]['uuid_'], 'openid' => $openid,'phone_number'=>$phone_number,'full_name'=>$full_name,'address'=>$address,'the_underlying_business_id'=>$the_underlying_business_id,'order_time'=>date("Y-m-d H:i:s"),'package_information'=>$package_information];
        $ddbh = strtoupper(substr($uuid[0]['uuid_'],0,8));
        Db::table('merchant_order')->insert($data);
        $data = array(
                "touser"=>$deshang_information['openid'],
                'template_id'=>getParameter('OrderSubmissionSuccessful'),
                'url'=>"#",
                'topcolor'=>'#FF0000',
                'data'=>array(
                    'first'=>array('value'=>"您的商铺有新订单：",'color'=>"#743A3A"),
                    'keyword1'=>array('value'=>$ddbh,'color'=>'#743A3A'),
                    'keyword2'=>array('value'=>$package_information,'color'=>"#743A3A"),
                    'keyword3'=>array('value'=>date("Y-m-d H:i"),'color'=>'#743A3A'),
                    'remark'=>array('value'=>'感谢您的支持！','color'=>'#743A3A'),
                )
            );
        $wechat = &load_dswechat('Receive');
        $res = $wechat->sendTemplateMessage($data);
        $Index = new \app\index\controller\Index();
        $Index->MassNotification('底商订单提醒',"新底商订单：".$package_information.$phone_number);
        return 'ok';
        //return json_encode($res);
    }
    
    //提交成功
    public function tjcg(){
        return $this->fetch();
    }
    
    public function getbusiness_set_meal(){
        $posdata = input("post.");
        $BUSINESS_SET_MEAL_ID = $posdata['BUSINESS_SET_MEAL_ID'];
        $business_set_meal = Db::table('business_set_meal')->where('delete_time',null)->where('BUSINESS_SET_MEAL_ID',$BUSINESS_SET_MEAL_ID)->find();
        return json($business_set_meal);
    }
    
    //注册
    //$ygid:销售人员openid
    public function zhuce($ygid){
        Session::delete('openid');
        $openid = getDsOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        if(Db::table('deshang_information')->where('delete_time',null)->where('openid',$openid)->count()==0){
            $uuid = Db::query("select uuid() as uuid_");
            $data = ['DESHANG_INFORMATION_ID' => $uuid[0]['uuid_'], 'openid' => $openid];
            Db::table('deshang_information')->insert($data);
        }
        //Db::table('deshang_information')->where('delete_time',null)->where('openid',$openid)->update(['salesperson_openid' => $ygid]);
        $deshang_information = Db::table('deshang_information')->where('delete_time',null)->where('openid',$openid)->find();
        if($deshang_information['audit_status']=='未审核'){
            $this->redirect('Bottom/ddsh');
        }else if($deshang_information['audit_status']=='审核通过'){
            $this->redirect('Bottom/shtg');
        }
        $this->assign('deshang_information', $deshang_information);
        $this->assign('salesperson_openid', $ygid);
        $this->assign('openid', $openid);
        return $this->fetch();
    }
    
    public function shtg(){
        return $this->fetch();
    }
    
    public function bdyzm(){
        $posdata = input("post.");
        $yzm = $posdata['yzm'];
        $contact_number = $posdata['contact_number'];
        $openid = $posdata['openid'];
        $deshang_information = Db::table('deshang_information')->where('delete_time',null)->where('openid',$openid)->where('contact_number',$contact_number)->find();
        if($yzm==$deshang_information['verification_code']){
            return 'ok';
        }else{
            return '验证码错误！';
        }
    }
    
    //等待审核
    public function ddsh(){
        $openid = getOpenid();
        if(json_encode($openid)=='{}'){
            return $openid;
        }
        $deshang_information = Db::table('deshang_information')->where('delete_time',null)->where('openid',$openid)->find();
        $this->assign('deshang_information', $deshang_information);
        return $this->fetch();
    }
    
    //保存底商信息
    public function save(){
        $posdata = input("post.");
        $yzm = $posdata['yzm'];
        $contact_number = $posdata['contact_number'];
        $openid = $posdata['openid'];
        $name_of_the_merchant = $posdata['name_of_the_merchant'];
        $business_address = $posdata['business_address'];
        $salesperson_openid = $posdata['salesperson_openid'];
        $salesman = Db::table('salesman')->where('delete_time',null)->where('openid',$salesperson_openid)->find();
        $deshang_information = Db::table('deshang_information')->where('delete_time',null)->where('openid',$openid)->where('contact_number',$contact_number)->find();
        if($yzm==$deshang_information['verification_code']){
            Db::table('deshang_information')->where('openid',$openid)->update(['name_of_the_merchant'=>$name_of_the_merchant,'business_address'=>$business_address,'audit_status'=>'未审核','salesperson_openid'=>$salesperson_openid,'time_of_submission'=>date('Y-m-d H:i:s')]);
            $uuid = Db::query("select uuid() as uuid_");
            $data = ['OPERATION_LOG_ID' => $uuid[0]['uuid_'],'OPENID' => $openid,'OPERATING_TIME'=>date('Y-m-d H:i:s'),'OPERATION_CONTENT'=>'提交底商信息，销售人员是：'.$salesman['FULL_NAME'],'correlation_id'=>$deshang_information['DESHANG_INFORMATION_ID']];
            //Log::record('201808181521:'.json_encode($data));
            Db::table('operation_log')->insert($data);
        }
        return 'ok';
    }
}