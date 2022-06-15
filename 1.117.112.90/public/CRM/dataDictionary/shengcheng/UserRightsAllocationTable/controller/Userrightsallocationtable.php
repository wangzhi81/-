<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Userrightsallocationtable extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $Feature = new \app\admin\model\Feature();
        $Feature->Title = "用户权限分配表";
        $Feature->DataUrl = "/admin/Userrightsallocationtable/get";
        $Feature->TableHeader = array("角色","菜单ID");
        $Feature->Fields = array("USER_RIGHTS_ALLOCATION_TABLE_ID","role","menu_id");
        $Feature->Operations= array(
                array('name'=>'编辑','url'=>'/admin/Userrightsallocationtable/edit/id/'),
                array('name'=>'删除','url'=>'/admin/Userrightsallocationtable/delete/id/'),
            );
        $Feature->Jumps=array(
                //array('name'=>'编辑','url'=>'/admin/index/editDictionaryTable/DICTIONARY_TABLE_ID/')
            );
        $Feature->Buttons = array(
                array('name'=>'添加','url'=>'/admin/Userrightsallocationtable/add')
            );
        return json($Feature);
    }
    
    public function get(){
        $UserRightsAllocationTables = \app\admin\model\UserRightsAllocationTable::where('USER_RIGHTS_ALLOCATION_TABLE_ID','<>','')->order("display_order")->select();
        return json($UserRightsAllocationTables);
    }
    
    public function add(){
        $SecondTitle = '>添加用户权限分配表';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/userrightsallocationtable');
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
        $UserRightsAllocationTable = new \app\admin\model\UserRightsAllocationTable($postdata['Userrightsallocationtable']);
        $UserRightsAllocationTable->save();
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
        $UserRightsAllocationTable = \app\admin\model\UserRightsAllocationTable::get($id);
        $SecondTitle = '>编辑用户权限分配表';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/userrightsallocationtable');
        $this->assign('UserRightsAllocationTable',$UserRightsAllocationTable);
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
        $data = $postdata['Userrightsallocationtable'];
        $UserRightsAllocationTable = \app\admin\model\UserRightsAllocationTable::get($data['USER_RIGHTS_ALLOCATION_TABLE_ID']);
        $UserRightsAllocationTable->data($data);
        $UserRightsAllocationTable->save();
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
        $UserRightsAllocationTable = \app\admin\model\UserRightsAllocationTable::get($id);
        $SecondTitle = '>删除用户权限分配表';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/userrightsallocationtable');
        $this->assign('UserRightsAllocationTable',$UserRightsAllocationTable);
        return $this->fetch();
    }
    
    public function kill(){
        $postdata = input('post.');
        $USER_RIGHTS_ALLOCATION_TABLE_ID = $postdata['USER_RIGHTS_ALLOCATION_TABLE_ID'];
        $UserRightsAllocationTable = \app\admin\model\UserRightsAllocationTable::get($USER_RIGHTS_ALLOCATION_TABLE_ID);
        $UserRightsAllocationTable->delete();
        return 'ok';
    }
}
