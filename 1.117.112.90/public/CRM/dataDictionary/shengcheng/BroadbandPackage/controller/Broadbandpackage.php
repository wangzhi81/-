<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Broadbandpackage extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $Feature = new \app\admin\model\Feature();
        $Feature->Title = "宽带套餐";
        $Feature->DataUrl = "/admin/Broadbandpackage/get";
        $Feature->TableHeader = array("套餐分类","套餐名称","个人绩效","一级员工奖励","二级员工奖励","显示顺序");
        $Feature->Fields = array("BROADBAND_PACKAGE_ID","package_classification","package_name","personal_performance","first_class_employee_reward","two_level_employee_reward","display_order");
        $Feature->Operations= array(
                array('name'=>'编辑','url'=>'/admin/Broadbandpackage/edit/id/'),
                array('name'=>'删除','url'=>'/admin/Broadbandpackage/delete/id/'),
            );
        $Feature->Jumps=array(
                //array('name'=>'编辑','url'=>'/admin/index/editDictionaryTable/DICTIONARY_TABLE_ID/')
            );
        $Feature->Buttons = array(
                array('name'=>'添加','url'=>'/admin/Broadbandpackage/add')
            );
        return json($Feature);
    }
    
    public function get(){
        $BroadbandPackages = \app\admin\model\BroadbandPackage::where('BROADBAND_PACKAGE_ID','<>','')->order("display_order")->select();
        return json($BroadbandPackages);
    }
    
    public function add(){
        $SecondTitle = '>添加宽带套餐';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/broadbandpackage');
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
        $BroadbandPackage = new \app\admin\model\BroadbandPackage($postdata['Broadbandpackage']);
        $BroadbandPackage->save();
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
        $BroadbandPackage = \app\admin\model\BroadbandPackage::get($id);
        $SecondTitle = '>编辑宽带套餐';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/broadbandpackage');
        $this->assign('BroadbandPackage',$BroadbandPackage);
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
        $data = $postdata['Broadbandpackage'];
        $BroadbandPackage = \app\admin\model\BroadbandPackage::get($data['BROADBAND_PACKAGE_ID']);
        $BroadbandPackage->data($data);
        $BroadbandPackage->save();
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
        $BroadbandPackage = \app\admin\model\BroadbandPackage::get($id);
        $SecondTitle = '>删除宽带套餐';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/broadbandpackage');
        $this->assign('BroadbandPackage',$BroadbandPackage);
        return $this->fetch();
    }
    
    public function kill(){
        $postdata = input('post.');
        $BROADBAND_PACKAGE_ID = $postdata['BROADBAND_PACKAGE_ID'];
        $BroadbandPackage = \app\admin\model\BroadbandPackage::get($BROADBAND_PACKAGE_ID);
        $BroadbandPackage->delete();
        return 'ok';
    }
}
