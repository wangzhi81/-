<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Businesshall extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $Feature = new \app\admin\model\Feature();
        $Feature->Title = "营业厅";
        $Feature->DataUrl = "/admin/Businesshall/get";
        $Feature->TableHeader = array("营业厅名称","地址","负责人","联系电话");
        $Feature->Fields = array("BUSINESS_HALL_ID","business_hall_name","address","person_in_charge","contact_number");
        $Feature->Operations= array(
                array('name'=>'编辑','url'=>'/admin/Businesshall/edit/id/'),
                array('name'=>'删除','url'=>'/admin/Businesshall/delete/id/'),
            );
        $Feature->Jumps=array(
                //array('name'=>'编辑','url'=>'/admin/index/editDictionaryTable/DICTIONARY_TABLE_ID/')
            );
        $Feature->Buttons = array(
                array('name'=>'添加','url'=>'/admin/Businesshall/add')
            );
        return json($Feature);
    }
    
    public function get(){
        $BusinessHalls = \app\admin\model\BusinessHall::where('BUSINESS_HALL_ID','<>','')->order("display_order")->select();
        return json($BusinessHalls);
    }
    
    public function add(){
        $SecondTitle = '>添加营业厅';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/businesshall');
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
        $BusinessHall = new \app\admin\model\BusinessHall($postdata['Businesshall']);
        $BusinessHall->save();
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
        $BusinessHall = \app\admin\model\BusinessHall::get($id);
        $SecondTitle = '>编辑营业厅';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/businesshall');
        $this->assign('BusinessHall',$BusinessHall);
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
        $data = $postdata['Businesshall'];
        $BusinessHall = \app\admin\model\BusinessHall::get($data['BUSINESS_HALL_ID']);
        $BusinessHall->data($data);
        $BusinessHall->save();
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
        $BusinessHall = \app\admin\model\BusinessHall::get($id);
        $SecondTitle = '>删除营业厅';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/businesshall');
        $this->assign('BusinessHall',$BusinessHall);
        return $this->fetch();
    }
    
    public function kill(){
        $postdata = input('post.');
        $BUSINESS_HALL_ID = $postdata['BUSINESS_HALL_ID'];
        $BusinessHall = \app\admin\model\BusinessHall::get($BUSINESS_HALL_ID);
        $BusinessHall->delete();
        return 'ok';
    }
}
