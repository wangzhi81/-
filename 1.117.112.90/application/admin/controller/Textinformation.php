<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Textinformation extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $Feature = new \app\admin\model\Feature();
        $Feature->Title = "文本信息";
        $Feature->DataUrl = "/admin/Textinformation/get";
        $Feature->TableHeader = array("文本标题","更新时间","创建时间");
        $Feature->Fields = array("TEXT_INFORMATION_ID","text_title","update_time__","creation_time");
        $Feature->Operations= array(
                array('name'=>'编辑','url'=>'/admin/Textinformation/edit/id/'),
                array('name'=>'删除','url'=>'/admin/Textinformation/delete/id/'),
            );
        $Feature->Jumps=array(
                //array('name'=>'编辑','url'=>'/admin/index/editDictionaryTable/DICTIONARY_TABLE_ID/')
            );
        $Feature->Buttons = array(
                array('name'=>'添加','url'=>'/admin/Textinformation/add')
            );
        return json($Feature);
    }
    
    public function get(){
        $TextInformations = \app\admin\model\TextInformation::where('TEXT_INFORMATION_ID','<>','')->order("text_title")->select();
        return json($TextInformations);
    }
    
    public function add(){
        $SecondTitle = '>添加文本信息';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/textinformation');
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
        $UserInfor = session('UserInfor');
        $postdata = input('post.');
        $TextInformation = new \app\admin\model\TextInformation($postdata['Textinformation']);
        $TextInformation->update_time__ = date('Y-m-d H:i:s');
        $TextInformation->creation_time = date('Y-m-d H:i:s');
        $TextInformation->last_operator = $UserInfor['USER_LIST_ID'];
        $TextInformation->save();
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
        $TextInformation = \app\admin\model\TextInformation::get($id);
        $SecondTitle = '>编辑文本信息';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/textinformation');
        $this->assign('TextInformation',$TextInformation);
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
        $UserInfor = session('UserInfor');
        $postdata = input('post.');
        $data = $postdata['Textinformation'];
        $TextInformation = \app\admin\model\TextInformation::get($data['TEXT_INFORMATION_ID']);
        $TextInformation->data($data);
        $TextInformation->update_time__ = date('Y-m-d H:i:s');
        $TextInformation->last_operator = $UserInfor['USER_LIST_ID'];
        $TextInformation->save();
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
        $TextInformation = \app\admin\model\TextInformation::get($id);
        $SecondTitle = '>删除文本信息';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/textinformation');
        $this->assign('TextInformation',$TextInformation);
        return $this->fetch();
    }
    
    public function kill(){
        $postdata = input('post.');
        $TEXT_INFORMATION_ID = $postdata['TEXT_INFORMATION_ID'];
        $TextInformation = \app\admin\model\TextInformation::get($TEXT_INFORMATION_ID);
        $TextInformation->delete();
        return 'ok';
    }
}
