<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Businesssetmeal extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $Feature = new \app\admin\model\Feature();
        $Feature->Title = "底商套餐";
        $Feature->DataUrl = "/admin/Businesssetmeal/get";
        $Feature->TableHeader = array("套餐名称","套餐说明","显示顺序");
        $Feature->Fields = array("BUSINESS_SET_MEAL_ID","set_name","package_description","display_order");
        $Feature->Operations= array(
                array('name'=>'编辑','url'=>'/admin/Businesssetmeal/edit/id/'),
                array('name'=>'删除','url'=>'/admin/Businesssetmeal/delete/id/'),
            );
        $Feature->Jumps=array(
                //array('name'=>'编辑','url'=>'/admin/index/editDictionaryTable/DICTIONARY_TABLE_ID/')
            );
        $Feature->Buttons = array(
                array('name'=>'添加','url'=>'/admin/Businesssetmeal/add')
            );
        return json($Feature);
    }
    
    public function get(){
        $BusinessSetMeals = \app\admin\model\BusinessSetMeal::where('BUSINESS_SET_MEAL_ID','<>','')->order("display_order")->select();
        return json($BusinessSetMeals);
    }
    
    public function add(){
        $SecondTitle = '>添加底商套餐';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/businesssetmeal');
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
        $BusinessSetMeal = new \app\admin\model\BusinessSetMeal($postdata['Businesssetmeal']);
        $BusinessSetMeal->save();
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
        $BusinessSetMeal = \app\admin\model\BusinessSetMeal::get($id);
        $SecondTitle = '>编辑底商套餐';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/businesssetmeal');
        $this->assign('BusinessSetMeal',$BusinessSetMeal);
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
        $data = $postdata['Businesssetmeal'];
        $BusinessSetMeal = \app\admin\model\BusinessSetMeal::get($data['BUSINESS_SET_MEAL_ID']);
        $BusinessSetMeal->data($data);
        $BusinessSetMeal->save();
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
        $BusinessSetMeal = \app\admin\model\BusinessSetMeal::get($id);
        $SecondTitle = '>删除底商套餐';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/businesssetmeal');
        $this->assign('BusinessSetMeal',$BusinessSetMeal);
        return $this->fetch();
    }
    
    public function kill(){
        $postdata = input('post.');
        $BUSINESS_SET_MEAL_ID = $postdata['BUSINESS_SET_MEAL_ID'];
        $BusinessSetMeal = \app\admin\model\BusinessSetMeal::get($BUSINESS_SET_MEAL_ID);
        $BusinessSetMeal->delete();
        return 'ok';
    }
}
