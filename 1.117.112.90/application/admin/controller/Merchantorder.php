<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;

class Merchantorder extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $Feature = new \app\admin\model\Feature();
        $Feature->Title = "底商订单";
        $Feature->DataUrl = "/admin/Merchantorder/get";
        $Feature->TableHeader = array("底商","套餐","手机号码","姓名","地址","下单时间","订单状态");
        $Feature->Fields = array("MERCHANT_ORDER_ID","name_of_the_merchant","package_information","phone_number","full_name","address","order_time","order_status");
        $Feature->Operations= array(
                //array('name'=>'编辑','url'=>'/admin/Merchantorder/edit/id/'),
                array('name'=>'删除','url'=>'/admin/Merchantorder/delete/id/'),
                array('name'=>'生成订单','class'=>'shengchengdd','url'=>'/admin/Merchantorder/shengchen/id/'),
            );
        $Feature->Jumps=array(
                //array('name'=>'编辑','url'=>'/admin/index/editDictionaryTable/DICTIONARY_TABLE_ID/')
            );
        $Feature->Buttons = array(
                array('name'=>'添加','url'=>'/admin/Merchantorder/add')
            );
        $Feature->PageInforUrl = "/admin/Merchantorder/PageInformation";
        $Feature->QueryPanels = "/admin/Merchantorder/QueryPanels";
        $Feature->ScriptFragment ='dict/merchantorder';
        return json($Feature);
    }
    
    public function shengchen($id){
        $SecondTitle = '>生成订单';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/merchantorder/shengchen');
        $this->assign('id',$id);
        $merchant_order = Db::table('merchant_order')->where('delete_time',null)->where('MERCHANT_ORDER_ID',$id)->find();
        $this->assign('MerchantOrder',$merchant_order);
        return $this->fetch();
    }
    
    public function saveBroadbandOrders(){
        $postdata = input('post.');
        $BroadbandOrders = $postdata['BroadbandOrders'];
        $MERCHANT_ORDER_ID = $postdata['MERCHANT_ORDER_ID'];
        
        $merchant_order = Db::table('merchant_order')->where('delete_time',null)->where('MERCHANT_ORDER_ID',$MERCHANT_ORDER_ID)->find();
        $the_underlying_business_id = $merchant_order['the_underlying_business_id'];
        $deshang_information = Db::table('deshang_information')->where('delete_time',null)->where('DESHANG_INFORMATION_ID',$the_underlying_business_id)->find();
        
        $uuid = Db::query("select uuid() as uuid_");
        $BroadbandOrders['BROADBAND_ORDERS_ID'] = $uuid[0]['uuid_'];
        $BroadbandOrders['submission_time']=date('Y-m-d H:i:s');
        $BroadbandOrders['author_openid']='system';
        $BroadbandOrders['business_openid']=$deshang_information['openid'];
        $BroadbandOrders['salesman_openid']=$deshang_information['salesperson_openid'];
        $BroadbandOrders['order_type']='底商订单';
        
        Db::table('merchant_order')->where('MERCHANT_ORDER_ID',$MERCHANT_ORDER_ID)->update(['order_status'=>'已生成订单']);
        
        Db::name('broadband_orders')->insert($BroadbandOrders);
        return 'ok';
    }
    
    public function getBroadbandPackageClassification(){
        $broadband_package_classifications = Db::table('broadband_package_classification')->where('delete_time',null)->order('display_order')->select();
        return json($broadband_package_classifications);
    }
    
    public function getBroadbandPackage(){
        $postdata = input("post.");
        $package_classification = $postdata['package_classification'];
        $broadband_packages = Db::table('broadband_package')->where('delete_time',null)->where('package_classification',$package_classification)->order('display_order')->select();
        return json($broadband_packages);
    }
    
    public function QueryPanels(){
        return $this->fetch();
    }
    
    protected $NumberRowsPerPage = 50;
    
    public function get(){
        $postdata = input("post.");
        $PageNumbers = 1;
        if(isset($postdata['PageNumbers'])){
            $PageNumbers = $postdata['PageNumbers'];
        }
        $MerchantOrders = Db::table('merchant_order')->alias('a')->where("a.delete_time",null)->join('deshang_information d','a.the_underlying_business_id = d.DESHANG_INFORMATION_ID','LEFT')->order("a.order_time desc")->page($PageNumbers,$this->NumberRowsPerPage)->select();
        return json($MerchantOrders);
    }
    
    //分页信息
    public function PageInformation(){
        $postdata = input("post.");
        $PageNumbers = 1;
        if(isset($postdata['PageNumbers'])){
            $PageNumbers = $postdata['PageNumbers'];
        }
        $MerchantOrder = new \app\admin\model\MerchantOrder();
        $res = new \app\admin\model\Feature();
        $res->total = $MerchantOrder->count();
        $res->Per = $this->NumberRowsPerPage;
        $res->PageTotal = ceil($res->total/$res->Per);
        $res->PageNumbers = $PageNumbers;
        return json($res);
    }
    
    public function add(){
        $SecondTitle = '>添加底商订单';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/merchantorder');
        return $this->fetch();
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save()
    {
        $postdata = input('post.');
        $MerchantOrder = new \app\admin\model\MerchantOrder($postdata['Merchantorder']);
        $MerchantOrder->save();
        return 'ok';
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $MerchantOrder = \app\admin\model\MerchantOrder::get($id);
        $SecondTitle = '>编辑底商订单';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/merchantorder');
        $this->assign('MerchantOrder',$MerchantOrder);
        return $this->fetch();
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update()
    {
        $postdata = input('post.');
        $data = $postdata['Merchantorder'];
        $MerchantOrder = \app\admin\model\MerchantOrder::get($data['MERCHANT_ORDER_ID']);
        $MerchantOrder->data($data);
        $MerchantOrder->save();
        return 'ok';
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        $MerchantOrder = \app\admin\model\MerchantOrder::get($id);
        $SecondTitle = '>删除底商订单';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/merchantorder');
        $this->assign('MerchantOrder',$MerchantOrder);
        return $this->fetch();
    }
    
    public function kill(){
        $postdata = input('post.');
        $MERCHANT_ORDER_ID = $postdata['MERCHANT_ORDER_ID'];
        $MerchantOrder = \app\admin\model\MerchantOrder::get($MERCHANT_ORDER_ID);
        $MerchantOrder->delete();
        return 'ok';
    }
}
