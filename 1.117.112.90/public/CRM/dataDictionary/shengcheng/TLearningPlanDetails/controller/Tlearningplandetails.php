<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Tlearningplandetails extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $Feature = new \app\admin\model\Feature();
        $Feature->Title = "学习计划明细";
        $Feature->DataUrl = "/admin/Tlearningplandetails/get";
        $Feature->TableHeader = array("学习计划ID","课程ID","学习目标","进度安排");
        $Feature->Fields = array("T_LEARNING_PLAN_DETAILS_ID","learning_plan_id","course_id","learning_objectives","schedule");
        $Feature->Operations= array(
                array('name'=>'编辑','url'=>'/admin/Tlearningplandetails/edit/id/'),
                array('name'=>'删除','url'=>'/admin/Tlearningplandetails/delete/id/'),
            );
        $Feature->Jumps=array(
                //array('name'=>'编辑','url'=>'/admin/index/editDictionaryTable/DICTIONARY_TABLE_ID/')
            );
        $Feature->Buttons = array(
                array('name'=>'添加','url'=>'/admin/Tlearningplandetails/add')
            );
        return json($Feature);
    }
    
    public function get(){
        $TLearningPlanDetailss = \app\admin\model\TLearningPlanDetails::where('T_LEARNING_PLAN_DETAILS_ID','<>','')->order("display_order")->select();
        return json($TLearningPlanDetailss);
    }
    
    public function add(){
        $SecondTitle = '>添加学习计划明细';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/tlearningplandetails');
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
        $TLearningPlanDetails = new \app\admin\model\TLearningPlanDetails($postdata['Tlearningplandetails']);
        $TLearningPlanDetails->save();
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
        $TLearningPlanDetails = \app\admin\model\TLearningPlanDetails::get($id);
        $SecondTitle = '>编辑学习计划明细';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/tlearningplandetails');
        $this->assign('TLearningPlanDetails',$TLearningPlanDetails);
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
        $data = $postdata['Tlearningplandetails'];
        $TLearningPlanDetails = \app\admin\model\TLearningPlanDetails::get($data['T_LEARNING_PLAN_DETAILS_ID']);
        $TLearningPlanDetails->data($data);
        $TLearningPlanDetails->save();
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
        $TLearningPlanDetails = \app\admin\model\TLearningPlanDetails::get($id);
        $SecondTitle = '>删除学习计划明细';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/tlearningplandetails');
        $this->assign('TLearningPlanDetails',$TLearningPlanDetails);
        return $this->fetch();
    }
    
    public function kill(){
        $postdata = input('post.');
        $T_LEARNING_PLAN_DETAILS_ID = $postdata['T_LEARNING_PLAN_DETAILS_ID'];
        $TLearningPlanDetails = \app\admin\model\TLearningPlanDetails::get($T_LEARNING_PLAN_DETAILS_ID);
        $TLearningPlanDetails->delete();
        return 'ok';
    }
}
