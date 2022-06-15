<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Finalperformancecoefficient extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $Feature = new \app\admin\model\Feature();
        $Feature->Title = "最终绩效系数";
        $Feature->DataUrl = "/admin/Finalperformancecoefficient/get";
        $Feature->TableHeader = array("区间最小值","区间最大值","绩效系数","显示顺序");
        $Feature->Fields = array("FINAL_PERFORMANCE_COEFFICIENT_ID","interval_minimum","interval_maximum","performance_coefficient","display_order");
        $Feature->Operations= array(
                array('name'=>'编辑','url'=>'/admin/Finalperformancecoefficient/edit/id/'),
                array('name'=>'删除','url'=>'/admin/Finalperformancecoefficient/delete/id/'),
            );
        $Feature->Jumps=array(
                //array('name'=>'编辑','url'=>'/admin/index/editDictionaryTable/DICTIONARY_TABLE_ID/')
            );
        $Feature->Buttons = array(
                array('name'=>'添加','url'=>'/admin/Finalperformancecoefficient/add')
            );
        return json($Feature);
    }
    
    public function get(){
        $FinalPerformanceCoefficients = \app\admin\model\FinalPerformanceCoefficient::where('FINAL_PERFORMANCE_COEFFICIENT_ID','<>','')->order("display_order")->select();
        return json($FinalPerformanceCoefficients);
    }
    
    public function add(){
        $SecondTitle = '>添加最终绩效系数';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/finalperformancecoefficient');
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
        $FinalPerformanceCoefficient = new \app\admin\model\FinalPerformanceCoefficient($postdata['Finalperformancecoefficient']);
        $FinalPerformanceCoefficient->save();
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
        $FinalPerformanceCoefficient = \app\admin\model\FinalPerformanceCoefficient::get($id);
        $SecondTitle = '>编辑最终绩效系数';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/finalperformancecoefficient');
        $this->assign('FinalPerformanceCoefficient',$FinalPerformanceCoefficient);
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
        $data = $postdata['Finalperformancecoefficient'];
        $FinalPerformanceCoefficient = \app\admin\model\FinalPerformanceCoefficient::get($data['FINAL_PERFORMANCE_COEFFICIENT_ID']);
        $FinalPerformanceCoefficient->data($data);
        $FinalPerformanceCoefficient->save();
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
        $FinalPerformanceCoefficient = \app\admin\model\FinalPerformanceCoefficient::get($id);
        $SecondTitle = '>删除最终绩效系数';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/finalperformancecoefficient');
        $this->assign('FinalPerformanceCoefficient',$FinalPerformanceCoefficient);
        return $this->fetch();
    }
    
    public function kill(){
        $postdata = input('post.');
        $FINAL_PERFORMANCE_COEFFICIENT_ID = $postdata['FINAL_PERFORMANCE_COEFFICIENT_ID'];
        $FinalPerformanceCoefficient = \app\admin\model\FinalPerformanceCoefficient::get($FINAL_PERFORMANCE_COEFFICIENT_ID);
        $FinalPerformanceCoefficient->delete();
        return 'ok';
    }
}
