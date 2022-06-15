<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Operationparameters extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $Feature = new \app\admin\model\Feature();
        $Feature->Title = "运行参数";
        $Feature->DataUrl = "/admin/Operationparameters/get";
        $Feature->TableHeader = array("参数名","参数值");
        $Feature->Fields = array("OPERATION_PARAMETERS_ID","parameter_name","parameter_values");
        $Feature->Operations= array(
                array('name'=>'编辑','url'=>'/admin/Operationparameters/edit/id/'),
                array('name'=>'删除','url'=>'/admin/Operationparameters/delete/id/'),
            );
        $Feature->Jumps=array(
                //array('name'=>'编辑','url'=>'/admin/index/editDictionaryTable/DICTIONARY_TABLE_ID/')
            );
        $Feature->Buttons = array(
                array('name'=>'添加','url'=>'/admin/Operationparameters/add')
            );
        return json($Feature);
    }
    
    public function get(){
        $OperationParameterss = \app\admin\model\OperationParameters::where('OPERATION_PARAMETERS_ID','<>','')->order("display_order")->select();
        return json($OperationParameterss);
    }
    
    public function add(){
        $SecondTitle = '>添加运行参数';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/operationparameters');
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
        $OperationParameters = new \app\admin\model\OperationParameters($postdata['Operationparameters']);
        $OperationParameters->save();
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
        $OperationParameters = \app\admin\model\OperationParameters::get($id);
        $SecondTitle = '>编辑运行参数';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/operationparameters');
        $this->assign('OperationParameters',$OperationParameters);
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
        $data = $postdata['Operationparameters'];
        $OperationParameters = \app\admin\model\OperationParameters::get($data['OPERATION_PARAMETERS_ID']);
        $OperationParameters->data($data);
        $OperationParameters->save();
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
        $OperationParameters = \app\admin\model\OperationParameters::get($id);
        $SecondTitle = '>删除运行参数';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/operationparameters');
        $this->assign('OperationParameters',$OperationParameters);
        return $this->fetch();
    }
    
    public function kill(){
        $postdata = input('post.');
        $OPERATION_PARAMETERS_ID = $postdata['OPERATION_PARAMETERS_ID'];
        $OperationParameters = \app\admin\model\OperationParameters::get($OPERATION_PARAMETERS_ID);
        $OperationParameters->delete();
        return 'ok';
    }
}
