<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Housekeepingserviceclassification extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $Feature = new \app\admin\model\Feature();
        $Feature->Title = "家政服务分类";
        $Feature->DataUrl = "/admin/Housekeepingserviceclassification/get";
        $Feature->TableHeader = array("类别名称","类别图标","显示顺序");
        $Feature->Fields = array("HOUSEKEEPING_SERVICE_CLASSIFICATION_ID","class_name","category_icon","display_order");
        $Feature->Operations= array(
                array('name'=>'编辑','url'=>'/admin/Housekeepingserviceclassification/edit/id/'),
                array('name'=>'删除','url'=>'/admin/Housekeepingserviceclassification/delete/id/'),
            );
        $Feature->Jumps=array(
                //array('name'=>'编辑','url'=>'/admin/index/editDictionaryTable/DICTIONARY_TABLE_ID/')
            );
        $Feature->Buttons = array(
                array('name'=>'添加','url'=>'/admin/Housekeepingserviceclassification/add')
            );
        return json($Feature);
    }
    
    public function get(){
        $HousekeepingServiceClassifications = \app\admin\model\HousekeepingServiceClassification::where('HOUSEKEEPING_SERVICE_CLASSIFICATION_ID','<>','')->order("display_order")->select();
        return json($HousekeepingServiceClassifications);
    }
    
    public function add(){
        $SecondTitle = '>添加家政服务分类';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/housekeepingserviceclassification');
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
        $HousekeepingServiceClassification = new \app\admin\model\HousekeepingServiceClassification($postdata['Housekeepingserviceclassification']);
        $HousekeepingServiceClassification->save();
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
        $HousekeepingServiceClassification = \app\admin\model\HousekeepingServiceClassification::get($id);
        $SecondTitle = '>编辑家政服务分类';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/housekeepingserviceclassification');
        $this->assign('HousekeepingServiceClassification',$HousekeepingServiceClassification);
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
        $data = $postdata['Housekeepingserviceclassification'];
        $HousekeepingServiceClassification = \app\admin\model\HousekeepingServiceClassification::get($data['HOUSEKEEPING_SERVICE_CLASSIFICATION_ID']);
        $HousekeepingServiceClassification->data($data);
        $HousekeepingServiceClassification->save();
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
        $HousekeepingServiceClassification = \app\admin\model\HousekeepingServiceClassification::get($id);
        $SecondTitle = '>删除家政服务分类';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/housekeepingserviceclassification');
        $this->assign('HousekeepingServiceClassification',$HousekeepingServiceClassification);
        return $this->fetch();
    }
    
    public function kill(){
        $postdata = input('post.');
        $HOUSEKEEPING_SERVICE_CLASSIFICATION_ID = $postdata['HOUSEKEEPING_SERVICE_CLASSIFICATION_ID'];
        $HousekeepingServiceClassification = \app\admin\model\HousekeepingServiceClassification::get($HOUSEKEEPING_SERVICE_CLASSIFICATION_ID);
        $HousekeepingServiceClassification->delete();
        return 'ok';
    }
}
