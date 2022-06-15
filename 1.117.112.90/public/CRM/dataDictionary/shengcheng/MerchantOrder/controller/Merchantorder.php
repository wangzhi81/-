<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

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
        $Feature->TableHeader = array("手机号码","姓名","地址","openid","下单时间");
        $Feature->Fields = array("MERCHANT_ORDER_ID","phone_number","full_name","address","openid","order_time");
        $Feature->Operations= array(
                array('name'=>'编辑','url'=>'/admin/Merchantorder/edit/id/'),
                array('name'=>'删除','url'=>'/admin/Merchantorder/delete/id/'),
            );
        $Feature->Jumps=array(
                //array('name'=>'编辑','url'=>'/admin/index/editDictionaryTable/DICTIONARY_TABLE_ID/')
            );
        $Feature->Buttons = array(
                array('name'=>'添加','url'=>'/admin/Merchantorder/add')
            );
        return json($Feature);
    }
    
    public function get(){
        $MerchantOrders = \app\admin\model\MerchantOrder::where('MERCHANT_ORDER_ID','<>','')->order("display_order")->select();
        return json($MerchantOrders);
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
