<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Housekeepingservice extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $Feature = new \app\admin\model\Feature();
        $Feature->Title = "家政服务";
        $Feature->DataUrl = "/admin/Housekeepingservice/get";
        $Feature->TableHeader = array("服务分类","服务名称","服务说明","服务图标","显示顺序");
        $Feature->Fields = array("HOUSEKEEPING_SERVICE_ID","service_classification","service_name","service_description","service_icon","display_order");
        $Feature->Operations= array(
                array('name'=>'编辑','url'=>'/admin/Housekeepingservice/edit/id/'),
                array('name'=>'删除','url'=>'/admin/Housekeepingservice/delete/id/'),
            );
        $Feature->Jumps=array(
                //array('name'=>'编辑','url'=>'/admin/index/editDictionaryTable/DICTIONARY_TABLE_ID/')
            );
        $Feature->Buttons = array(
                array('name'=>'添加','url'=>'/admin/Housekeepingservice/add')
            );
        return json($Feature);
    }
    
    public function get(){
        $HousekeepingServices = \app\admin\model\HousekeepingService::where('HOUSEKEEPING_SERVICE_ID','<>','')->order("display_order")->select();
        return json($HousekeepingServices);
    }
    
    public function add(){
        $SecondTitle = '>添加家政服务';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/housekeepingservice');
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
        $HousekeepingService = new \app\admin\model\HousekeepingService($postdata['Housekeepingservice']);
        $HousekeepingService->save();
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
        $HousekeepingService = \app\admin\model\HousekeepingService::get($id);
        $SecondTitle = '>编辑家政服务';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/housekeepingservice');
        $this->assign('HousekeepingService',$HousekeepingService);
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
        $data = $postdata['Housekeepingservice'];
        $HousekeepingService = \app\admin\model\HousekeepingService::get($data['HOUSEKEEPING_SERVICE_ID']);
        $HousekeepingService->data($data);
        $HousekeepingService->save();
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
        $HousekeepingService = \app\admin\model\HousekeepingService::get($id);
        $SecondTitle = '>删除家政服务';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/housekeepingservice');
        $this->assign('HousekeepingService',$HousekeepingService);
        return $this->fetch();
    }
    
    public function kill(){
        $postdata = input('post.');
        $HOUSEKEEPING_SERVICE_ID = $postdata['HOUSEKEEPING_SERVICE_ID'];
        $HousekeepingService = \app\admin\model\HousekeepingService::get($HOUSEKEEPING_SERVICE_ID);
        $HousekeepingService->delete();
        return 'ok';
    }
}
