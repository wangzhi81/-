<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Parametersetting extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $Feature = new \app\admin\model\Feature();
        $Feature->Title = "参数设置";
        $Feature->DataUrl = "/admin/Parametersetting/get";
        $Feature->TableHeader = array("参数名称","参数值","参数说明","显示顺序");
        $Feature->Fields = array("PARAMETER_SETTING_ID","parameter_name","parameter_values","parameter_description","display_order");
        $Feature->Operations= array(
                array('name'=>'编辑','url'=>'/admin/Parametersetting/edit/id/'),
            );
        $Feature->Jumps=array(
                //array('name'=>'编辑','url'=>'/admin/index/editDictionaryTable/DICTIONARY_TABLE_ID/')
            );
        $Feature->Buttons = array(
                array('name'=>'添加','url'=>'/admin/Parametersetting/add')
            );
        return json($Feature);
    }
    
    public function get(){
        $ParameterSettings = \app\admin\model\ParameterSetting::where('PARAMETER_SETTING_ID','<>','')->order("display_order")->select();
        return json($ParameterSettings);
    }
    
    public function add(){
        $SecondTitle = '>添加参数设置';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/parametersetting');
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
        $ParameterSetting = new \app\admin\model\ParameterSetting($postdata['Parametersetting']);
        $ParameterSetting->save();
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
        $ParameterSetting = \app\admin\model\ParameterSetting::get($id);
        $SecondTitle = '>编辑参数设置';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/parametersetting');
        $this->assign('ParameterSetting',$ParameterSetting);
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
        $data = $postdata['Parametersetting'];
        $ParameterSetting = \app\admin\model\ParameterSetting::get($data['PARAMETER_SETTING_ID']);
        $ParameterSetting->data($data);
        $ParameterSetting->save();
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
        $ParameterSetting = \app\admin\model\ParameterSetting::get($id);
        $SecondTitle = '>删除参数设置';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/parametersetting');
        $this->assign('ParameterSetting',$ParameterSetting);
        return $this->fetch();
    }
    
    public function kill(){
        $postdata = input('post.');
        $PARAMETER_SETTING_ID = $postdata['PARAMETER_SETTING_ID'];
        $ParameterSetting = \app\admin\model\ParameterSetting::get($PARAMETER_SETTING_ID);
        $ParameterSetting->delete();
        return 'ok';
    }
}
