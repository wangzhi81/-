<?php
//客户管理
namespace app\index\controller;

use think\Db;
use think\Url;
use think\Log;
use think\Controller;
use think\Session;

class Customer extends Controller
{
    public function index()
    {
        return $this->fetch();
    }
    
    //更新客户信息
    public function update(){
        if(Session::has('login_information')){
            $robj = new \stdClass();
            $postdata = input("post.");
            $full_name = $postdata['full_name'];
            $mobile_phone = $postdata['mobile_phone'];
            $photo = $postdata['photo'];
            $shipping_address = $postdata['shipping_address'];
            $CUSTOMER_MANAGEMENT_ID = $postdata['CUSTOMER_MANAGEMENT_ID'];
            $login_information = Session::get('login_information');
            Db::table('customer_management')->where('CUSTOMER_MANAGEMENT_ID',$CUSTOMER_MANAGEMENT_ID)->update(['full_name'=>$full_name,'mobile_phone'=>$mobile_phone,'shipping_address'=>$shipping_address,'photo'=>$photo,'modification_time'=>date('Y-m-d H:i:s'),'owned_users'=>$login_information]);
            $robj->info = 'ok';
            return json($robj);
        }else{
            $this->redirect('Erp/login');
        }
    }
    
    //修改客户信息
    public function edit($id){
        if(Session::has('login_information')){
            $CustomerManagement = Db::table('customer_management')->where("CUSTOMER_MANAGEMENT_ID",$id)->find();
            $this->assign('CustomerManagement', $CustomerManagement);
            return $this->fetch();
        }else{
            $this->redirect('Erp/login');
        }
    }
    
    //获取客户信息列表
    public function getCustomerManagements(){
        $login_information = Session::get('login_information');
        $CustomerManagements = Db::table('customer_management')->where('owned_users',$login_information)->order("modification_time desc")->limit(50)->select();
        $this->assign('CustomerManagements', $CustomerManagements);
        return $this->fetch();
    }
    
    //保存客户信息
    public function save(){
        if(Session::has('login_information')){
            $robj = new \stdClass();
            $postdata = input("post.");
            $full_name = $postdata['full_name'];
            $mobile_phone = $postdata['mobile_phone'];
            $photo = $postdata['photo'];
            $shipping_address = $postdata['shipping_address'];
            $login_information = Session::get('login_information');
            $uuid = Db::query("select uuid() as uuid_")[0]['uuid_'];
            Db::table('customer_management')->insert(['CUSTOMER_MANAGEMENT_ID'=>$uuid,'full_name'=>$full_name,'mobile_phone'=>$mobile_phone,'shipping_address'=>$shipping_address,'photo'=>$photo,'creation_time'=>date('Y-m-d H:i:s'),'modification_time'=>date('Y-m-d H:i:s'),'owned_users'=>$login_information]);
            $robj->info = 'ok';
            return json($robj);
        }else{
            $this->redirect('Erp/login');
        }
    }
    
    //添加客户
    public function add(){
        if(Session::has('login_information')){
            return $this->fetch();
        }else{
            $this->redirect('Erp/login');
        }
    }
    
    public function saveImg(){
        $postdata = input("post.");
        $serverId = $postdata['serverId'];
        $media = & load_wechat('Media');
        $result = $media->getMedia($serverId);
        $HttpPath = saveUploadFile($result,$serverId);
        return $HttpPath;
    }
    
}