<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Administrativearea extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $Feature = new \app\admin\model\Feature();
        $Feature->Title = "行政区";
        $Feature->DataUrl = "/admin/Administrativearea/get";
        $Feature->TableHeader = array("行政区","显示顺序");
        $Feature->Fields = array("ADMINISTRATIVE_AREA_ID","administrative_area","display_order");
        $Feature->Operations= array(
                array('name'=>'编辑','url'=>'/admin/Administrativearea/edit/id/'),
                array('name'=>'删除','url'=>'/admin/Administrativearea/delete/id/'),
            );
        $Feature->Jumps=array(
                //array('name'=>'编辑','url'=>'/admin/index/editDictionaryTable/DICTIONARY_TABLE_ID/')
            );
        $Feature->Buttons = array(
                array('name'=>'添加','url'=>'/admin/Administrativearea/add')
            );
        return json($Feature);
    }
    
    public function get(){
        $AdministrativeAreas = \app\admin\model\AdministrativeArea::where('ADMINISTRATIVE_AREA_ID','<>','')->order("display_order")->select();
        return json($AdministrativeAreas);
    }
    
    public function add(){
        $SecondTitle = '>添加行政区';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/administrativearea');
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
        $AdministrativeArea = new \app\admin\model\AdministrativeArea($postdata['Administrativearea']);
        $AdministrativeArea->save();
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
        $AdministrativeArea = \app\admin\model\AdministrativeArea::get($id);
        $SecondTitle = '>编辑行政区';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/administrativearea');
        $this->assign('AdministrativeArea',$AdministrativeArea);
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
        $data = $postdata['Administrativearea'];
        $AdministrativeArea = \app\admin\model\AdministrativeArea::get($data['ADMINISTRATIVE_AREA_ID']);
        $AdministrativeArea->data($data);
        $AdministrativeArea->save();
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
        $AdministrativeArea = \app\admin\model\AdministrativeArea::get($id);
        $SecondTitle = '>删除行政区';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/administrativearea');
        $this->assign('AdministrativeArea',$AdministrativeArea);
        return $this->fetch();
    }
    
    public function kill(){
        $postdata = input('post.');
        $ADMINISTRATIVE_AREA_ID = $postdata['ADMINISTRATIVE_AREA_ID'];
        $AdministrativeArea = \app\admin\model\AdministrativeArea::get($ADMINISTRATIVE_AREA_ID);
        $AdministrativeArea->delete();
        return 'ok';
    }
}
