<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Deshanginformation extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $Feature = new \app\admin\model\Feature();
        $Feature->Title = "底商信息";
        $Feature->DataUrl = "/admin/Deshanginformation/get";
        $Feature->TableHeader = array("商户名称","联系电话","商户地址","商户照片","显示顺序");
        $Feature->Fields = array("DESHANG_INFORMATION_ID","name_of_the_merchant","contact_number","business_address","merchant_photos","display_order");
        $Feature->Operations= array(
                array('name'=>'编辑','url'=>'/admin/Deshanginformation/edit/id/'),
                array('name'=>'删除','url'=>'/admin/Deshanginformation/delete/id/'),
            );
        $Feature->Jumps=array(
                //array('name'=>'编辑','url'=>'/admin/index/editDictionaryTable/DICTIONARY_TABLE_ID/')
            );
        $Feature->Buttons = array(
                array('name'=>'添加','url'=>'/admin/Deshanginformation/add')
            );
        return json($Feature);
    }
    
    public function get(){
        $DeshangInformations = \app\admin\model\DeshangInformation::where('DESHANG_INFORMATION_ID','<>','')->order("display_order")->select();
        return json($DeshangInformations);
    }
    
    public function add(){
        $SecondTitle = '>添加底商信息';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/deshanginformation');
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
        $DeshangInformation = new \app\admin\model\DeshangInformation($postdata['Deshanginformation']);
        $DeshangInformation->save();
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
        $DeshangInformation = \app\admin\model\DeshangInformation::get($id);
        $SecondTitle = '>编辑底商信息';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/deshanginformation');
        $this->assign('DeshangInformation',$DeshangInformation);
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
        $data = $postdata['Deshanginformation'];
        $DeshangInformation = \app\admin\model\DeshangInformation::get($data['DESHANG_INFORMATION_ID']);
        $DeshangInformation->data($data);
        $DeshangInformation->save();
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
        $DeshangInformation = \app\admin\model\DeshangInformation::get($id);
        $SecondTitle = '>删除底商信息';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/deshanginformation');
        $this->assign('DeshangInformation',$DeshangInformation);
        return $this->fetch();
    }
    
    public function kill(){
        $postdata = input('post.');
        $DESHANG_INFORMATION_ID = $postdata['DESHANG_INFORMATION_ID'];
        $DeshangInformation = \app\admin\model\DeshangInformation::get($DESHANG_INFORMATION_ID);
        $DeshangInformation->delete();
        return 'ok';
    }
}
