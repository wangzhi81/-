<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Broadbandperformance extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $Feature = new \app\admin\model\Feature();
        $Feature->Title = "宽带业绩";
        $Feature->DataUrl = "/admin/Broadbandperformance/get";
        $Feature->TableHeader = array("openid","业绩","业绩类别","绩效时间","订单ID","套餐名称");
        $Feature->Fields = array("BROADBAND_PERFORMANCE_ID","openid","achievement","performance_category","performance_time","order_id","package_name");
        $Feature->Operations= array(
                array('name'=>'编辑','url'=>'/admin/Broadbandperformance/edit/id/'),
                array('name'=>'删除','url'=>'/admin/Broadbandperformance/delete/id/'),
            );
        $Feature->Jumps=array(
                //array('name'=>'编辑','url'=>'/admin/index/editDictionaryTable/DICTIONARY_TABLE_ID/')
            );
        $Feature->Buttons = array(
                array('name'=>'添加','url'=>'/admin/Broadbandperformance/add')
            );
        return json($Feature);
    }
    
    public function get(){
        $BroadbandPerformances = \app\admin\model\BroadbandPerformance::where('BROADBAND_PERFORMANCE_ID','<>','')->order("display_order")->select();
        return json($BroadbandPerformances);
    }
    
    public function add(){
        $SecondTitle = '>添加宽带业绩';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/broadbandperformance');
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
        $BroadbandPerformance = new \app\admin\model\BroadbandPerformance($postdata['Broadbandperformance']);
        $BroadbandPerformance->save();
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
        $BroadbandPerformance = \app\admin\model\BroadbandPerformance::get($id);
        $SecondTitle = '>编辑宽带业绩';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/broadbandperformance');
        $this->assign('BroadbandPerformance',$BroadbandPerformance);
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
        $data = $postdata['Broadbandperformance'];
        $BroadbandPerformance = \app\admin\model\BroadbandPerformance::get($data['BROADBAND_PERFORMANCE_ID']);
        $BroadbandPerformance->data($data);
        $BroadbandPerformance->save();
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
        $BroadbandPerformance = \app\admin\model\BroadbandPerformance::get($id);
        $SecondTitle = '>删除宽带业绩';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/broadbandperformance');
        $this->assign('BroadbandPerformance',$BroadbandPerformance);
        return $this->fetch();
    }
    
    public function kill(){
        $postdata = input('post.');
        $BROADBAND_PERFORMANCE_ID = $postdata['BROADBAND_PERFORMANCE_ID'];
        $BroadbandPerformance = \app\admin\model\BroadbandPerformance::get($BROADBAND_PERFORMANCE_ID);
        $BroadbandPerformance->delete();
        return 'ok';
    }
}
