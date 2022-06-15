<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Finalperformance extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $Feature = new \app\admin\model\Feature();
        $Feature->Title = "最终业绩";
        $Feature->DataUrl = "/admin/Finalperformance/get";
        $Feature->TableHeader = array("年月标识","openid","户数","计算说明","最终业绩");
        $Feature->Fields = array("FINAL_PERFORMANCE_ID","sign_of_year_and_month","openid","households","calculation_explanation","final_performance");
        $Feature->Operations= array(
                array('name'=>'编辑','url'=>'/admin/Finalperformance/edit/id/'),
                array('name'=>'删除','url'=>'/admin/Finalperformance/delete/id/'),
            );
        $Feature->Jumps=array(
                //array('name'=>'编辑','url'=>'/admin/index/editDictionaryTable/DICTIONARY_TABLE_ID/')
            );
        $Feature->Buttons = array(
                array('name'=>'添加','url'=>'/admin/Finalperformance/add')
            );
        return json($Feature);
    }
    
    public function get(){
        $FinalPerformances = \app\admin\model\FinalPerformance::where('FINAL_PERFORMANCE_ID','<>','')->order("display_order")->select();
        return json($FinalPerformances);
    }
    
    public function add(){
        $SecondTitle = '>添加最终业绩';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/finalperformance');
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
        $FinalPerformance = new \app\admin\model\FinalPerformance($postdata['Finalperformance']);
        $FinalPerformance->save();
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
        $FinalPerformance = \app\admin\model\FinalPerformance::get($id);
        $SecondTitle = '>编辑最终业绩';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/finalperformance');
        $this->assign('FinalPerformance',$FinalPerformance);
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
        $data = $postdata['Finalperformance'];
        $FinalPerformance = \app\admin\model\FinalPerformance::get($data['FINAL_PERFORMANCE_ID']);
        $FinalPerformance->data($data);
        $FinalPerformance->save();
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
        $FinalPerformance = \app\admin\model\FinalPerformance::get($id);
        $SecondTitle = '>删除最终业绩';
        $this->assign('SecondTitle', $SecondTitle);
        $this->assign('ScriptFragment','dict/finalperformance');
        $this->assign('FinalPerformance',$FinalPerformance);
        return $this->fetch();
    }
    
    public function kill(){
        $postdata = input('post.');
        $FINAL_PERFORMANCE_ID = $postdata['FINAL_PERFORMANCE_ID'];
        $FinalPerformance = \app\admin\model\FinalPerformance::get($FINAL_PERFORMANCE_ID);
        $FinalPerformance->delete();
        return 'ok';
    }
}
