<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Jobinformation extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $Feature = new \app\admin\model\Feature();
        $Feature->Title = "职务信息";
        $Feature->DataUrl = "/admin/Jobinformation/get";
        $Feature->TableHeader = array("职务名称","显示顺序");
        $Feature->Fields = array("JOB_INFORMATION_ID","title_name","display_order");
        $Feature->Operations= array(
                array('name'=>'编辑','url'=>'/admin/Jobinformation/edit/id/'),
                array('name'=>'删除','url'=>'/admin/Jobinformation/delete/id/'),
            );
        $Feature->Jumps=array(
                //array('name'=>'编辑','url'=>'/admin/index/editDictionaryTable/DICTIONARY_TABLE_ID/')
            );
        $Feature->Buttons = array(
                array('name'=>'添加','url'=>'/admin/Jobinformation/add')
            );
        return json($Feature);
    }
    
    public function get(){
        $JobInformations = \app\admin\model\JobInformation::where('JOB_INFORMATION_ID','<>','')->order("display_order")->select();
        return json($JobInformations);
    }
    
    public function add(){
        $SecondTitle = '>添加职务信息';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/jobinformation');
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
        $JobInformation = new \app\admin\model\JobInformation($postdata['Jobinformation']);
        $JobInformation->save();
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
        $JobInformation = \app\admin\model\JobInformation::get($id);
        $SecondTitle = '>编辑职务信息';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/jobinformation');
        $this->assign('JobInformation',$JobInformation);
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
        $data = $postdata['Jobinformation'];
        $JobInformation = \app\admin\model\JobInformation::get($data['JOB_INFORMATION_ID']);
        $JobInformation->data($data);
        $JobInformation->save();
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
        $JobInformation = \app\admin\model\JobInformation::get($id);
        $SecondTitle = '>删除职务信息';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/jobinformation');
        $this->assign('JobInformation',$JobInformation);
        return $this->fetch();
    }
    
    public function kill(){
        $postdata = input('post.');
        $JOB_INFORMATION_ID = $postdata['JOB_INFORMATION_ID'];
        $JobInformation = \app\admin\model\JobInformation::get($JOB_INFORMATION_ID);
        $JobInformation->delete();
        return 'ok';
    }
}
