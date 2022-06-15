<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Broadbandorders extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $Feature = new \app\admin\model\Feature();
        $Feature->Title = "宽带订单";
        $Feature->DataUrl = "/admin/Broadbandorders/get";
        $Feature->TableHeader = array("主号姓名","手机号码","接入地址","套餐名称","身份证正面","身份证反面","备注","提交时间","审核状态","退回原因","提交人OPENID");
        $Feature->Fields = array("BROADBAND_ORDERS_ID","master_name","phone_number","access_address","package_name","front_of_id_card","reverse_of_id_card","remarks","submission_time","audit_status","reasons_for_return","author_openid");
        $Feature->Operations= array(
                array('name'=>'编辑','url'=>'/admin/Broadbandorders/edit/id/'),
                array('name'=>'删除','url'=>'/admin/Broadbandorders/delete/id/'),
            );
        $Feature->Jumps=array(
                //array('name'=>'编辑','url'=>'/admin/index/editDictionaryTable/DICTIONARY_TABLE_ID/')
            );
        $Feature->Buttons = array(
                array('name'=>'添加','url'=>'/admin/Broadbandorders/add')
            );
        return json($Feature);
    }
    
    public function get(){
        $BroadbandOrderss = \app\admin\model\BroadbandOrders::where('BROADBAND_ORDERS_ID','<>','')->order("display_order")->select();
        return json($BroadbandOrderss);
    }
    
    public function add(){
        $SecondTitle = '>添加宽带订单';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/broadbandorders');
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
        $BroadbandOrders = new \app\admin\model\BroadbandOrders($postdata['Broadbandorders']);
        $BroadbandOrders->save();
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
        $BroadbandOrders = \app\admin\model\BroadbandOrders::get($id);
        $SecondTitle = '>编辑宽带订单';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/broadbandorders');
        $this->assign('BroadbandOrders',$BroadbandOrders);
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
        $data = $postdata['Broadbandorders'];
        $BroadbandOrders = \app\admin\model\BroadbandOrders::get($data['BROADBAND_ORDERS_ID']);
        $BroadbandOrders->data($data);
        $BroadbandOrders->save();
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
        $BroadbandOrders = \app\admin\model\BroadbandOrders::get($id);
        $SecondTitle = '>删除宽带订单';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/broadbandorders');
        $this->assign('BroadbandOrders',$BroadbandOrders);
        return $this->fetch();
    }
    
    public function kill(){
        $postdata = input('post.');
        $BROADBAND_ORDERS_ID = $postdata['BROADBAND_ORDERS_ID'];
        $BroadbandOrders = \app\admin\model\BroadbandOrders::get($BROADBAND_ORDERS_ID);
        $BroadbandOrders->delete();
        return 'ok';
    }
}
