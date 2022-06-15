<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Operationlog extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $Feature = new \app\admin\model\Feature();
        $Feature->Title = "操作日志";
        $Feature->DataUrl = "/admin/Operationlog/get";
        $Feature->TableHeader = array("openid","操作时间","操作内容","辅助信息","关联ID");
        $Feature->Fields = array("OPERATION_LOG_ID","OPENID","OPERATING_TIME","OPERATION_CONTENT","AUXILIARY_INFORMATION","correlation_id");
        $Feature->Operations= array(
                array('name'=>'编辑','url'=>'/admin/Operationlog/edit/id/'),
                array('name'=>'删除','url'=>'/admin/Operationlog/delete/id/'),
            );
        $Feature->Jumps=array(
                //array('name'=>'编辑','url'=>'/admin/index/editDictionaryTable/DICTIONARY_TABLE_ID/')
            );
        $Feature->Buttons = array(
                array('name'=>'添加','url'=>'/admin/Operationlog/add')
            );
        return json($Feature);
    }
    
    public function get(){
        $OperationLogs = \app\admin\model\OperationLog::where('OPERATION_LOG_ID','<>','')->order("display_order")->select();
        return json($OperationLogs);
    }
    
    public function add(){
        $SecondTitle = '>添加操作日志';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/operationlog');
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
        $OperationLog = new \app\admin\model\OperationLog($postdata['Operationlog']);
        $OperationLog->save();
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
        $OperationLog = \app\admin\model\OperationLog::get($id);
        $SecondTitle = '>编辑操作日志';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/operationlog');
        $this->assign('OperationLog',$OperationLog);
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
        $data = $postdata['Operationlog'];
        $OperationLog = \app\admin\model\OperationLog::get($data['OPERATION_LOG_ID']);
        $OperationLog->data($data);
        $OperationLog->save();
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
        $OperationLog = \app\admin\model\OperationLog::get($id);
        $SecondTitle = '>删除操作日志';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/operationlog');
        $this->assign('OperationLog',$OperationLog);
        return $this->fetch();
    }
    
    public function kill(){
        $postdata = input('post.');
        $OPERATION_LOG_ID = $postdata['OPERATION_LOG_ID'];
        $OperationLog = \app\admin\model\OperationLog::get($OPERATION_LOG_ID);
        $OperationLog->delete();
        return 'ok';
    }
}
