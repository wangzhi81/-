<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Unifiedorder extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $Feature = new \app\admin\model\Feature();
        $Feature->Title = "统一订单";
        $Feature->DataUrl = "/admin/Unifiedorder/get";
        $Feature->TableHeader = array("商品ID","客户ID","订单ID","是否支付","买家留言","商品数量","商品金额","运费金额");
        $Feature->Fields = array("UNIFIED_ORDER_ID","commodity_id","customer_id","order_id","pay_or_not","buyer_message","quantity_of_goods","commodity_amount","freight_amount");
        $Feature->Operations= array(
                array('name'=>'编辑','url'=>'/admin/Unifiedorder/edit/id/'),
                array('name'=>'删除','url'=>'/admin/Unifiedorder/delete/id/'),
            );
        $Feature->Jumps=array(
                //array('name'=>'编辑','url'=>'/admin/index/editDictionaryTable/DICTIONARY_TABLE_ID/')
            );
        $Feature->Buttons = array(
                array('name'=>'添加','url'=>'/admin/Unifiedorder/add')
            );
        return json($Feature);
    }
    
    public function get(){
        $UnifiedOrders = \app\admin\model\UnifiedOrder::where('UNIFIED_ORDER_ID','<>','')->order("display_order")->select();
        return json($UnifiedOrders);
    }
    
    public function add(){
        $SecondTitle = '>添加统一订单';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/unifiedorder');
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
        $UnifiedOrder = new \app\admin\model\UnifiedOrder($postdata['Unifiedorder']);
        $UnifiedOrder->save();
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
        $UnifiedOrder = \app\admin\model\UnifiedOrder::get($id);
        $SecondTitle = '>编辑统一订单';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/unifiedorder');
        $this->assign('UnifiedOrder',$UnifiedOrder);
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
        $data = $postdata['Unifiedorder'];
        $UnifiedOrder = \app\admin\model\UnifiedOrder::get($data['UNIFIED_ORDER_ID']);
        $UnifiedOrder->data($data);
        $UnifiedOrder->save();
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
        $UnifiedOrder = \app\admin\model\UnifiedOrder::get($id);
        $SecondTitle = '>删除统一订单';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/unifiedorder');
        $this->assign('UnifiedOrder',$UnifiedOrder);
        return $this->fetch();
    }
    
    public function kill(){
        $postdata = input('post.');
        $UNIFIED_ORDER_ID = $postdata['UNIFIED_ORDER_ID'];
        $UnifiedOrder = \app\admin\model\UnifiedOrder::get($UNIFIED_ORDER_ID);
        $UnifiedOrder->delete();
        return 'ok';
    }
}
